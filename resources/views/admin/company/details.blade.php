<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Comapny Details</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">

                        <a href="@if($role_id == 1) {{route('admin.dashboard')  }} @endif" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="@if($role_id == 1) {{ route('company.index') }} @endif" class="text-muted text-hover-primary">Doctor List</a>
                    </li>
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Company Details</li>
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
    <div class="post d-flex flex-column-fluid company-wrap" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <!-- <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        Company Details
                    </div>
                </div> -->
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('company.store')}}" id="companyDetailForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <!--begin::Scroll-->
                        @csrf
                        <div class="compdetail-card">
                            <h1> About Us</h1>
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{(!empty($companyData))?$companyData->title:''}}">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="about_us" id="editor">{{(!empty($companyData))?$companyData->about_us:''}}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="compdetail-card">
                            <h1> Terms And Conditions</h1>
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="t_c_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{(!empty($companyData))?$companyData->t_c_title:''}}">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="term_and_condition" id="editor1">{{(!empty($companyData))?$companyData->term_and_condition:''}}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="compdetail-card">
                            <h1> Privacy Policy</h1>
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px" style="max-height: 158px;">

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="p_p_title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{(!empty($companyData))?$companyData->p_p_title:''}}">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="privacy_policy" id="editor2">{{(!empty($companyData))?$companyData->privacy_policy:""}}</textarea>

                                </div>
                            </div>
                        </div>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-1sssss">

                            <input type="submit" class="btn btn-primary" value="{{(!empty($companyData))?'Update':'Add'}}">
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
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<!--end::Content-->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {

        })
        .catch(error => {

        });

    ClassicEditor
        .create(document.querySelector('#editor1'), {

        })
        .catch(error => {

        });

    ClassicEditor
        .create(document.querySelector('#editor2'), {

        })
        .catch(error => {

        });
</script>