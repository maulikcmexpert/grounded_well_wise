<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{ $groupDetail[0]->group_name }}</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('admin.dashboard') }}@elseif($role_id == 2) {{ route('staff.dashboard') }}@elseif($role_id == 3 || $role_id == 4) {{ route('doctor.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('group.index') }} @endif" class="text-muted text-hover-primary">Group List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">View Group</li>
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

            <!--begin::Card header-->
            <div class="card view-groupdata">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Group Details
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->


                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 pb-0">
                    <!--begin::Table-->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Group Name</h4>
                                <p class="">
                                    {{ $groupDetail[0]->group_name }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Detail</h4>
                                <p class="">
                                    {{ $groupDetail[0]->group_details }}

                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Start Date</h4>
                                <p class="">
                                    {{ $groupDetail[0]->start_session_date }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold">Total Number Of Sessions</h4>
                                <p class="">
                                    {{ $groupDetail[0]->total_session }}
                                </p>
                            </div>
                        </div>

                    </div>
                    <!--end::Table-->
                </div>

                @if($groupDetail[0]->group_type == 'internal' )
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Group Sessions
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>

                <div class="card-body pt-0 sesion-data">
                    <!--begin::Table-->

                    <div class="row">
                        @foreach($groupDetail[0]->group_session as $value)
                        <div class="col-md-6 position-relative mb-3">
                            <div class="d-flex align-items-center">
                                <h4 class="text-bold"> {{ $value->session_name }} </h4>
                                <span class="text-info">{{ $value->session_date}}</span>
                            </div>
                            <div class="col-md-3">
                                @if($value->session_date < date('Y-m-d')) <span class="text-success">Completed</span>
                                    @elseif($value->session_date > date('Y-m-d'))
                                    <span class="text-warning">Upcoming</span>
                                    @endif
                            </div>

                        </div>
                        @endforeach

                    </div>


                    <!--end::Table-->
                </div>
                @endif


                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <div class="card docterGroup">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Group Therapist
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    @if(count($groupDetail[0]->groupDoctorAssignments) != 0)
                    @foreach($groupDetail[0]->groupDoctorAssignments as $value)

                    <?php $cryptId = encrypt($value->doctor_id); ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 mb-3">
                            <a href="{{route('doctor.show', $cryptId)}}">
                                <div class="d-flex align-items-center">

                                    <p>{{ $value->doctor->first_name.' '.$value->doctor->last_name}}</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-3">
                            <div class="d-flex align-items-center">
                                <h4>Time</h4>
                                <p>{{ $value->start_time.' To '.$value->end_time}}</p>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <div>
                        {{ "No Doctor Assign" }}
                    </div>
                    @endif

                    <!--end::Table-->
                </div>



                <!--end::Card body-->
            </div>


            <div class="card patientGroup">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Group Patients
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->

                    @if(count($groupDetail[0]->groupPatientAssignments) != 0)
                    <div class="row">
                        @foreach($groupDetail[0]->groupPatientAssignments as $value)

                        <?php $cryptId = encrypt($value->patient_id); ?>
                        <div class="col-xl-6 col-lg-6 mb-3">
                            <a href="{{route('patient.show', $cryptId)}}">
                                <div class="d-flex align-items-center">

                                    <p>{{ $value->patient->first_name.' '.$value->patient->last_name}}</p>
                                </div>
                            </a>
                        </div>

                        @endforeach
                    </div>
                    @else
                    <div>
                        {{ "No Patient Assign" }}
                    </div>
                    @endif

                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>


            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->