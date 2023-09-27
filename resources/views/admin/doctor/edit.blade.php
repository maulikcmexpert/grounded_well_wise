<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Update Therapist</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">

                        <a href="@if($role_id == 2) {{ route('staff.dashboard') }}@elseif($role_id == 3 || $role_id == 4) {{route('doctor.dashboard') }}@else  {{route('admin.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('doctor.index') }} @endif" class="text-muted text-hover-primary">Therapist List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Therapist Doctor</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card ">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    begin::Card title
                    <div class="card-title">
                        Update Doctor
                    </div>
                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('doctor.update',$doctorId)}}" id="DoctorUpdateForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $doctorId }}">
                        <div class="d-flex flex-column scroll-y me-n7 pe-7 docterupdate-detail" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="d-block fw-bold fs-6 mb-8">Avatar</label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ Storage::url('doctor/'.$doctorDetail[0]->image) }}');"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar">
                                        <input type="hidden" name="avatar_remove" value="{{ $doctorDetail[0]->image}}">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->

                                    <!--end::Cancel-->

                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                @if ($errors->has('avatar'))
                                <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
                                <label id="avatar-error" class="error" for="avatar"></label>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">First Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="first_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{ $doctorDetail[0]->first_name}}">
                                        <!--end::Input-->
                                        @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Last Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="last_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Last Name" value="{{ $doctorDetail[0]->last_name}}">
                                        <!--end::Input-->
                                        @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Contact Number</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="contact_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contact Number" value="{{ $doctorDetail[0]->doctorDetails->contact_number}}">
                                        <!--end::Input-->
                                        @if ($errors->has('contact_number'))
                                        <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Date Of Birth</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date" name="date_of_birth" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Date Of Birth" value="{{ $doctorDetail[0]->doctorDetails->date_of_birth}}">
                                        <!--end::Input-->
                                        @if ($errors->has('date_of_birth'))
                                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Indentification Number</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="identity_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Indentification Number" value="{{ $doctorDetail[0]->identity_number}}">
                                        <!--end::Input-->
                                        @if ($errors->has('identity_number'))
                                        <span class="text-danger">{{ $errors->first('identity_number') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Profession</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="profession" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Profession" value="{{ $doctorDetail[0]->doctorDetails->profession}}">
                                        <!--end::Input-->
                                        @if ($errors->has('profession'))
                                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{$doctorDetail[0]->email}}">
                                        <!--end::Input-->
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Gender</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="d-flex gender gap-5">
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <!-- <input type="radio" name="gender" class="" value="Male" checked class="form-check-input">
                                            <label class="fs-6 me-1 form-check-label">Male</label> -->
                                                <input type="radio" id="test1" name="gender" value="male" {{ ($doctorDetail[0]->doctorDetails->gender == 'male')?"checked":"" }}>
                                                <label for="test1">Male</label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <!-- <input type="radio" name="gender" class="" value="female" class="form-check-input">
                                            <label class="fs-6 me-1 form-check-label">Female</label> -->
                                                <input type="radio" id="test2" name="gender" value="female" {{ ($doctorDetail[0]->doctorDetails->gender == 'female')?"checked":"" }}>
                                                <label for="test2">Female</label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0">

                                                <!-- <input type="radio" name="gender" class="" value="other" class="form-check-input"> -->
                                                <input type="radio" id="test3" name="gender" value="other" {{ ($doctorDetail[0]->doctorDetails->gender == 'other')?"checked":"" }}>
                                                <label for="test3">Other</label>
                                            </div>

                                        </div>


                                        <!--end::Input-->
                                        @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>






                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="{{route('doctor.index')}}" class="btn btn-danger me-3" data-kt-users-modal-action="cancel">Discard</a>
                            <input type="submit" class="btn btn-primary" value="Update">

                        </div>
                        <!--end::Actions-->
                        <div></div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->