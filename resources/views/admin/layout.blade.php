<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
@include('admin.layouts.header')

<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <!--begin::Main-->
    <input type="hidden" id="base_url" value="{{url('/')}}/" />
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            @include('admin.layouts.aside')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('admin.layouts.bodyheader')
                <!--end::Header-->
                <!--begin::Content-->
                @yield('content')
                <!--end::Content-->
                <!--begin::Footer-->
                @include('admin.layouts.bodyfooter')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Drawers-->

    @include('admin.layouts.footer')

</body>
<!--end::Body-->

</html>