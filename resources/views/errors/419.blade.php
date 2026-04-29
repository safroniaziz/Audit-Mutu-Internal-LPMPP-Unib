@extends('errors.layout')

@section('code', '419')
@section('title', 'Sesi Telah Berakhir')
@section('description', 'Halaman ini sudah tidak aktif terlalu lama. Untuk keamanan akun Anda, silakan muat ulang halaman atau login kembali.')

@section('badge-class', 'bg-orange-100 text-orange-600')
@section('badge-icon', 'fas fa-clock')
@section('border-color', 'border-orange-400')
@section('icon-bg', 'bg-orange-400')
@section('info-icon', 'fas fa-exclamation-triangle')
@section('info-title', 'Mengapa ini terjadi?')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Halaman dibiarkan terbuka terlalu lama</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Token keamanan (CSRF) sudah kedaluwarsa</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Cukup refresh halaman untuk melanjutkan</li>
@endsection

@section('buttons')
<a href="javascript:location.reload()" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sync-alt mr-2"></i> Muat Ulang
</a>
<a href="{{ url('/login') }}" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-sign-in-alt mr-2"></i> Login
</a>
@endsection
