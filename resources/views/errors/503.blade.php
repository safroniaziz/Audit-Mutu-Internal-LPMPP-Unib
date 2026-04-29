@extends('errors.layout')

@section('code', '503')
@section('title', 'Sedang Maintenance')
@section('description', 'Sistem sedang dalam pemeliharaan terjadwal untuk meningkatkan layanan. Kami akan segera kembali.')

@section('badge-class', 'bg-green-100 text-green-600')
@section('badge-icon', 'fas fa-tools')
@section('border-color', 'border-green-400')
@section('icon-bg', 'bg-green-400')
@section('info-icon', 'fas fa-wrench')
@section('info-title', 'Apa yang sedang terjadi?')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Pemeliharaan rutin untuk stabilitas</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Update fitur dan perbaikan bug</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Perkiraan selesai beberapa menit</li>
@endsection

@section('buttons')
<a href="javascript:location.reload()" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sync-alt mr-2"></i> Coba Lagi
</a>
@endsection
