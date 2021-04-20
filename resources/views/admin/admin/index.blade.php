@extends('admin.public.template')

@section('title', '管理员列表')

@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">管理员列表</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">后台管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">管理员列表</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="" class="btn btn-light-primary font-weight-bolder btn-sm">刷新</a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header border-0 py-3">
                    <div class="card-title">
                        <span class="card-icon">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                                        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                                        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                                        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <h3 class="card-label">管理员列表</h3>
                    </div>
                    <div class="card-toolbar">
                        @can ('admin/create', $method::GET)
                            <!--begin::Button-->
                            <a href="{{ url('admin/create') }}" class="btn btn-primary font-weight-bolder">
                                <i class="la la-plus"></i>添加管理员
                            </a>
                            <!--end::Button-->
                        @endcan
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div class="mt-2 mb-7">
                        <form action="" method="get">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="keyword" placeholder="Search..." value="{{ $request->query('keyword') }}">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xl-4 mt-lg-0">
                                    <button class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>所属身份</th>
                                    <th width="150">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $edit = verifyAccess('admin/*/edit', $method::GET);
                                    $delete = verifyAccess('admin/*', $method::DELETE);
                                @endphp
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->username }}</td>
                                        <td>{{ $admin->identity->name ?? '' }}</td>
                                        <td>
                                            @if ($edit)
                                                <a href="{{ url('admin/' . $admin->id . '/edit') }}" class="btn btn-sm btn-clean btn-icon mr-2" title="编辑数据">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($delete)
                                                <a href="{{ url('admin/' . $admin->id) }}" class="btn btn-sm btn-clean btn-icon mr-2 destroy" title="删除数据">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                    <div class="d-flex justify-content-end">
                        {{ $admins->appends($request->query())->links() }}
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection