@extends('errors.layout')

@section('code', '429')
@section('title', 'Terlalu Banyak Request')
@section('description', 'Anda telah mengirim terlalu banyak permintaan dalam waktu singkat. Silakan tunggu beberapa saat.')

@section('badge-class', 'bg-amber-100 text-amber-600')
@section('badge-icon', 'fas fa-tachometer-alt')
@section('border-color', 'border-amber-400')
@section('icon-bg', 'bg-amber-400')
@section('info-icon', 'fas fa-bolt')
@section('info-title', 'Mengapa ini terjadi?')

@section('info-list')
<li><i class="fas fa-check mr-2 text-green-300"></i> Rate limit tercapai</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Tunggu 1-2 menit sebelum coba lagi</li>
<li><i class="fas fa-check mr-2 text-green-300"></i> Hindari refresh berulang kali</li>
@endsection

@section('buttons')
<a href="javascript:location.reload()" class="primary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg text-white font-medium">
    <i class="fas fa-sync-alt mr-2"></i> Coba Lagi
</a>
<a href="{{ url('/') }}" class="secondary-btn flex-1 flex justify-center items-center py-3 px-6 rounded-lg bg-gray-100 text-gray-700 font-medium hover:bg-gray-200">
    <i class="fas fa-home mr-2"></i> Beranda
</a>
@endsection
