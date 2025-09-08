<?php

namespace App\Traits;

use App\Helpers\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

trait ValidatesRequestSize
{
    /**
     * Validasi ukuran request dan return response jika melebihi batas
     *
     * @param Request $request
     * @return JsonResponse|null
     */
    protected function validateRequestSize(Request $request): ?JsonResponse
    {
        $validation = RequestValidator::validateRequestSize($request);
        
        if ($validation) {
            return response()->json($validation, 413);
        }
        
        return null;
    }
    
    /**
     * Validasi ukuran file dan return response jika melebihi batas
     *
     * @param Request $request
     * @param string $fieldName
     * @return JsonResponse|null
     */
    protected function validateFileSize(Request $request, string $fieldName): ?JsonResponse
    {
        $validation = RequestValidator::validateFileSize($request, $fieldName);
        
        if ($validation) {
            return response()->json($validation, 413);
        }
        
        return null;
    }
    
    /**
     * Validasi ukuran request dengan custom message
     *
     * @param Request $request
     * @param string $customMessage
     * @return JsonResponse|null
     */
    protected function validateRequestSizeWithMessage(Request $request, string $customMessage): ?JsonResponse
    {
        $validation = RequestValidator::validateRequestSize($request);
        
        if ($validation) {
            $validation['message'] = $customMessage;
            return response()->json($validation, 413);
        }
        
        return null;
    }
}
