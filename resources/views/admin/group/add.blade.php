<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Group</h1>
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
                    <li class="breadcrumb-item text-dark">Add Group</li>
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
            <div class="card group-add">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    
                    <div class="card-title">
                        Add Group
                    </div>

                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('group.store')}}" id="groupForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <!--begin::Scroll-->
                        @csrf
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Group Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="group_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Group Name" value="">
                                        <!--end::Input-->
                                        @if ($errors->has('group_name'))
                                        <span class="text-danger">{{ $errors->first('group_name') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Group Details</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="group_details" placeholder="Group Details"></textarea>
                                        <!--end::Input-->
                                        @if ($errors->has('group_details'))
                                        <span class="text-danger">{{ $errors->first('group_details') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="start_session_date" class="form-control form-control-solid mb-3 mb-lg-0 start_session_date" id="start_session_date" placeholder="Start Session Date" value="" autocomplete="off">
                                        <!--end::Input-->
                                        @if ($errors->has('start_session_date'))
                                        <span class="text-danger">{{ $errors->first('start_session_date') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Number Of Sessions</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="total_session" class="form-control form-control-solid mb-3 mb-lg-0 total_session" id="total_session" placeholder="Number Of Sessions" value="">
                                        <!--end::Input-->
                                        @if ($errors->has('total_session'))
                                        <span class="text-danger">{{ $errors->first('total_session') }}</span>
                                        @endif
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                        <div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-5 position-relative">
                                    <div class="row" id="addSession"></div>
                                </div>
                            </div>

                            <div class="fv-row mb-7 fv-plugins-icon-container" id="doctorAssign" style="display: none;">
                                <!--begin::Label-->
                                <button class=" btn btn-primary" id="addMore">Add Therapist</button>
                                <div class="row mt-5">
                                    <!--end::Label-->
                                    <div class="col-4 d-flex flex-column">
                                        <label class="required fw-bold fs-6 mb-2">Assign Therapist</label>

                                        <select class="form-control form-select doctor_id" name="doctor_id[]" id="multiple-select-field" data-placeholder="Select Therapist">
                                            <option value="">Select Therapist</option>
                                            @foreach($doctors as $value)
                                            <option value="{{ $value->id}}">{{ $value->first_name.' '.$value->last_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="availdocerror"></span>
                                    </div>
                                    <div class="col-4">
                                        <label class="required fw-bold fs-6 mb-2">start Time</label>
                                        <input type="time" name="start_time[]" class="form-control start_time">
                                        <span class="availdocerror"></span>
                                    </div>
                                    <div class="col-4">
                                        <label class="required fw-bold fs-6 mb-2">End Time</label>
                                        <input type="time" name="end_time[]" class="form-control end_time">
                                        <span class="availdocerror"></span>
                                    </div>
                                </div>

                                <!--begin::Input-->


                            </div>

                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="{{route('group.index')}}" class="btn btn-danger text-white me-3" data-kt-users-modal-action="cancel">Discard</a>
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