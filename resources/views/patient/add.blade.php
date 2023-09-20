<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Patient</h1>
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
                        <a href="@if($role_id == 1) {{ route('patient.index') }} @endif" class="text-muted text-hover-primary">Patient List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Add Patient</li>
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
            <div class="card">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        Add Patient
                    </div>
                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('patient.store')}}" id="patientForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        @csrf
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">
                            <div class="generaldetails-wrap mt-5">
                                <div class="card-title">
                                    General Details
                                </div>
                                <div class="row">
                                    <!--begin::Input group-->
                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">First Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="First Name" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Last Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Last Name" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Passport | SA ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <label class="select-label">
                                                <select name="passport_SAID" class="form-control form-control-solid">
                                                    <option value="">Enter Type</option>
                                                    <option value="passport">passport</option>
                                                    <option value="SA_ID">SA ID</option>
                                                </select>
                                            </label>

                                            <!--end::Input-->
                                            @if ($errors->has('passport_SAID'))
                                            <span class="text-danger">{{ $errors->first('passport_SAID') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Identification Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="identity_number" name="identity_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Identity Number" value="">
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
                                            <label class="required fw-bold fs-6 mb-2">Password</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="password" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
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
                                            <input type="date" name="date_of_birth" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Date Of Birth" value="">
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
                                            <label class=" fw-bold fs-6 mb-2">Language</label>
                                            <!--end::Label-->
                                            <input type="text" name="language" class="form-control form-control-solid" value="">

                                            @if ($errors->has('language'))
                                            <span class="text-danger">{{ $errors->first('language') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Referring Provider</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <label class="select-label">
                                                <select name="referring_provider" class="form-control form-control-solid">
                                                    <option value="">Select Referring provider</option>
                                                    @foreach($getRefferingDR as $value)
                                                    <option value="{{$value->id }}">{{ $value->first_name.' '.$value->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </label>

                                            <!--end::Input-->
                                            @if ($errors->has('referring_provider'))
                                            <span class="text-danger">{{ $errors->first('referring_provider') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">EZMed Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="EZMed_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="EZMed Number" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('EZMed_number'))
                                            <span class="text-danger">{{ $errors->first('EZMed_number') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Gender</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="d-flex gender">
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <!-- <input type="radio" name="gender" class="" value="Male" checked class="form-check-input">
                                                    <label class="fs-6 me-1 form-check-label">Male</label> -->
                                                    <input type="radio" id="test1" name="gender" value="male" checked>
                                                    <label for="test1">Male</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <!-- <input type="radio" name="gender" class="" value="female" class="form-check-input">
                                                    <label class="fs-6 me-1 form-check-label">Female</label> -->
                                                    <input type="radio" id="test2" name="gender" value="female">
                                                    <label for="test2">Female</label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">

                                                    <!-- <input type="radio" name="gender" class="" value="other" class="form-check-input"> -->
                                                    <input type="radio" id="test3" name="gender" value="other">
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

                            <div class="contact-wrp mt-5">
                                <div class="card-title">Contact Details</div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Next Of Kin</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="next_of_kin" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Next Of Kin" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('next_of_kin'))
                                            <span class="text-danger">{{ $errors->first('next_of_kin') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Surname</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="surname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Surname" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('surname'))
                                            <span class="text-danger">{{ $errors->first('surname') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Contact Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="contact_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Contact Number" value="">
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
                                            <label class=" fw-bold fs-6 mb-2">Alternative Contact Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="alternative_contact_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Alternative Contact Number" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('alternative_contact_number'))
                                            <span class="text-danger">{{ $errors->first('alternative_contact_number') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="patient-wrp mt-5">
                                <div class="card-title">Address Details</div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Physical Address</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="physical_address" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Physical Address" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('physical_address'))
                                            <span class="text-danger">{{ $errors->first('physical_address') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Complex Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="complex_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Complex Name" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('complex_name'))
                                            <span class="text-danger">{{ $errors->first('complex_name') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Unit No</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="unit_no" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Unit No" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('unit_no'))
                                            <span class="text-danger">{{ $errors->first('unit_no') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">City</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="city" class="form-control form-control-solid" value="">


                                            <!--end::Input-->
                                            @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Country</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="country" class="form-control form-control-solid" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('country'))
                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class=" fw-bold fs-6 mb-2">Postal Code</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="postal_code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Postal Code" value="">
                                            <!--end::Input-->
                                            @if ($errors->has('postal_code'))
                                            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                            @endif
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="{{route('patient.index')}}" class="btn btn-danger me-3" data-kt-users-modal-action="cancel">Discard</a>
                            <input type="submit" class="btn btn-primary" value="Add">
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