@extends('auditee/dashboard_template')
@push('styles')
    <style>
        /* Wizard navigation styles */
        .wizard-nav {
            display: flex;
            overflow-x: scroll !important;
            overflow-y: hidden !important;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            position: relative;
            background: #ffffff;
            border-radius: 0.475rem;
            box-shadow: 0 0 50px 0 rgb(82 63 105 / 10%);
            /* Force scrollbar to be visible */
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
            /* Ensure no CSS interference */
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            flex-wrap: nowrap !important;
        }

        .wizard-nav::-webkit-scrollbar {
            height: 8px;
        }

        .wizard-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .wizard-nav::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .wizard-nav::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .wizard-step {
            flex: 0 0 auto !important; /* Changed from flex: 1 to prevent equal distribution */
            min-width: 280px !important; /* Increased even more to force scroll */
            max-width: 320px !important;
            text-align: center;
            padding: 0.5rem 2rem;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap !important; /* Prevent text wrapping */
            flex-shrink: 0 !important;
        }

        .wizard-step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            width: calc(100% - 80px);
            height: 2px;
            background: #E4E6EF;
            transform: translate(50%, -50%);
            z-index: 1;
        }

        .wizard-step:not(:last-child):before {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            transform: translate(50%, -50%) rotate(45deg);
            width: 10px;
            height: 10px;
            border-top: 2px solid #E4E6EF;
            border-right: 2px solid #E4E6EF;
            background: white;
            z-index: 2;
        }

        .wizard-step.active {
            color: #009EF7;
        }

        .wizard-step.completed {
            color: #50CD89;
        }

        .wizard-step.completed:not(:last-child):after {
            background: #50CD89;
        }

        .wizard-step.completed:not(:last-child):before {
            border-color: #50CD89;
        }

        .wizard-step.active:not(:last-child):after {
            background: #009EF7;
        }

        .wizard-step.active:not(:last-child):before {
            border-color: #009EF7;
        }

        .wizard-step .step-number {
            width: 40px;
            height: 40px;
            margin: 0 auto 0.75rem;
            border-radius: 50%;
            background: #F5F8FA;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            border: 2px solid #E4E6EF;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .wizard-step.active .step-number {
            background: #009EF7;
            color: white;
            border-color: #009EF7;
            box-shadow: 0 0 20px 0 rgb(0 158 247 / 30%);
        }

        .wizard-step.active .step-label {
            color: #009EF7 !important;
            font-weight: 700;
        }

        .wizard-step.active .step-desc,
        .wizard-step.active .step-progress {
            color: #009EF7 !important;
        }

        .wizard-step.completed .step-number {
            background: #50CD89;
            color: white;
            border-color: #50CD89;
            box-shadow: 0 0 20px 0 rgb(80 205 137 / 30%);
        }

        .wizard-step .step-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #7E8299;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .wizard-step .step-desc {
            color: #B5B5C3;
            font-size: 0.8rem;
            margin: 0 auto;
            transition: all 0.3s ease;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1.2;
        }

        .wizard-step.active .step-desc,
        .wizard-step.completed .step-desc {
            color: inherit;
        }

        .wizard-step:hover:not(.active):not(.completed) {
            color: #009EF7;
        }

        .wizard-step:hover:not(.active):not(.completed) .step-number {
            border-color: #009EF7;
            background: #EEF6FF;
        }

        .wizard-step .step-progress {
            color: #B5B5C3;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }

        .wizard-step.active .step-progress,
        .wizard-step.completed .step-progress {
            color: inherit;
        }

        /* Drag scroll cursor styles */
        .wizard-nav {
            cursor: grab;
        }

        .wizard-nav:active {
            cursor: grabbing;
        }

        .wizard-nav.dragging {
            cursor: grabbing;
            user-select: none;
        }

        .wizard-nav.dragging .wizard-step {
            pointer-events: none;
        }

        .wizard-content {
            display: none;
        }

        .wizard-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Form disabled styles */
        .form-disabled {
            position: relative;
            opacity: 0.7;
        }

        .form-disabled input[type="radio"] {
            cursor: not-allowed;
            pointer-events: none;
        }

        .form-disabled .btn-next {
            cursor: not-allowed;
            pointer-events: none;
            opacity: 0.5;
        }

        .notice {
            border-left: 4px solid #FFA800 !important;
        }
    </style>
@endpush

@section('dashboardProfile')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                    👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                </h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            @php
                // Hitung total instrumen dan yang sudah diisi
                $totalInstrumen = 0;
                $totalDiisi = 0;
                $ssInstrumenCounts = [];
                $satuanStandars = [];

                // Hitung untuk setiap SS
                foreach ($dataIkssProdi as $unit) {
                    foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $ssId => $ssIndikators) {
                        // Get SatuanStandar once and store it
                        if (!isset($satuanStandars[$ssId])) {
                            $satuanStandars[$ssId] = App\Models\SatuanStandar::find($ssId);
                        }

                        if (!isset($ssInstrumenCounts[$ssId])) {
                            $ssInstrumenCounts[$ssId] = [
                                'total' => 0,
                                'selected' => 0,
                                'selected_yes' => 0,
                                'is_submitted' => false,
                                'kode_satuan' => $satuanStandars[$ssId]->kode_satuan,
                                'sasaran' => $satuanStandars[$ssId]->sasaran
                            ];
                        }

                        foreach ($ssIndikators as $indikator) {
                            foreach ($indikator->instrumen as $instrumen) {
                                $ssInstrumenCounts[$ssId]['total']++;
                                $totalInstrumen++;

                                $isWajib = $instrumen->is_wajib == 1 &&
                                          ($instrumen->jenjang == 'Semua' || $instrumen->jenjang == optional(Auth::user()->unitKerja)->jenjang);

                                if ($isWajib) {
                                    $ssInstrumenCounts[$ssId]['selected']++;
                                    $ssInstrumenCounts[$ssId]['selected_yes']++;
                                    $totalDiisi++;
                                } elseif (isset($dataTerpilihCurrent['pilihan_'.$instrumen->id])) {
                                    $ssInstrumenCounts[$ssId]['selected']++;
                                    $totalDiisi++;
                                    if ($dataTerpilihCurrent['pilihan_'.$instrumen->id] == 1) {
                                        $ssInstrumenCounts[$ssId]['selected_yes']++;
                                    }
                                }
                            }
                        }

                        // Update submission status for this SS
                        $ssInstrumenCounts[$ssId]['is_submitted'] =
                            $ssInstrumenCounts[$ssId]['total'] > 0 &&
                            $ssInstrumenCounts[$ssId]['selected'] === $ssInstrumenCounts[$ssId]['total'];
                    }
                }

                // Update status sudah mengisi hanya jika semua instrumen telah diisi
                $semuaInstrumenDiisi = ($totalInstrumen > 0 && $totalDiisi == $totalInstrumen);
            @endphp

            @if(!$pengajuanAmiExists)
                <div class="alert alert-info d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-info"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">📝 Mode Editing Aktif</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mt-2">
                                <strong>Informasi:</strong>
                                <span class="fw-semibold text-info">
                                    Anda masih dapat mengubah dan memperbarui data pada tahap sebelumnya (Perjanjian Kinerja) selama belum ada penugasan auditor untuk periode ini. Gunakan tombol navigasi untuk kembali ke tahap sebelumnya jika diperlukan.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($defaultDariPeriodeSebelumnya) && !$sudahMengisi)
                <div class="alert alert-info d-flex align-items-start p-5 mb-10 border border-info">
                    <div class="me-4">
                        <i class="bi bi-info-circle-fill fs-2 text-info"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">💡 Tips Cepat: Gunakan Pilihan Periode Sebelumnya</h4>
                        <div class="fs-6 text-gray-700">
                            <p class="mb-3">Pilihan IKSS dari <strong>{{ $previousPeriodeLabel ?? 'periode sebelumnya' }}</strong> sudah diprefill sebagai default.</p>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-primary btn-sm" onclick="copyFromPreviousPeriod()">
                                    <i class="bi bi-check2-square me-1"></i> Gunakan Pilihan Sama dengan Periode Sebelumnya
                                </button>
                                <span class="text-muted small">atau ubah pilihan manual di bawah, lalu klik Simpan & Lanjutkan</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!empty($defaultDariPeriodeSebelumnya) && $sudahMengisi)
                <div class="alert alert-warning d-flex align-items-start p-5 mb-10">
                    <div class="me-4">
                        <i class="bi bi-arrow-repeat fs-2 text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-dark mb-2">Default Periode Sebelumnya Masih Aktif</h4>
                        <div class="fs-6 text-gray-700">
                            Untuk instrumen yang belum disimpan di periode aktif, sistem tetap menampilkan default dari
                            <strong>{{ $previousPeriodeLabel ?? 'periode sebelumnya' }}</strong>.
                            Silakan lanjutkan simpan per SS sampai semua tersimpan.
                        </div>
                    </div>
                </div>
            @endif

            <div class="alert {{ $semuaInstrumenDiisi ? 'alert-success' : 'alert-danger' }} d-flex align-items-start p-5 mb-10">
                <div class="me-4">
                    <i class="bi {{ $semuaInstrumenDiisi ? 'bi-check-circle-fill fs-2 text-success' : 'bi-exclamation-triangle-fill fs-2 text-danger' }}"></i>
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold text-dark mb-2">{{ $semuaInstrumenDiisi ? '✨ IKSS Telah Dipilih' : '📢 Pilih IKSS' }}</h4>
                    <div class="fs-6 text-gray-700">
                        <p class="mt-4">
                            <strong>{{ $semuaInstrumenDiisi ? 'Selamat!' : 'Catatan:' }}</strong>
                            <span class="fw-semibold {{ $semuaInstrumenDiisi ? 'text-success' : 'text-danger' }}">
                                @if($semuaInstrumenDiisi)
                                    IKSS telah dipilih dengan lengkap. Silakan lanjut ke tahap pengisian Instrumen Audit.
                                @else
                                    Silakan lengkapi pengisian data <strong>IKSS</strong> dan simpan pada periode aktif ini untuk dapat melanjutkan ke tahap <strong>pengisian Instrumen Audit</strong>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <div class="ms-auto d-flex gap-2">
                    @if (!$pengajuanAmiExists)
                        <a href="{{ route('auditee.pengajuanAmi.perjanjianKinerja') }}" class="btn btn-sm btn-light-primary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Perjanjian Kinerja
                        </a>
                    @endif
                    @if ($semuaInstrumenDiisi)
                        <a
                            href="{{ route('auditee.pengajuanAmi.pengisianInstrumen') }}"
                            class="btn btn-sm px-4 btn-primary"
                        >
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @else
                        <a
                            href="#"
                            class="btn btn-sm px-4 btn-secondary disabled"
                            style="cursor: not-allowed; opacity: 0.65;"
                        >
                            <i class="fas fa-arrow-right me-2"></i> Proses Selanjutnya
                        </a>
                    @endif
                </div>
            </div>

            <div class="d-flex flex-wrap mb-8">
                <h2 class="fw-bold text-dark me-5">📋 Indikator Kinerja Sasaran Strategis (IKSS)</h2>
            </div>

            <form id="formPemilihanIkss" action="{{ route('auditee.pengajuanAmi.saveIkss') }}" method="POST" {{ $pengajuanAmiExists ? 'class=form-disabled' : '' }}>
                @csrf
                <input type="hidden" name="auditee_id" value="{{ Auth::user()->unit_kerja_id }}">

                <!-- Status Form Information -->
                @if($pengajuanAmiExists)
                    <div class="alert alert-success d-flex align-items-start p-5 mb-10 border border-success">
                        <div class="me-4">
                            <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-2">✅ Proses Pemilihan IKSS Sudah Selesai</h4>
                            <div class="fs-6 text-gray-700">
                                <p class="mb-2">
                                    Data IKSS untuk periode ini sudah tersimpan. Pilihan Anda tidak dapat diubah kembali karena proses pengisian telah selesai.
                                </p>
                                <p class="mb-0">
                                    <strong>Status:</strong> <span class="badge badge-success">Terseimpan</span>
                                    <span class="text-muted mx-2">|</span>
                                    <strong>Total Instrumen Dipilih:</strong> {{ $totalInstrumen }} instrumen
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Wizard Navigation -->
                <div class="wizard-nav mb-5">
                    @foreach ($dataIkssProdi as $unit)
                        @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                            <div class="wizard-step" data-step="{{ $loop->iteration }}">
                                <div class="step-number">{{ $loop->iteration }}</div>
                                <div class="step-label">{{ $satuanStandars[$satuanId]->kode_satuan }}</div>
                                <div class="step-desc">{{ Str::limit($satuanStandars[$satuanId]->sasaran, 50) }}</div>
                                <div class="step-progress">
                                    @php
                                        $stats = $ssInstrumenCounts[$satuanId] ?? ['total' => 0, 'selected' => 0];
                                    @endphp
                                    {{ $stats['selected'] }}/{{ $stats['total'] }} instrumen
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <!-- Wizard Content -->
                @foreach ($dataIkssProdi as $unit)
                    @foreach ($unit->indikatorKinerjas->groupBy('satuan_standar_id') as $satuanId => $indikators)
                        @php
                            $ssStats = $ssInstrumenCounts[$satuanId] ?? [
                                'total' => 0,
                                'selected' => 0,
                                'selected_yes' => 0,
                                'is_submitted' => false,
                                'kode_satuan' => '',
                                'sasaran' => ''
                            ];
                        @endphp
                        <div class="wizard-content" data-step="{{ $loop->iteration }}" data-ss-id="{{ $satuanId }}">
                            <div class="timeline timeline-border-dashed">

                                @foreach ($indikators as $indikator)
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-icon">
                                            <span class="fs-5 text-gray-500">{{ $loop->iteration }}</span>
                                        </div>
                                        <div class="timeline-content mb-10 mt-n1">
                                            <div class="pe-3 mb-5">
                                                <div class="fs-4 fw-bold text-gray-800 mb-2">
                                                    ID IKSS: {{ $indikator->kode_ikss }} – {{ $indikator->tujuan }}
                                                </div>
                                                <div class="text-muted fs-6 mb-4">Berikut daftar instrumen yang terkait:</div>
                                            </div>

                                            @foreach ($indikator->instrumen as $instrumen)
                                                @php
                                                    $pilihanKey = 'pilihan_' . $instrumen->id;
                                                    $hasPrevValue = isset($dataTerpilihPrevious[$pilihanKey]);
                                                    $prevValue = $hasPrevValue ? (int) $dataTerpilihPrevious[$pilihanKey] : null;
                                                    $currentValue = isset($dataTerpilih[$pilihanKey]) ? (int) $dataTerpilih[$pilihanKey] : null;
                                                    $isChangedFromPrev = $hasPrevValue && $currentValue !== null && $currentValue !== $prevValue;
                                                @endphp
                                                <div class="d-flex align-items-start border border-dashed border-gray-300 rounded px-6 py-4 mb-3" data-is-wajib="0">
                                                    <div class="flex-grow-1">
                                                        <div class="fs-6 fw-bold text-gray-900 mb-1">
                                                            {{ $loop->iteration }}. {!! strip_tags($instrumen->indikator, '<strong><em><u><span>') !!}
                                                        </div>
                                                        <div class="fs-7 text-muted">
                                                            <div><strong>Sumber:</strong> {!! $instrumen->sumber !!}</div>
                                                            <div><strong>Target:</strong> {{ $instrumen->target }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-4 flex-wrap mt-3" style="max-width: 400px;">
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="ya_{{ $instrumen->id }}"
                                                                value="1"
                                                                {{ (isset($dataTerpilih) && isset($dataTerpilih['pilihan_'.$instrumen->id]) && $dataTerpilih['pilihan_'.$instrumen->id] == 1) ? 'checked' : '' }}
                                                            >
                                                            <label class="form-check-label" for="ya_{{ $instrumen->id }}">Ya</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="radio"
                                                                name="pilihan_{{ $instrumen->id }}"
                                                                id="tidak_{{ $instrumen->id }}"
                                                                value="0"
                                                                {{ (isset($dataTerpilih) && isset($dataTerpilih['pilihan_'.$instrumen->id]) && $dataTerpilih['pilihan_'.$instrumen->id] == 0) ? 'checked' : '' }}
                                                            >
                                                            <label class="form-check-label" for="tidak_{{ $instrumen->id }}">Tidak</label>
                                                        </div>
                                                    </div>
                                                    @if($hasPrevValue)
                                                        <div class="w-100 mt-2">
                                                            <span
                                                                id="compare_{{ $instrumen->id }}"
                                                                class="badge fs-8 {{ $isChangedFromPrev ? 'badge-light-warning' : 'badge-light-success' }}"
                                                                data-prev="{{ $prevValue }}"
                                                            >
                                                                {{ $isChangedFromPrev ? 'Berubah dari periode sebelumnya' : 'Sama dengan periode sebelumnya' }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation and Submit Buttons -->
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light-primary btn-prev" {{ $loop->first ? 'disabled' : '' }}>
                                    <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                </button>
                                @if($pengajuanAmiExists)
                                    <button type="button" class="btn btn-success" disabled>
                                        <i class="bi bi-check-circle me-2"></i> Sudah Tersimpan
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary btn-next" data-ss-id="{{ $satuanId }}">
                                        {{ $loop->last ? 'Selesai' : 'Simpan & Lanjutkan' }} <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize data from database
            const dataTerpilih = @json($dataTerpilih);
            const dataTerpilihCurrent = @json($dataTerpilihCurrent ?? []);
            const dataTerpilihPrevious = @json($dataTerpilihPrevious ?? []);
            let currentStep = 1;

            function updateComparisonBadge(instrumenId) {
                const key = `pilihan_${instrumenId}`;
                if (!Object.prototype.hasOwnProperty.call(dataTerpilihPrevious, key)) {
                    return;
                }

                const badge = document.getElementById(`compare_${instrumenId}`);
                if (!badge) {
                    return;
                }

                const prevValue = parseInt(dataTerpilihPrevious[key], 10);
                const checked = document.querySelector(`input[name="pilihan_${instrumenId}"]:checked`);
                if (!checked) {
                    badge.className = 'badge fs-8 badge-light-secondary';
                    badge.textContent = 'Belum dipilih (ada data periode sebelumnya)';
                    return;
                }

                const currentValue = parseInt(checked.value, 10);
                const isSame = currentValue === prevValue;
                badge.className = `badge fs-8 ${isSame ? 'badge-light-success' : 'badge-light-warning'}`;
                badge.textContent = isSame ? 'Sama dengan periode sebelumnya' : 'Berubah dari periode sebelumnya';
            }

            // Function to find the next incomplete step
            function findNextIncompleteStep() {
                let nextStep = 1;
                for (let i = 1; i <= wizardSteps.length; i++) {
                    if (!isStepCompleted(i)) {
                        nextStep = i;
                        break;
                    }
                    nextStep = i + 1;
                }
                return Math.min(nextStep, wizardSteps.length);
            }

            // Set initial radio button states based on database data
            Object.entries(dataTerpilih).forEach(([key, value]) => {
                const instrumenId = key.replace('pilihan_', '');
                const radio = document.querySelector(`input[type="radio"][name="pilihan_${instrumenId}"][value="${value}"]`);
                if (radio) {
                    radio.checked = true;
                }
                updateComparisonBadge(instrumenId);
            });

            const wizardSteps = document.querySelectorAll('.wizard-step');
            const wizardContents = document.querySelectorAll('.wizard-content');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const nextButtons = document.querySelectorAll('.btn-next');

            // Add click event listeners for wizard steps
            wizardSteps.forEach((step, index) => {
                step.addEventListener('click', function() {
                    const stepNumber = index + 1;
                    const previousStep = stepNumber - 1;

                    // Check if step is accessible
                    if (stepNumber === 1 || (previousStep > 0 && isStepCompleted(previousStep))) {
                        safeUpdateWizardState(stepNumber);
                    }
                });
            });

            // Add click event for previous buttons
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (currentStep > 1) {
                        safeUpdateWizardState(currentStep - 1);
                    }
                });
            });

            // Function to validate current step
            function validateCurrentStep() {
                const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                let allSelected = true;

                currentContent.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    const radioName = group.querySelector('input[type="radio"]')?.name;
                    const checkedRadio = group.querySelector(`input[name="${radioName}"]:checked`);

                    // All instruments are optional now, just check if any option is selected
                    if (!checkedRadio) {
                        allSelected = false;
                    }
                });

                if (!allSelected) {
                    Swal.fire({
                        text: "Harap pilih semua instrumen sebelum melanjutkan.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }

                return allSelected;
            }

            // Function to update current step progress
            function updateCurrentStepProgress() {
                const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                if (!currentContent) return;

                let totalInstruments = 0;
                let selectedInstruments = 0;

                currentContent.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    totalInstruments++;
                    const radioName = group.querySelector('input[type="radio"]')?.name;

                    // All instruments are optional, just check if any option is selected
                    if (radioName && group.querySelector(`input[name="${radioName}"]:checked`)) {
                        selectedInstruments++;
                    }
                });

                const stepElement = document.querySelector(`.wizard-step[data-step="${currentStep}"]`);
                if (totalInstruments === selectedInstruments) {
                    stepElement?.classList.add('completed');
                } else {
                    stepElement?.classList.remove('completed');
                }
            }

            // Initialize wizard state based on database completion
            const initialStep = findNextIncompleteStep();

            // Initialize wizard with a slight delay to ensure DOM is ready
            setTimeout(() => {
                safeUpdateWizardState(initialStep);
                updateOverallProgress();
                updateStepAccessibility();
            }, 100);

            // Function to safely update wizard state
            function safeUpdateWizardState(targetStep) {
                // Make sure all wizard contents are loaded
                if (wizardContents.length === 0) {
                    console.log('Waiting for wizard contents to load...');
                    setTimeout(() => safeUpdateWizardState(targetStep), 100);
                    return;
                }

                currentStep = targetStep;

                // Update wizard steps
                wizardSteps.forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                    } else if (isStepCompleted(stepNumber)) {
                        step.classList.add('completed');
                    }
                });

                // Update content visibility
                wizardContents.forEach(content => {
                    content.style.display = 'none'; // Hide all first
                    if (parseInt(content.dataset.step) === currentStep) {
                        content.style.display = 'block'; // Show current step
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });

                // Update button states
                document.querySelectorAll('.btn-prev').forEach(btn => {
                    btn.disabled = currentStep === 1;
                });

                // Update progress
                updateStepAccessibility();
                updateOverallProgress();

                // Scroll to active content
                const activeContent = document.querySelector('.wizard-content.active');
                if (activeContent) {
                    activeContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            // Check if we need to move to next step after refresh
            const nextStep = sessionStorage.getItem('nextStep');
            if (nextStep) {
                // Clear the stored next step
                sessionStorage.removeItem('nextStep');
                // Wait for a brief moment to ensure DOM is ready
                setTimeout(() => {
                    safeUpdateWizardState(parseInt(nextStep));
                }, 100);
            }

            // Function to check if a step is completed
            function isStepCompleted(stepNumber) {
                const content = document.querySelector(`.wizard-content[data-step="${stepNumber}"]`);
                if (!content) return false;

                let totalInstruments = 0;
                let selectedInstruments = 0;
                let allSavedInDatabase = true;

                content.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                    totalInstruments++;
                    const radioName = group.querySelector('input[type="radio"]')?.name;
                    const instrumenId = radioName?.replace('pilihan_', '');

                    if (instrumenId) {
                        const isInDatabase = dataTerpilihCurrent.hasOwnProperty(`pilihan_${instrumenId}`);

                        // All instruments are optional, just check if saved in database
                        if (isInDatabase) {
                            selectedInstruments++;
                        }
                    }
                });

                console.log(`Step ${stepNumber} completion check:`, {
                    totalInstruments,
                    selectedInstruments,
                    allSavedInDatabase
                });

                return totalInstruments > 0 && selectedInstruments === totalInstruments && allSavedInDatabase;
            }

            // Function to update step accessibility with database check
            function updateStepAccessibility() {
                wizardSteps.forEach((step, index) => {
                    const stepNumber = index + 1;
                    step.style.pointerEvents = 'auto';
                    step.style.opacity = '1';
                    step.removeAttribute('title');

                    // Active step must stay blue even if completed.
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                        return;
                    }

                    // Update completed status for non-active steps.
                    step.classList.remove('active');
                    if (isStepCompleted(stepNumber)) {
                        step.classList.add('completed');
                    } else {
                        step.classList.remove('completed');
                    }
                });
            }

            // Function to update overall progress bar
            function updateOverallProgress() {
                let totalInstrumentsAll = 0;
                let selectedInstrumentsAll = 0;
                let totalSteps = wizardContents.length;
                let ssProgress = 0;

                // Count all instruments and selected instruments across all steps
                wizardContents.forEach((content, index) => {
                    const stepNumber = index + 1;
                    let stepTotalInstruments = 0;
                    let stepSelectedInstruments = 0;

                    content.querySelectorAll('.d-flex.align-items-start.border').forEach(group => {
                        stepTotalInstruments++;
                        totalInstrumentsAll++;

                        const isWajib = group.querySelector('input[type="hidden"][name^="pilihan_"]') !== null;
                        const radioName = group.querySelector('input[type="radio"]')?.name;
                        const instrumenId = radioName?.replace('pilihan_', '');

                        // Check if instrument is selected (either wajib or has any selection)
                        if (isWajib) {
                            stepSelectedInstruments++;
                            selectedInstrumentsAll++;
                        } else if (instrumenId) {
                            const checkedRadio = group.querySelector(`input[name="pilihan_${instrumenId}"]:checked`);
                            if (checkedRadio) {
                                stepSelectedInstruments++;
                                selectedInstrumentsAll++;
                            }
                        }
                    });
                });

                // Update overall progress bar
                const progressBar = document.querySelector('.progress-bar');
                const progressPercentage = document.querySelector('.progress-percentage');
                const progressStatus = document.querySelector('.progress-status');

                if (progressBar && progressPercentage && progressStatus) {
                    // Calculate percentage based on total instruments selected vs total instruments
                    const overallPercentage = totalInstrumentsAll > 0
                        ? Math.round((selectedInstrumentsAll / totalInstrumentsAll) * 100)
                        : 0;

                    progressBar.style.width = `${overallPercentage}%`;
                    progressBar.setAttribute('aria-valuenow', overallPercentage);
                    progressPercentage.textContent = `${overallPercentage}%`;

                    if (overallPercentage === 100) {
                        progressStatus.textContent = 'Semua instrumen telah selesai dipilih';
                    } else if (overallPercentage > 0) {
                        progressStatus.textContent = `${selectedInstrumentsAll}/${totalInstrumentsAll} instrumen telah dipilih (Progress: ${overallPercentage}%)`;
                    } else {
                        progressStatus.textContent = 'Belum ada instrumen yang dipilih';
                    }
                }
            }

            // Add event listener for radio button changes
            document.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const instrumenId = this.name.replace('pilihan_', '');
                    updateComparisonBadge(instrumenId);
                    updateCurrentStepProgress();
                    updateOverallProgress();
                    updateStepAccessibility(); // Update accessibility after any change
                });
            });

            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ssId = this.dataset.ssId;

                    if (!validateCurrentStep()) {
                        return;
                    }

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Konfirmasi Pengisian',
                        text: "Apakah Anda yakin dengan pilihan Anda? Data yang sudah disimpan tidak dapat diubah kembali.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            button.setAttribute('data-kt-indicator', 'on');
                            button.disabled = true;

                            // Prepare form data for current SS
                            const currentContent = document.querySelector(`.wizard-content[data-step="${currentStep}"]`);
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('input[name="_token"]').value);
                            formData.append('auditee_id', document.querySelector('input[name="auditee_id"]').value);
                            formData.append('satuan_standar_id', ssId);

                            currentContent.querySelectorAll('input[type="radio"]:checked, input[type="hidden"]').forEach(input => {
                                formData.append(input.name, input.value);
                            });

                            // Send AJAX request
                            $.ajax({
                                url: '{{ route("auditee.pengajuanAmi.saveIkssSS") }}',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    // Reset button state
                                    button.removeAttribute('data-kt-indicator');
                                    button.disabled = false;

                                    if (response.success) {
                                        // Show success message
                                        Swal.fire({
                                            text: "Data berhasil disimpan!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then((result) => {
                                            if (currentStep < wizardSteps.length) {
                                                // Save next step to session storage
                                                const nextStep = currentStep + 1;
                                                sessionStorage.setItem('nextStep', nextStep.toString());

                                                // Force a complete page reload
                                                window.location.replace(window.location.href);
                                            } else {
                                                // If it's the last step
                                                Swal.fire({
                                                    text: "Semua Sasaran Strategis telah berhasil diisi!",
                                                    icon: "success",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "OK",
                                                    customClass: {
                                                        confirmButton: "btn btn-primary"
                                                    }
                                                }).then((result) => {
                                                    window.location.replace(window.location.href);
                                                });
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "OK",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    // Reset button state
                                    button.removeAttribute('data-kt-indicator');
                                    button.disabled = false;

                                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }

                                    Swal.fire({
                                        text: errorMessage,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });

        // Simple debug for scroll
        $(document).ready(function() {
            setTimeout(function() {
                const nav = $('.wizard-nav')[0];
                if (nav) {
                    console.log('Scroll width:', nav.scrollWidth, 'Client width:', nav.clientWidth);
                    console.log('Can scroll:', nav.scrollWidth > nav.clientWidth);
                }
            }, 1000);

            // Add drag scrolling functionality
            const wizardNav = $('.wizard-nav');
            let isDown = false;
            let startX;
            let scrollLeft;
            let movedDuringDrag = false;

            wizardNav.on('mousedown', function(e) {
                isDown = true;
                movedDuringDrag = false;
                wizardNav.addClass('dragging');
                startX = e.pageX - wizardNav.offset().left;
                scrollLeft = wizardNav.scrollLeft();
            });

            wizardNav.on('mouseleave mouseup', function() {
                isDown = false;
                wizardNav.removeClass('dragging');
            });

            wizardNav.on('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - wizardNav.offset().left;
                const walk = (x - startX) * 2; // Scroll speed multiplier
                if (Math.abs(walk) > 5) {
                    movedDuringDrag = true;
                }
                wizardNav.scrollLeft(scrollLeft - walk);
            });

            // Prevent accidental step click when user is dragging.
            wizardNav.find('.wizard-step').on('click', function(e) {
                if (movedDuringDrag) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });

            // Unified wheel/trackpad scrolling handler
            wizardNav.on('wheel', function(e) {
                const nav = this;
                if (nav.scrollWidth <= nav.clientWidth) {
                    return;
                }

                // Handle both trackpad horizontal scroll and mouse wheel
                const deltaX = e.originalEvent.deltaX;
                const deltaY = e.originalEvent.deltaY;

                // Use deltaX if available (trackpad horizontal scroll), otherwise use deltaY (mouse wheel)
                if (deltaX !== 0) {
                    e.preventDefault();
                    nav.scrollLeft += deltaX;
                } else if (deltaY !== 0) {
                    e.preventDefault();
                    nav.scrollLeft += deltaY;
                }
            }, { passive: false });

            // Add trackpad swipe support using pointer events
            let pointerStartX = 0;
            let pointerStartY = 0;
            let isPointerDown = false;

            wizardNav.on('pointerdown', function(e) {
                isPointerDown = true;
                pointerStartX = e.pageX;
                pointerStartY = e.pageY;
                wizardNav.css('cursor', 'grabbing');
            });

            wizardNav.on('pointerup pointerleave', function(e) {
                isPointerDown = false;
                wizardNav.css('cursor', 'grab');
            });

            wizardNav.on('pointermove', function(e) {
                if (!isPointerDown) return;

                const deltaX = e.pageX - pointerStartX;
                const deltaY = e.pageY - pointerStartY;

                // Only scroll if horizontal movement is greater than vertical
                if (Math.abs(deltaX) > Math.abs(deltaY)) {
                    e.preventDefault();
                    wizardNav.scrollLeft(wizardNav.scrollLeft() - deltaX);
                    pointerStartX = e.pageX;
                }
            });

            // Add touch swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            wizardNav.on('touchstart', function(e) {
                touchStartX = e.originalEvent.changedTouches[0].screenX;
            }, { passive: true });

            wizardNav.on('touchend', function(e) {
                touchEndX = e.originalEvent.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe left - scroll right
                        wizardNav[0].scrollLeft += 200;
                    } else {
                        // Swipe right - scroll left
                        wizardNav[0].scrollLeft -= 200;
                    }
                }
            }
        });

            // Fungsi untuk copy pilihan dari periode sebelumnya
            function copyFromPreviousPeriod() {
                // Data dari PHP
                const dataTerpilihPrevious = @json($dataTerpilihPrevious ?? []);
                const dataTerpilihCurrent = @json($dataTerpilihCurrent ?? []);

                // Cek validasi: ada minimal 1 perubahan yang conflict
                const conflicts = [];
                const newSelections = [];
                const removedSelections = [];

                // Cek instrumen yang status_target berubah
                for (const [key, prevValue] of Object.entries(dataTerpilihPrevious)) {
                    const currentValue = dataTerpilihCurrent[key];

                    if (currentValue === undefined) {
                        // Baru dipilih di periode sebelumnya, belum ada di periode aktif
                        newSelections.push(key);
                    } else if (currentValue !== prevValue) {
                        // Status berubah: jadi conflict
                        conflicts.push({
                            key: key,
                            prev: prevValue,
                            current: currentValue
                        });
                    }
                }

                // Cek instrumen yang sebelumnya dipilih tapi sekarang tidak
                for (const [key, currentValue] of Object.entries(dataTerpilihCurrent)) {
                    if (dataTerpilihPrevious[key] === undefined && currentValue === 1) {
                        // Dulu dipilih (1), sekarang tidak ada di previous (berarti 0)
                        removedSelections.push(key);
                    }
                }

                // Jika ada conflict, tampilkan peringatan
                if (conflicts.length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: '⚠️ Tidak Dapat Menggunakan Pilihan Sama',
                        html: `
                            <div class="text-start">
                                <p class="mb-3">Terdapat <strong class="text-danger">${conflicts.length} perubahan status pilihan IKSS</strong> antara periode sebelumnya dan periode aktif saat ini:</p>
                                <ul class="mb-3 small">
                                    ${conflicts.slice(0, 5).map(c => `<li>Instrumen ${c.key.replace('pilihan_', '')}: Dulu <strong>${c.prev === 1 ? 'Dipilih' : 'Tidak Dipilih'}</strong>, sekarang <strong>${c.current === 1 ? 'Dipilih' : 'Tidak Dipilih'}</strong></li>`).join('')}
                                    ${conflicts.length > 5 ? `<li>...dan ${conflicts.length - 5} lainnya</li>` : ''}
                                </ul>
                                <p class="text-muted small">Anda harus memilih manual instrumen yang ingin digunakan.</p>
                            </div>
                        `,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#f64e60'
                    });
                    return;
                }

                // Jika ada yang baru dipilih di periode sebelumnya tapi belum ada di periode aktif
                if (newSelections.length > 0) {
                    Swal.fire({
                        icon: 'question',
                        title: 'Gunakan Pilihan Sama dengan Periode Sebelumnya?',
                        html: `
                            <div class="text-start">
                                <p class="mb-3">Akan <strong>menambah ${newSelections.length} pilihan IKSS</strong> dari periode sebelumnya:</p>
                                <p class="text-muted small">Pilihan IKSS yang sudah ada di periode aktif akan tetap dipertahankan.</p>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Gunakan',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#009EF7'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form dengan pilihan dari periode sebelumnya
                            submitCopyFromPrevious();
                        }
                    });
                    return;
                }

                // Jika semua sama, beri info
                Swal.fire({
                    icon: 'info',
                    title: 'Pilihan Sama dengan Periode Sebelumnya',
                    text: 'Pilihan IKSS di periode aktif sudah sama dengan periode sebelumnya. Tidak ada perubahan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#009EF7'
                });
            }

            function submitCopyFromPrevious() {
                const dataTerpilihPrevious = @js($dataTerpilihPrevious);
                const auditeeId = @js(Auth::user()->unit_kerja_id);

                // Prepare form data
                const formData = new FormData();
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('auditee_id', {{ Auth::user()->unit_kerja_id }});

                // Tambahkan semua pilihan dari periode sebelumnya
                for (const [key, value] of Object.entries(dataTerpilihPrevious)) {
                    const instrumenId = key.replace('pilihan_', '');
                    // Hanya tambahkan yang belum ada di current
                    if (@js($dataTerpilihCurrent)[key] === undefined) {
                        formData.append(key, value);
                    }
                }

                // Show loading
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit via AJAX
                $.ajax({
                    url: '{{ route("auditee.pengajuanAmi.saveIkss") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: `Pilihan IKSS dari periode sebelumnya berhasil disimpan! (${response.saved_count} instrumen)`,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
    </script>
@endpush
