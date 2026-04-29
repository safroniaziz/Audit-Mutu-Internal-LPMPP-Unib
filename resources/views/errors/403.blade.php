@extends('errors.layout')

@section('code', '403')
@section('title', 'Akses Ditolak')
@section('description', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.')

@section('badge-class', 'bg-red-100 text-red-600')
@section('badge-icon', 'fas fa-ban')
@section('border-color', 'border-red-400')
@section('icon-bg', 'bg-red-400')
@section('info-icon', 'fas fa-lock')
@section('info-title', 'Kemungkinan penyebab:')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Anda belum login ke sistem</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Role akun tidak memiliki akses</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Fitur dibatasi untuk pengguna tertentu</li>
@endsection

@section('buttons')
<a href="{{ url('/login') }}" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sign-in-alt mr-2"></i> Login
</a>
<a href="{{ url('/') }}" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-home mr-2"></i> Beranda
</a>
@endsection
