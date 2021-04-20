<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>@yield('title')</title>
		<meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="{{ asset('css/poppins.css') }}" />
		<!--end::Fonts-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('metronic/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ asset('metronic/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link href="{{ asset('admin/css/public/common.css') }}" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="{{ asset('metronic/media/logos/favicon.ico') }}" />
		@stack('styles')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		@yield('master-content')
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = {};</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('metronic/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('metronic/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('metronic/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('metronic/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
		@stack('metronic-scripts')
		<!--end::Global Theme Bundle-->
		<script src="{{ asset('admin/js/public/common.js') }}"></script>
		@stack('scripts')
	</body>
	<!--end::Body-->
</html>