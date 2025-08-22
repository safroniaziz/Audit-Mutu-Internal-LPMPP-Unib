@extends('layouts.dashboard2')
@section('userName')
    {{ Auth::user()->name }}
@endsection
@section('website')
    {{ Auth::user()->unitKerja ? Auth::user()->unitKerja->website : '-' }}
@endsection
@section('userEmail')
    {{ Auth::user()->email }}
@endsection
@section('content')
    <!--begin::Navbar-->

    <!--end::Navbar-->
    @yield('dashboardProfile')
@endsection
