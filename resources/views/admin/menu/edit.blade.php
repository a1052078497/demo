@extends('admin.public.template')

@section('title', '编辑菜单')

@push('styles')
    <link href="{{ asset('metronic/plugins/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/menu/createAndEdit.css') }}" rel="stylesheet" type="text/css" />
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
    				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">编辑菜单</h5>
    				<!--end::Page Title-->
    				<!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">后台管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('menu') }}" class="text-muted">菜单列表</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">编辑菜单</a>
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
                    <h3 class="card-title">编辑菜单</h3>
                </div>
                <form class="form" method="post" action="{{ url('menu/' . $menu->id) }}">
                    <div class="card-body">
                    	<div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 所属上级</label>
                            <div class="col-lg-8">
                            	<div id="jstree" class="pt-lg-2"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 菜单名称</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name" placeholder="请输入菜单名称" value="{{ $menu->name }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 菜单图标</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="icon" placeholder="点击选择" readonly="readonly" value="{{ $menu->icon }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 菜单路由</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="route" placeholder="路由参数用*表示" value="{{ $menu->route }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 请求方式</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="method">
		                            <option value="">-请选择-</option>
		                            @foreach ($method::names() as $key => $name)
		                                <option value="{{ $key }}"
		                                	@if ($key == $menu->method) selected="" @endif
		                                >
		                                	{{ $name }}
		                            	</option>
		                            @endforeach
		                        </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="text-lg-right col-lg-3">
                            	<span class="text-danger">*</span> 是否显示
                            </label>
                            <div class="col-lg-8">
                            	<div class="radio-inline">
	                                <label class="radio radio-outline radio-success">
										<input type="radio" name="is_show" value="1" @if ($menu->is_show) checked="" @endif>
										<span></span>是
									</label>
									<label class="radio radio-outline radio-success">
										<input type="radio" name="is_show" value="0" @unless ($menu->is_show) checked="" @endunless>
										<span></span>否
									</label>
								</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="text-lg-right col-lg-3"><span class="text-danger">*</span> 是否验证</label>
                            <div class="col-lg-8">
                            	<div class="radio-inline">
	                                <label class="radio radio-outline radio-success">
										<input type="radio" name="is_verify" value="1" @if ($menu->is_verify) checked="" @endif>
										<span></span>是
									</label>
									<label class="radio radio-outline radio-success">
										<input type="radio" name="is_verify" value="0" @unless ($menu->is_verify) checked="" @endunless>
										<span></span>否
									</label>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can ('menu/*', $method::PUT)
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
    <div class="modal fade" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">选择图标</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.menu.icons')
                </div>
            </div>
        </div>
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
        var selected = @json($menu->parent_id);
    </script>
    <script src="{{ asset('admin/js/menu/createAndEdit.js') }}"></script>
@endpush