<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $group_name->group_name }}</h1>
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

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Attendance List</li>
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
            <div class="card grupList">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Attendance List
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->

                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->

                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Id</th>
                                <th class="min-w-125px">Patient Name</th>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($groupSession as $value)
                                <th>
                                    <div>
                                        <label> {{ $i}}</label>
                                        <label>{{ $value->session_date}}</label>
                                    </div>


                                </th>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold">

                            @foreach($patientDetails as $value)
                            <tr>
                                <td>{{$value->patient->id}}</td>
                                <td>{{$value->patient->first_name.' '.$value->patient->last_name .' ['. $value->patient->patientDetails->EZMed_number.']'}}</td>
                                @foreach($groupSession as $sessionvalue)
                                <td>
                                    @if($sessionvalue->session_date < date('Y-m-d')) @if(in_array($value->patient->id,$getAttendancepatient) && in_array($sessionvalue->id,$getAttendancesession))
                                        <div class="form-check">
                                            <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                        </div>
                                        @else
                                        <div class="form-check">
                                            <span><i class="far fa-times-circle"></i></span>
                                        </div>

                                        @endif
                                        @endif
                                        @if($sessionvalue->session_date == date('Y-m-d'))
                                        <div class="form-check">
                                            <input type="checkbox" {{ (in_array($value->patient->id,$getAttendancepatient) && in_array($sessionvalue->id,$getAttendancesession))?"checked":""}} class="form-check-input patientAttendance" name="patient_id" session_id="{{ $sessionvalue->id}}" group_id="{{$groupId}}" value="{{ $value->patient->id}}" id="attendance{{ $value->patient->id}}">
                                        </div>
                                        @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
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