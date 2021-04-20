@extends('admin.public.master')

@section('master-content')
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
		<!--begin::Logo-->
		<a href="index.html">
			<img alt="Logo" src="{{ asset('metronic/media/logos/logo-light.png') }}" />
		</a>
		<!--end::Logo-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<!--begin::Aside Mobile Toggle-->
			<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
				<span></span>
			</button>
			<!--end::Aside Mobile Toggle-->
			<!--begin::Topbar Mobile Toggle-->
			<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>
					<!--end::Svg Icon-->
				</span>
			</button>
			<!--end::Topbar Mobile Toggle-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Aside-->
			<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
				<!--begin::Brand-->
				<div class="brand flex-column-auto" id="kt_brand">
					<!--begin::Logo-->
					<a href="javascript:;" class="brand-logo">
						<img alt="Logo" src="{{ asset('metronic/media/logos/logo-light.png') }}" />
					</a>
					<!--end::Logo-->
					<!--begin::Toggle-->
					<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
						<span class="svg-icon svg-icon svg-icon-xl">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
									<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
					</button>
					<!--end::Toolbar-->
				</div>
				<!--end::Brand-->
				<!--begin::Aside Menu-->
				<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
					<!--begin::Menu Container-->
					<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
						<!--begin::Menu Nav-->
						<ul class="menu-nav">
							@foreach ($asideMenus as $menu)
								@php
	                                $hasSon = $menu->sons->isNotEmpty();
	                            @endphp
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="{{ $menu->route ? url($menu->route) : 'javascript:;' }}" class="menu-link {{ ! $hasSon ?: 'menu-toggle' }}">
										<i class="menu-icon {{ $menu->icon }}"></i>
										<span class="menu-text">{{ $menu->name }}</span>
										@if ($hasSon)
											<i class="menu-arrow"></i>
										@endif
									</a>
									@if ($hasSon)
										<div class="menu-submenu">
											<i class="menu-arrow"></i>
											<ul class="menu-subnav">
												<li class="menu-item menu-item-parent" aria-haspopup="true">
													<span class="menu-link">
														<span class="menu-text">{{ $menu->name }}</span>
													</span>
												</li>
												@foreach ($menu->sons as $menu)
													<li class="menu-item" aria-haspopup="true">
														<a href="{{ url($menu->route) }}" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">{{ $menu->name }}</span>
														</a>
													</li>
												@endforeach
											</ul>
										</div>
									@endif
								</li>
							@endforeach
						</ul>
						<!--end::Menu Nav-->
					</div>
					<!--end::Menu Container-->
				</div>
				<!--end::Aside Menu-->
			</div>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header header-fixed">
					<!--begin::Container-->
					<div class="container-fluid d-flex align-items-stretch justify-content-end">
						<!--begin::Topbar-->
						<div class="topbar">
							<!--begin::Search-->
							<div class="dropdown" id="kt_quick_search_toggle">
								<!--begin::Toggle-->
								<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
									<div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
										<span class="svg-icon svg-icon-xl svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
								</div>
								<!--end::Toggle-->
								<!--begin::Dropdown-->
								<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
									<div class="quick-search quick-search-dropdown">
										<!--begin:Form-->
										<form action="https://www.baidu.com/s" method="get" target="_blank" class="quick-search-form">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<span class="svg-icon svg-icon-lg">
															<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
												<input type="text" class="form-control" name="wd" placeholder="Search..." />
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
													</span>
												</div>
											</div>
										</form>
										<!--end::Form-->
										<!--begin::Scroll-->
										<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
										<!--end::Scroll-->
									</div>
								</div>
								<!--end::Dropdown-->
							</div>
							<!--begin::User-->
							<div class="topbar-item">
								<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
									<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
									<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->username }}</span>
									<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
										<span class="symbol-label font-size-h5 font-weight-bold">{{ ucfirst(Auth::user()->username[0]) }}</span>
									</span>
								</div>
							</div>
							<!--end::User-->
						</div>
						<!--end::Topbar-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					@yield('content')
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-muted font-weight-bold mr-2">2020©</span>
							<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
						</div>
						<!--end::Copyright-->
						<!--begin::Nav-->
						<div class="nav nav-dark">
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">About</a>
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">Team</a>
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
						</div>
						<!--end::Nav-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Main-->
	<!-- begin::User Panel-->
	<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
		<!--begin::Header-->
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
			<h3 class="font-weight-bold m-0">用户状况
			<small class="text-muted font-size-sm ml-2"></small></h3>
			<a href="javascript:;" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
				<i class="ki ki-close icon-xs text-muted"></i>
			</a>
		</div>
		<!--end::Header-->
		<!--begin::Content-->
		<div class="offcanvas-content pr-5 mr-n5">
			<!--begin::Header-->
			<div class="d-flex align-items-center mt-5">
				<div class="symbol symbol-100 mr-5">
					<div class="symbol-label" style="background-image:url('{{ asset('metronic/media/users/300_21.jpg') }}')"></div>
					<i class="symbol-badge bg-success"></i>
				</div>
				<div class="d-flex flex-column">
					<a href="javascript:;" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->username }}</a>
					<a href="{{ url('password/edit') }}" class="text-muted mt-1">修改密码</a>
					<div class="navi mt-2">
						<a href="{{ url('logout') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">退出登录</a>
					</div>
				</div>
			</div>
			<!--end::Header-->
		</div>
		<!--end::Content-->
	</div>
	<!-- end::User Panel-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
					<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</div>
	<!--end::Scrolltop-->
@endsection

@push('scripts')
	<script>
		var allMenus = @json($allMenus);
	</script>
	<script src="{{ asset('admin/js/public/template.js') }}"></script>
@endpush