<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Patient Detail</h1>
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

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <a href="{{route('patient.index')}}" class="text-muted text-hover-primary">Patient List</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Patient Detail</li>
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
            <div class="card patientview-wrp">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    <div class="card-toolbar">
                    </div>
                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="generaldetails-wrap card-body pt-0 mt-5">
                    <div class="card-title">
                        Patient Detail
                    </div>
                    <!--begin::Table-->
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">First Name</h4>
                                <p class="">{{$PatientData->first_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Last Name</h4>
                                <p class="">{{$PatientData->last_name}}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Identity Number</h4>
                                <p class="">{{$PatientData->identity_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">date Of Birth</h4>
                                <p class="">{{$PatientData->patientDetails->date_of_birth}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">EZMed Number</h4>
                                <p class="">{{$PatientData->patientDetails->EZMed_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Gender</h4>
                                <p class="">{{$PatientData->patientDetails->gender}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Gender</h4>
                                <p class="">{{$PatientData->patientDetails->gender}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Language</h4>
                                <p class="">{{$PatientData->patientDetails->language}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Passport / SAID</h4>
                                <p class="">{{$PatientData->patientDetails->passport_SAID}}</p>
                            </div>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>

                <div class="contact-wrp  card-body pt-0 mt-5">
                    <div class="card-title">
                        Contact Details
                    </div>
                    <!--begin::Table-->
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Name</h4>
                                <p class="">{{$PatientData->patientDetails->name}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Surname</h4>
                                <p class="">{{$PatientData->patientDetails->surname}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Contact Number</h4>
                                <p class="">{{$PatientData->patientDetails->contact_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Alternative Contact Number</h4>
                                <p class="">{{$PatientData->patientDetails->alternative_contact_number}}</p>
                            </div>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>

                <div class="patient-wrp card-body pt-0 mt-5">
                    <div class="card-title">
                        Address Details
                    </div>
                    <!--begin::Table-->
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Physical Address</h4>
                                <p class="">{{$PatientData->patientDetails->physical_address}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Complex Name</h4>
                                <p class="">{{$PatientData->patientDetails->complex_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Unit No</h4>
                                <p class="">{{$PatientData->patientDetails->unit_no}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">City</h4>
                                <p class="">{{$PatientData->patientDetails->city}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Country</h4>
                                <p class="">{{$PatientData->patientDetails->country}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Postal Code</h4>
                                <p class="">{{$PatientData->patientDetails->postal_code}}</p>
                            </div>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>

                <!--end::Card body-->
            </div>

            <div class="card patient-group mt-5">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Groups
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 ps-5">
                    <!--begin::Table-->

                    @if(count($PatientData->groupPatientAssignments) != 0)
                    <div class="row">
                        @foreach($PatientData->groupPatientAssignments as $value)
                        <div class="col-xl-4 col-lg-4">
                            <div class="patient-group-wrp border border-1 ps-3 d-flex justify-content-between pe-3">
                                <a href="{{route('group.show', encrypt($value->group_id))}}">
                                    <div class="text-dark">
                                        {{ $value->group->group_name}}
                                    </div>
                                </a>
                                <div><span class="remove_group" group_id="{{ $value->group->id}}" patient_id="{{ $PatientData->id}}"><i class="fa fa-remove text-danger"></i></span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div>
                        {{ "No Group Assign" }}
                    </div>
                    @endif


                    <!--end::Table-->
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