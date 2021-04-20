@extends('admin.public.master')

@section('title', '登录')

@push('styles')
	<link href="{{ asset('metronic/css/pages/login/classic/login-5.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('master-content')
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
			<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"  style="background-image: url({{ asset('metronic/media/bg/bg-2.jpg') }});">
				<div class="login-form text-center text-white p-7 position-relative overflow-hidden">
					<!--begin::Login Header-->
					<div class="d-flex flex-center mb-15">
						<a href="javascript:;">
							<img src="{{ asset('metronic/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt="" />
						</a>
					</div>
					<!--end::Login Header-->
					<!--begin::Login Sign in form-->
					<div class="mb-20">
						<h3 class="opacity-40 font-weight-normal">Sign In To Admin</h3>
						<p class="opacity-40">Enter your details to login to your account:</p>
					</div>
					<form class="form" method="post" action="{{ url('login') }}">
						<div class="form-group">
							<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="请输入用户名" name="username" autocomplete="off" />
						</div>
						<div class="form-group">
							<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="请输入密码" name="password" />
						</div>
						<div class="form-group text-center mt-10">
							<button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In</button>
						</div>
					</form>
					<!--end::Login Sign in form-->
				</div>
			</div>
		</div>
		<!--end::Login-->
	</div>
@endsection

@push('scripts')
	<script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/public/validate.js') }}"></script>
    <script src="{{ asset('admin/js/admin/login.js') }}"></script>
@endpush