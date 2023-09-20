<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:url" content="https://gww-app.co.za/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Occupational Therapy">
    <meta property="og:description" content="Occupational Therapy">
    <meta property="og:image" content="{{ asset('public/assets/logo.png')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="gww-app.co.za">
    <meta property="twitter:url" content="https://gww-app.co.za/">
    <meta name="twitter:title" content="Occupational Therapy">
    <meta name="twitter:description" content="Occupational Therapy">
    <meta name="twitter:image" content="{{ asset('public/assets/logo.png')}}">

    <title>Occupational Therapy</title>
    <link rel="shortcut icon" href="{{asset('public/assets/favicon.ico')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('public/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        label.error {
            color: red;
        }
    </style>
</head>

<body>
    <input type="hidden" id="base_url" value="{{url('/')}}/" />
    <div class="container">
        @yield('content')
    </div>

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('public/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('public/assets/js/scripts.bundle.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    @if(isset($js))
    @foreach($js as $value)
    <script src="{{ asset('public/assets/admin/') }}/js/{{$value}}.js"></script>
    @endforeach
    @endif
</body>

</html>