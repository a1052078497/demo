@extends('admin.public.master')

@section('title', '出错了~')

@push('styles')
	<link href="{{ asset('metronic/css/pages/error/error-6.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('master-content')
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Error-->
		<div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('metronic/media/error/bg6.jpg') }});">
			<!--begin::Content-->
			<div class="d-flex flex-column flex-row-fluid text-center">
				<h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 12rem;">{{ $error['code'] }}</h1>
				<p class="display-4 font-weight-bold text-white">{{ $error['message'] }}</p>
			</div>
			<!--end::Content-->
		</div>
		<!--end::Error-->
	</div>
	<!--end::Main-->
@endsection