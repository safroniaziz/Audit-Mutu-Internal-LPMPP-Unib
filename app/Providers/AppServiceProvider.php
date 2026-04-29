<?php

namespace App\Providers;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        App::setLocale('id');

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('layouts.dashboard._sidebar', function ($view) {
            $auditeeUnitKerjaIds = User::role('Auditee')
                ->whereNotNull('unit_kerja_id')
                ->pluck('unit_kerja_id')
                ->filter()
                ->unique()
                ->values();

            $prodis = UnitKerja::query()
                ->where('jenis_unit_kerja', 'prodi')
                ->whereIn('id', $auditeeUnitKerjaIds)
                ->orderBy('nama_unit_kerja')
                ->get(['id', 'nama_unit_kerja', 'jenjang', 'fakultas']);

            $sidebarFakultasAuditee = collect();
            if ($prodis->isEmpty()) {
                $view->with('sidebarFakultasAuditee', $sidebarFakultasAuditee);
                return;
            }

            $fakultasList = UnitKerja::query()
                ->where('jenis_unit_kerja', 'fakultas')
                ->where(function ($query) use ($prodis) {
                    $fakultasRefs = $prodis->pluck('fakultas')->filter()->unique()->values();
                    if ($fakultasRefs->isEmpty()) {
                        $query->whereRaw('1 = 0');
                        return;
                    }
                    $query->whereIn('id', $fakultasRefs)
                        ->orWhereIn('kode_unit_kerja', $fakultasRefs)
                        ->orWhereIn('nama_unit_kerja', $fakultasRefs);
                })
                ->orderBy('nama_unit_kerja')
                ->get(['id', 'kode_unit_kerja', 'nama_unit_kerja']);

            foreach ($prodis as $prodi) {
                $rawFakultas = trim((string) ($prodi->fakultas ?? ''));

                if ($rawFakultas === '') {
                    $groupKey = 'Tanpa Fakultas';
                } else {
                    $normalizedRaw = strtolower($rawFakultas);

                    $matchedFakultas = $fakultasList->first(function ($fakultas) use ($rawFakultas, $normalizedRaw) {
                        return (string) $fakultas->id === $rawFakultas
                            || (string) $fakultas->kode_unit_kerja === $rawFakultas
                            || strtolower((string) $fakultas->nama_unit_kerja) === $normalizedRaw;
                    });

                    $groupKey = $matchedFakultas ? $matchedFakultas->nama_unit_kerja : $rawFakultas;
                }

                if (!$sidebarFakultasAuditee->has($groupKey)) {
                    $sidebarFakultasAuditee->put($groupKey, collect());
                }

                $sidebarFakultasAuditee->get($groupKey)->push($prodi);
            }

            $sidebarFakultasAuditee = $sidebarFakultasAuditee->map(function ($items) {
                return $items->sortBy('nama_unit_kerja')->values();
            })->sortKeys();

            $view->with('sidebarFakultasAuditee', $sidebarFakultasAuditee);
        });
    }
}
