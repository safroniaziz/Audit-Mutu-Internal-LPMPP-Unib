@extends('errors.layout')

@section('code', '401')
@section('title', 'Tidak Terautentikasi')
@section('description', 'Anda perlu login terlebih dahulu untuk mengakses halaman ini. Silakan masuk dengan akun Anda.')

@section('badge-class', 'bg-cyan-100 text-cyan-600')
@section('badge-icon', 'fas fa-user-lock')
@section('border-color', 'border-cyan-400')
@section('icon-bg', 'bg-cyan-400')
@section('info-icon', 'fas fa-key')
@section('info-title', 'Untuk mengakses halaman ini:')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Login dengan email dan password</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Pastikan akun sudah terdaftar</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Hubungi admin jika lupa password</li>
@endsection

@section('buttons')
<a href="{{ url('/login') }}" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sign-in-alt mr-2"></i> Login Sekarang
</a>
<a href="{{ url('/') }}" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-home mr-2"></i> Beranda
</a>
@endsection
