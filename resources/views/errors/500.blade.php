@extends('errors.layout')

@section('code', '500')
@section('title', 'Kesalahan Server')
@section('description', 'Maaf, terjadi kesalahan pada server kami. Tim teknis sudah diberitahu dan sedang bekerja untuk memperbaikinya.')

@section('badge-class', 'bg-purple-100 text-purple-600')
@section('badge-icon', 'fas fa-server')
@section('border-color', 'border-purple-400')
@section('icon-bg', 'bg-purple-400')
@section('info-icon', 'fas fa-cog')
@section('info-title', 'Yang dapat Anda lakukan:')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Muat ulang halaman ini</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Coba lagi dalam beberapa menit</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Hubungi admin jika berlanjut</li>
@endsection

@section('buttons')
<a href="javascript:location.reload()" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sync-alt mr-2"></i> Coba Lagi
</a>
<a href="{{ url('/') }}" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-home mr-2"></i> Beranda
</a>
@endsection
