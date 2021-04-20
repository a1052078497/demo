@extends('admin.public.template')

@section('title', '网站配置')

@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">网站配置</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">网站管理</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted">网站配置</a>
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
                    <h3 class="card-title">网站配置</h3>
                </div>
                <form class="form" method="post" action="{{ url('config/site') }}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站图标</label>
                            <div class="col-lg-8 choice-file-box">
                                <input type="file" class="choice-file-control" name="icon" accept=".ico" />
                                <div class="choice-file-error">
                                    <div class="input-group choice-file-puppet">
                                        <input type="text" class="form-control choice-file-input" name="icon_text" placeholder="点击选择文件" value="{{ $site['icon'] }}" data-error-append-to=".choice-file-error" />
                                        <div class="input-group-append">
                                            <button class="btn btn-light border border-secondary" type="button">选择文件</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站logo</label>
                            <div class="col-lg-8 choice-file-box">
                                <input type="file" class="choice-file-control" name="logo" accept=".png,.jpg,.jpeg" />
                                <div class="choice-file-error">
                                    <div class="input-group choice-file-puppet">
                                        <input type="text" class="form-control choice-file-input" name="logo_text" placeholder="点击选择文件" value="{{ $site['logo'] }}" data-error-append-to=".choice-file-error" />
                                        <div class="input-group-append">
                                            <button class="btn btn-light border border-secondary" type="button">选择文件</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站名称</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name" placeholder="请输入网站名称" value="{{ $site['name'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站标题</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="title" placeholder="请输入网站标题" value="{{ $site['title'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站关键词</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="keywords" placeholder="请输入网站关键词" value="{{ $site['keywords'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站描述</label>
                            <div class="col-lg-8">
                                <textarea name="description" class="form-control" rows="5">{{ $site['description'] }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-lg-right col-lg-3"><span class="text-danger">*</span> 网站备案号</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="icp" placeholder="请输入网站备案号" value="{{ $site['icp'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                @can ('config/site', $method::PUT)
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

@push('scripts')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/public/validate.js') }}"></script>
    <script src="{{ asset('admin/js/config/editSite.js') }}"></script>
@endpush