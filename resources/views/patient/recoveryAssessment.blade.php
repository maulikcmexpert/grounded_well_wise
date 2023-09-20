<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Recovery Assessment Scale - 24 (RAS-24)</h1>
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
                    <li class="breadcrumb-item text-dark">Recovery Assessment Scale - 24 (RAS-24)</li>


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

                @if(count($rasQues) != 0)
                <!--end::Card header-->
                <!--begin::Card body-->
                <!-- <div class="card-body pt-0"> -->
                <div class="container">
                    <div class="form-main">
                        <form method="POST" action="{{route('patient.recoveryAssessmentPatient')}}" class="form-wrpper recovery-wrapper">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{$patient_id}}">
                            @if(count($patientRasAnswer) != 0)

                            <select class="form-control" id="selectOption">
                                <option {{($patientRasAnswer[0]->test_type == 0)?"selected":""}} value="{{ route('patient.recoveryAssessment', [$patient_id, 0]); }}">Initial Test</option>

                                @if($checkFinalRasDone !=0)
                                <option {{($patientRasAnswer[0]->test_type == 1)?"selected":""}} value="{{ route('patient.recoveryAssessment', [$patient_id, 1]); }}">Final Test</option>
                                @else
                                @if($checkGroupLastsession->end_session_date < date('Y-m-d')) <option {{($patientRasAnswer[0]->test_type == 1)?"selected":""}} value="{{ route('patient.recoveryAssessment', [$patient_id, 1]); }}">Final Test</option>
                                    @endif
                                    @endif
                            </select>

                            @endif
                            <h3>Recovery Assessment Scale - 24 (RAS-24)</h3>
                            <p>Please complete the survey below.</p>
                            <span>Please select the response that best describes with how much you agree or disagree with the statement.</span>

                            <div class="row">
                                @php $i = 1; @endphp
                                @foreach($rasQues as $key => $val)
                                <div class="col-xl-12 form-info mb-3">
                                    <input class="form-check-input" type="hidden" name="questions[{{$key}}][question]" id="questionId" value="{{ $val->id }}">
                                    <label class="d-block"><span>{{ $i.'.' }} </span> {{ $val->question}}</label>

                                    <div class="supportive-div">

                                        @foreach($rasRating as $ansKey => $ansVal)
                                        @if(count($patientRasAnswer) == 0)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="{{ $ansVal->id }}" name="questions[{{ $key }}][answer]" id="option{{ $key.$ansKey }}" {{ old('questions.'.$key.'.answer') == $ansVal->id ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option{{ $key.$ansKey }}">
                                                {{$ansVal->scale_type}}
                                            </label>
                                        </div>
                                        @else
                                        @foreach($patientRasAnswer as $ptans)

                                        @if(($ptans->question_id == $val->id) && ($ptans->answer_id == $ansVal->id))

                                        <input class="col-md-3" type="text" disabled value="{{$ptans->ras_rating->scale_type}}">
                                        <input class="col-md-3" type="text" disabled value="{{$ptans->ras_rating->scale}}">
                                        @endif

                                        @endforeach
                                        @endif
                                        @endforeach
                                        @error ('questions.'.$key.'.answer')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>




                                </div>
                                @php $i++; @endphp
                                @endforeach
                                @if(count($patientRasAnswer) == 0)
                                <div class="text-center form-submit-btn">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="container">
                    <h1>Questions is not available</h1>
                </div>
                @endif
                <!-- </div> -->
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->