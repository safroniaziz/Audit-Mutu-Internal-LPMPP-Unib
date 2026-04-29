@extends('errors.layout')

@section('code', '404')
@section('title', 'Halaman Tidak Ditemukan')
@section('description', 'Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.')

@section('badge-class', 'bg-blue-100 text-blue-600')
@section('badge-icon', 'fas fa-search')
@section('border-color', 'border-blue-400')
@section('icon-bg', 'bg-blue-400')
@section('info-icon', 'fas fa-question-circle')
@section('info-title', 'Apa yang dapat Anda lakukan?')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Periksa kembali URL yang Anda masukkan</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Kembali ke halaman sebelumnya</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Gunakan menu navigasi untuk mencari</li>
@endsection

@section('buttons')
<a href="{{ url('/') }}" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-home mr-2"></i> Beranda
</a>
<a href="javascript:history.back()" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-arrow-left mr-2"></i> Kembali
</a>
@endsection
