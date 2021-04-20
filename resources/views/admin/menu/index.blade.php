@extends('admin.public.template')

@section('title', '菜单列表')

@push('styles')
    <link href="{{ asset('js/plugins/treetable/jquery.treetable.css') }}" rel="stylesheet"/>
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
    				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">菜单列表</h5>
    				<!--end::Page Title-->
    				<!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">后台管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">菜单列表</a>
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
						<h3 class="card-label">菜单列表</h3>
					</div>
					<div class="card-toolbar">
                        @can ('menu/file', $method::PUT)
                        <a href="javascript:updateFile();" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="la la-refresh"></i>更新文件
                            </a>
                        @endcan
                        @can ('menu/create', $method::GET)
                            <!--begin::Button-->
                            <a href="{{ url('menu/create') }}" class="btn btn-primary font-weight-bolder">
                                <i class="la la-plus"></i>添加菜单
                            </a>
                            <!--end::Button-->
                        @endcan
					</div>
				</div>
                <div class="card-body pt-0 pb-3">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>菜单名称</th>
                                    <th>访问路由</th>
                                    <th>请求方式</th>
                                    <th>是否显示</th>
                                    <th>是否验证</th>
                                    <th>菜单排序</th>
                                    <th width="150">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $add = verifyAccess('menu/create', $method::GET);
                                    $edit = verifyAccess('menu/*/edit', $method::GET);
                                    $delete = verifyAccess('menu/*', $method::DELETE);
                                    $sort = verifyAccess('menu/*/sort', $method::PUT);
                                @endphp
                                @foreach ($menus as $menu)
                                    <tr data-tt-id="{{ $menu->id }}" data-tt-parent-id="{{ $menu->parent_id }}" key="{{ $menu->id }}">
                                        <td></td>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->route }}</td>
                                        <td>{{ $method::name($menu->method) }}</td>
                                        <td>{{ $menu->is_show ? '是' : '否' }}</td>
                                        <td>{{ $menu->is_verify ? '是' : '否' }}</td>
                                        <td>
                                            <input type="text" class="form-control" value="{{ $menu->sequence }}" @unless ($sort) disabled="disabled" @endunless>
                                        </td>
                                        <td>
                                            @if ($add)
                                                <a href="{{ url('menu/create?parent_id=' . $menu->id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="添加子级">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            @endif
                                            @if ($edit)
                                                <a href="{{ url('menu/' . $menu->id . '/edit') }}" class="btn btn-sm btn-clean btn-icon mr-2" title="编辑数据">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                            @if ($delete)
                                                <a href="{{ url('menu/' . $menu->id) }}" class="btn btn-sm btn-clean btn-icon mr-2 destroy" title="删除数据">
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
                </div>
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/plugins/treetable/jquery.treetable.js') }}"></script>
    <script src="{{ asset('admin/js/menu/index.js') }}"></script>
@endpush