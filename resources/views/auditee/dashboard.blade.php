@extends('auditee/dashboard_template')

@section('dashboardProfile')
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center p-5 mb-6">
            <i class="fas fa-check-circle fs-2 text-success me-3"></i>
            <div class="fw-semibold">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-start p-5 mb-6">
            <i class="fas fa-exclamation-triangle fs-2 text-danger me-3 mt-1"></i>
            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row g-5 g-xl-8">
        <!-- Kolom Kiri: Informasi Selamat Datang -->
        <div class="col-xl-7">
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-semibold m-0 text-primary d-flex align-items-center gap-2">
                            👋 Selamat Datang Kaprodi, <span class="fw-bold">{{ Auth::user()->name }}</span>
                        </h3>
                    </div>
                </div>
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="alert alert-info d-flex align-items-start p-5 position-relative">
                        <div class="me-4">
                            <i class="bi bi-info-circle-fill fs-2 text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-dark mb-2">📢 Informasi Periode Aktif</h4>
                            <div class="fs-6 text-gray-700">
                                <p>
                                    <strong>Saat ini, periode yang sedang aktif adalah</strong>
                                    <span class="fw-semibold text-primary">
                                        Nomor Surat: {{ $periodeAktif ? $periodeAktif->nomor_surat : 'Data tidak tersedia' }}
                                    </span>
                                </p>
                                <p>
                                    <strong>Tahun AMI:</strong>
                                    <span class="fw-semibold text-primary">
                                        {{ $periodeAktif ? $periodeAktif->tahun_ami : 'Data tidak tersedia' }}
                                    </span>
                                </p>
                                <p>
                                    <strong>Jadwal input data oleh auditee:</strong>
                                    <span class="fw-semibold text-primary">
                                        @if ($jadwalData)
                                            @if ($jadwalData->waktu_mulai && $jadwalData->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($jadwalData->waktu_mulai)->format('d F Y') }} - {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('d F Y') }}
                                            @elseif ($jadwalData->waktu_selesai)
                                                Berakhir pada {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('d F Y') }} pukul {{ \Carbon\Carbon::parse($jadwalData->waktu_selesai)->format('H:i') }}
                                            @else
                                                Data tidak tersedia
                                            @endif
                                        @else
                                            Data tidak tersedia
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('auditee.pengajuanAmi') }}" class="btn btn-sm btn-primary px-4"><i class="fas fa-arrow-right me-2"></i> Ajukan Permohonan</a>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>

        <!-- Kolom Kanan: Tanda Tangan Auditee -->
        <div class="col-xl-5">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title text-primary fw-bold">
                        <i class="fas fa-signature fs-2 me-2"></i> Tanda Tangan Auditee
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-muted fs-7 mb-2">TTD saat ini</div>
                        <div class="border rounded p-4 text-center bg-light position-relative">
                            @if (Auth::user()->ttd)
                                <img src="{{ asset('storage/' . Auth::user()->ttd) }}" alt="TTD Auditee" style="max-height: 90px;">
                                <form action="{{ route('auditee.deleteTtd') }}" method="POST" class="position-absolute top-0 end-0 m-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-sm btn-light-danger" data-bs-toggle="tooltip" title="Hapus Tanda Tangan" onclick="return confirm('Apakah Anda yakin ingin menghapus tanda tangan saat ini?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Belum ada tanda tangan</span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('auditee.updateTtd') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload TTD Baru (PNG/JPG, maks 2MB)</label>
                            <input type="file" name="ttd" accept=".png,.jpg,.jpeg" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i> Simpan TTD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
