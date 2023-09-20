@extends('admin.layout')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard

                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h1>Dr. {{$getGroups[0]->doctor->first_name.' '.$getGroups[0]->doctor->last_name}}</h1>
                    </div>

                </div>

            </div>


            <!--end::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        Assigned Group
                    </div>

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->

                <div class="card-body pt-0">


                    <div class="group-box-wrap">
                        <div class="row">

                            @php
                            // dd($getGroups);
                            @endphp
                            @foreach($getGroups as $value)
                            <div class="col-lg-3 mb-4">
                                <div class="group-box">
                                    <div class="profile-img">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                            <g clip-path="url(#clip0_90_6709)">
                                                <path d="M20.8999 13.1377C21.9043 13.1369 22.895 13.3704 23.7933 13.8196C24.6917 14.2688 25.4729 14.9212 26.0749 15.7252" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M1.92493 15.7252C2.52695 14.9212 3.30816 14.2688 4.2065 13.8196C5.10484 13.3704 6.09555 13.1369 7.09993 13.1377" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14 20.0376C16.3817 20.0376 18.3125 18.1068 18.3125 15.7251C18.3125 13.3434 16.3817 11.4126 14 11.4126C11.6183 11.4126 9.6875 13.3434 9.6875 15.7251C9.6875 18.1068 11.6183 20.0376 14 20.0376Z" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.9624 23.4876C8.58156 22.4369 9.46419 21.566 10.5231 20.9609C11.5819 20.3559 12.7804 20.0376 13.9999 20.0376C15.2195 20.0376 16.4179 20.3559 17.4768 20.9609C18.5356 21.566 19.4182 22.4369 20.0374 23.4876" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17.5577 8.82529C17.719 8.20059 18.0523 7.63363 18.5196 7.18881C18.987 6.74399 19.5697 6.43913 20.2016 6.30885C20.8335 6.17858 21.4892 6.22811 22.0944 6.45182C22.6996 6.67553 23.2299 7.06445 23.6251 7.57442C24.0203 8.08439 24.2646 8.69497 24.3303 9.33681C24.3959 9.97866 24.2803 10.626 23.9964 11.2055C23.7126 11.7849 23.272 12.2731 22.7247 12.6147C22.1773 12.9562 21.5451 13.1375 20.8999 13.1378" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.1 13.1378C6.4548 13.1375 5.82263 12.9562 5.27527 12.6147C4.72791 12.2731 4.2873 11.7849 4.00348 11.2055C3.71966 10.626 3.604 9.97866 3.66963 9.33681C3.73527 8.69497 3.97958 8.08439 4.3748 7.57442C4.77003 7.06445 5.30034 6.67553 5.90551 6.45182C6.51067 6.22811 7.16645 6.17858 7.79835 6.30885C8.43025 6.43913 9.01296 6.74399 9.4803 7.18881C9.94764 7.63363 10.2809 8.20059 10.4422 8.82529" stroke="#79337D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_90_6709">
                                                    <rect width="27.6" height="27.6" fill="white" transform="translate(0.199951 0.200195)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="group-name text-center">{{$value->group->group_name}}</div>
                                    <div class="group-count text-center">Total Patients:{{$value->group->group_patient_assignments_count}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                </div>

                <!--end::Card body-->
            </div>

        </div>
        <!--end::Container-->
    </div>
</div>

@endsection