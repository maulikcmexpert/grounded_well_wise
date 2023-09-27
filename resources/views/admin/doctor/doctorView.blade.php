<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Therapist Detail</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 2) {{ route('staff.dashb
                            oard') }}@elseif($role_id == 3 || $role_id == 4) {{route('doctor.dashboard') }}@else  {{route('admin.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <a href="{{route('doctor.index')}}" class="text-muted text-hover-primary">Therapist List</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Therapist Detail</li>
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
            <div class="card docter-detail">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    
                    <div class="card-title">
                        Doctor Detail
                    </div>
                    
                    <div class="card-toolbar">
                    </div>
                </div> -->

                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-bold mb-8">Profile</h4>
                            <?php $image = url('storage/doctor/' . $doctorData->image); ?>
                            <div class="text-center dprofile-img">
                                <img class="" src="{{$image}}" width="100px">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <h4 class="text-bold">First Name</h4>
                                <p class="">{{$doctorData->first_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <h4 class="text-bold">Last Name</h4>
                                <p class="">{{$doctorData->last_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <h4 class="text-bold">Identity Number</h4>
                                <p class="">{{$doctorData->identity_number}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <h4 class="text-bold">Email</h4>
                                <p class="">{{$doctorData->email}}</p>
                            </div>
                        </div>
                    </div>

                    <!--end::Table-->
                </div>



                <!--end::Card body-->
            </div>

            <div class="card">
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
                <div class="card-body pt-0 docter-detail-group">
                    <!--begin::Table-->



                    @if(count($doctorData->groupDoctorAssignments) != 0)

                    @php
                    $checkExist = [];
                    @endphp
                    @foreach($doctorData->groupDoctorAssignments as $value)

                    @if(!in_array($value->group_id,$checkExist))
                    <div class="row border border-1 ms-2">
                        <div>
                            {{ $value->group->group_name}}
                        </div>
                    </div>
                    @php
                    $checkExist[] = $value->group_id;

                    @endphp
                    @endif

                    @endforeach
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