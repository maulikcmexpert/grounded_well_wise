@extends('auth.layouts')

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{ asset('assets/logo.png')}}" class="h-200px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" method="POST" id="kt_sign_in_form" action="{{ route('authenticate') }}">
                    <!--begin::Heading-->
                    @csrf
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Sign Insss</h1>
                        <!--end::Title-->

                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email" value="{{ old('email') }}" autocomplete="off" />
                        <!--end::Input-->
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            <a href="{{route('forgot.password.get')}}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" />
                        <!--end::Input-->
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <input type="submit" class="btn btn-lg btn-primary w-100 mb-5" value="Continue">
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection