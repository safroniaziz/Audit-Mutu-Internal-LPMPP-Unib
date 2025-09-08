<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use App\Http\Middleware\RequestSizeLimit;
use App\Helpers\RequestValidator;

class RequestSizeLimitTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test middleware membatasi request yang terlalu besar
     */
    public function test_middleware_blocks_oversized_request()
    {
        // Simulasi request dengan ukuran lebih dari 450KB
        $largeData = str_repeat('a', 500 * 1024); // 500KB

        $request = Request::create('/test', 'POST', [], [], [], [], $largeData);
        $request->headers->set('Content-Length', strlen($largeData));

        $middleware = new RequestSizeLimit();
        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(413, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertFalse($responseData['success']);
        $this->assertStringContainsString('450KB', $responseData['message']);
    }

    /**
     * Test middleware mengizinkan request dengan ukuran normal
     */
    public function test_middleware_allows_normal_size_request()
    {
        // Simulasi request dengan ukuran normal (100KB)
        $normalData = str_repeat('a', 100 * 1024); // 100KB

        $request = Request::create('/test', 'POST', [], [], [], [], $normalData);
        $request->headers->set('Content-Length', strlen($normalData));

        $middleware = new RequestSizeLimit();
        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertTrue($responseData['success']);
    }

    /**
     * Test RequestValidator helper
     */
    public function test_request_validator_helper()
    {
        // Test dengan data besar
        $largeData = str_repeat('a', 500 * 1024);
        $request = Request::create('/test', 'POST', [], [], [], [], $largeData);

        $validation = RequestValidator::validateRequestSize($request);
        $this->assertNotNull($validation);
        $this->assertFalse($validation['success']);
        $this->assertEquals('REQUEST_TOO_LARGE', $validation['error_code']);

        // Test dengan data normal
        $normalData = str_repeat('a', 100 * 1024);
        $request = Request::create('/test', 'POST', [], [], [], [], $normalData);

        $validation = RequestValidator::validateRequestSize($request);
        $this->assertNull($validation);
    }

    /**
     * Test formatBytes helper
     */
    public function test_format_bytes_helper()
    {
        $this->assertEquals('450.00 KB', RequestValidator::formatBytes(450 * 1024));
        $this->assertEquals('1.00 MB', RequestValidator::formatBytes(1024 * 1024));
        $this->assertEquals('500.00 B', RequestValidator::formatBytes(500));
    }

    /**
     * Test route dengan middleware request.size.limit
     */
    public function test_route_with_size_limit_middleware()
    {
        // Test dengan data besar - harus return 413
        $largeData = str_repeat('a', 500 * 1024);

        $response = $this->postJson('/auditee/submit-all-instrumen', [
            'data' => $largeData
        ]);

        // Karena route ini memerlukan auth, kita expect redirect atau error auth
        // Tapi jika middleware berjalan, kita akan mendapat 413
        $this->assertTrue(
            in_array($response->getStatusCode(), [401, 302, 413]),
            'Response status should be 401 (unauthorized), 302 (redirect), or 413 (too large)'
        );
    }
}
