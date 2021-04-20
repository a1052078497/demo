@extends('admin.public.template')

@section('title', '添加管理员')

@section('content')
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
    				<!--begin::Page Title-->
    				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">添加管理员</h5>
    				<!--end::Page Title-->
    				<!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">后台管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin') }}" class="text-muted">管理员列表</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">添加管理员</a>
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
                <div class="card-header py-3">
                    <h3 class="card-title">添加管理员</h3>
                </div>
                <form class="form" method="post" action="{{ url('admin') }}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 所属身份</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="identity_id">
                                    <option value="">-请选择-</option>
                                    @foreach ($identities as $identity)
                                        <option value="{{ $identity->id }}">{{ $identity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 用户名</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="username" placeholder="请输入用户名">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 密码</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control password" name="password" placeholder="请输入密码">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 确认密码</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="请再次输入密码">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can ('admin', $method::POST)
                                    <button type="submit" class="btn btn-primary mr-2">提交</button>
                                @endcan
                                <button type="reset" class="btn btn-light-primary">重置</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/public/validate.js') }}"></script>
    <script src="{{ asset('admin/js/admin/createAndEdit.js') }}"></script>
@endpush