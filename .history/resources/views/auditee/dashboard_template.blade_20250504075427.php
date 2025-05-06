@extends('layouts.dashboard2')
@section('username')
    {{ Auth::user()->username }}
@endsection
@section('userName')
    {{ Auth::user()->nama_lengkap }}
@endsection
@section('userEmail')
    {{ Auth::user()->email }}
@endsection
@section('content')
    <!--begin::Navbar-->

    <!--end::Navbar-->
    @yield('dashboardProfile')
@endsection
