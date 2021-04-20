@extends('admin.public.template')

@section('title', '编辑角色')

@push('styles')
    <link href="{{ asset('metronic/plugins/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
    				<!--begin::Page Title-->
    				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">编辑角色</h5>
    				<!--end::Page Title-->
    				<!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">后台管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('role') }}" class="text-muted">角色列表</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">编辑角色</a>
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
                    <h3 class="card-title">编辑角色</h3>
                </div>
                <form class="form" method="post" action="{{ url('role/' . $role->id) }}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 角色名称</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name" placeholder="请输入角色名称" value="{{ $role->name }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3">
                                <span class="text-danger">*</span> 权限设置
                                <br/>
                                <code class="font-weight-bolder">红色字体代表需要权限验证</code>
                            </label>
                            <div class="col-lg-8">
                                <div id="jstree" class="pt-lg-2"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3">角色描述</label>
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control" rows="5">{{ $role->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can ('role/*', $method::PUT)
                                    @method('PUT')
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

@push('metronic-scripts')
    <script src="{{ asset('metronic/plugins/custom/jstree/jstree.bundle.js') }}"></script>
@endpush

@push('scripts')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/public/validate.js') }}"></script>
    <script>
        var menus = @json($menus);
        var selected = @json($selected);
    </script>
    <script src="{{ asset('admin/js/role/createAndEdit.js') }}"></script>
@endpush