<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Question</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('admin.dashboard') }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('ras_question.index') }} @endif" class="text-muted text-hover-primary">Group List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Add Question</li>
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
            <div class="card add-question">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    
                    <div class="card-title">
                        Add Question
                    </div>

                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('ras_question.store')}}" id="questionForm" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <!--begin::Scroll-->
                        @csrf



                        <div class="d-flex flex-column scroll-y me-n7 pe-7 " id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Question subscales</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="subscale" class="form-control form-control-solid mb-3 mb-lg-0 subscale" id="subscale">
                                    <option value="">Select Question subscale</option>
                                    @foreach($questionCat as $value)
                                    <option value="{{$value->id}}">{{$value->category}}</option>
                                    @endforeach

                                    <select>
                                        <!--end::Input-->

                                        <span class="text-danger error-subscale"></span>


                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>
                        <div class="text-end pt-5">
                            <button class="btn btn-primary" id="addMore">Add More</button>
                        </div>
                        <div class="d-flex flex-column scroll-y me-n7 pe-7 rasQuestion" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Question</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="question[]" class="form-control form-control-solid mb-3 mb-lg-0 question" placeholder="Question" value="">
                                <!--end::Input-->

                                <span class="text-danger error-question"></span>


                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <!--end::Input group-->
                        </div>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <a href="{{route('ras_question.index')}}" class="btn btn-danger me-3" data-kt-users-modal-action="cancel">Discard</a>
                            <button id="questionSubmit" class="btn btn-primary">Add</button>


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