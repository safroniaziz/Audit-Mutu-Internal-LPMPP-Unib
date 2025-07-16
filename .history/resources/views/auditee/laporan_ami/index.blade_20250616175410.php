@extends('layouts.dashboard2')

@section('title', $title)

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $title }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">No</th>
                                    <th class="min-w-125px">Tahun</th>
                                    <th class="min-w-125px">Siklus</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Aksi</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                                @forelse ($amis as $ami)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ami->tahun }}</td>
                                        <td>{{ $ami->siklus->nama_siklus }}</td>
                                        <td>
                                            <span class="badge badge-light-success">{{ $ami->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('auditee.laporanAmi.download', $ami->id) }}"
                                               class="btn btn-sm btn-light-primary">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection
