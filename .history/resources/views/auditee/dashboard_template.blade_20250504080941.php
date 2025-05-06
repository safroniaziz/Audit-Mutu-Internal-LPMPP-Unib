@extends('layouts.dashboard2')
@section('userName')
    {{ Auth::user()->name }}
@endsection
@section('website')
    {{ Auth::user()->username }}
@endsection
@section('userEmail')
    {{ Auth::user()->email }}
@endsection
@section('content')
    <!--begin::Navbar-->

    <!--end::Navbar-->
    @yield('dashboardProfile')
@endsection
