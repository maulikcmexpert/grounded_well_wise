<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">APOM</h1>
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
                    <li class="breadcrumb-item text-dark">APOM</li>
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
                <input type="hidden" name="patient_id" value="{{$patient_id}}">
                @if(!empty($patientApom))

                <select class="form-control" id="ApomselectOption">
                    <option {{($patientApom->test_type == 0)?"selected":""}} value="{{ route('patient.patientApom',
                        [$patient_id, 0]); }}">Initial Test</option>
                    @if($checkFinalApomDone != 0)

                    <option {{($patientApom->test_type == 1)?"selected":""}} value="{{ route('patient.patientApom',
                         [$patient_id, 1]); }}">Final Test</option>
                    @else
                    @if($checkGroupLastsession->end_session_date < date('Y-m-d')) <option {{($patientApom->test_type == 1)?"selected":""}} value="{{ route('patient.patientApom',
                            [$patient_id, 1]); }}">Final Test</option>
                        @endif
                        @endif

                </select>

                @endif
                @if(empty($patientApom))
                <div class="wizard">

                    <form method="POST" action="{{route('patient.storepatientApom')}}" id="APOMForm">
                        @csrf

                        <div class="wizard-step active step" data-step="1">
                            <h2>Step 1: Occupational Therapy Screening on Admission</h2>
                            <input type="hidden" name="patient_id" readonly value="{{$patientDetail[0]->id}}">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <label>Patient Name:</label>
                                    <input type="text" name="patientName" readonly value="{{ $patientDetail[0]->first_name.' '.$patientDetail[0]->last_name}}">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Date of Screening:</label>
                                    <input type="text" readonly id="dateOfScreening" name="dateOfScreening">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>ID Number:</label>
                                    <input type="text" name="idNumber" readonly value="{{ $patientDetail[0]->patientDetails->EZMed_number }}">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Therapist Doing Interview:</label>
                                    <input type="hidden" name="doctor_id" readonly value="{{session()->get('admin')['id']}}">
                                    <input type="text" name="therapistName" readonly value="{{session()->get('admin')['first_name']}}">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Age:</label>
                                    <input type="text" name="age">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Duration:</label>
                                    <input type="text" id="timerDisplay" name="duration">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Psychiatrist:</label>
                                    <input type="text" name="psychiatrist">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Place:</label>
                                    <select name="place">
                                        <option value="">Select Place</option>
                                        <option value="In ward">In ward</option>
                                        <option value="In Office">In Office</option>
                                        <option value="rooms">rooms</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Psychologist:</label>
                                    <input type="text" name="psychologist">
                                </div>
                            </div>
                            <!-- Next button -->
                            <button class="btn-next" data-step="2">Next</button>
                        </div>

                        <div class="wizard-step history-wrap step" data-step="2">
                            <h2>Step 2: History</h2>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <label>Previous Admissions / Diagnosis:</label>
                                    <input type="text" name="prev_add_diagnosis">
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Compliance / Follow-up:</label>
                                    <input type="text" name="compliance_followup">
                                </div>
                            </div>

                            <div>
                                <h4>Current complaints:</h4>
                                <div class="d-flex flex-wrap history-check">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="poor concentration" id="poor">
                                        <label for="poor">Poor Concentration</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Depression" id="Depression">
                                        <label for="Depression">Depression</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Anxiety" id="Anxiety">
                                        <label for="Anxiety">Anxiety</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="mood" id="mood">
                                        <label for="mood">Mood Changes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Anger" id="Anger">
                                        <label for="Anger">Anger</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Irritability" id="Irritability">
                                        <label for="Irritability">Irritability</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Aggressive" id="Aggressive">
                                        <label for="Aggressive">Aggressive Tendencies</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Poor" id="Poor">
                                        <label for="Poor">Poor Memory</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Confused" id="Confused">
                                        <label for="Confused">Confused/Distracted</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Fatigue" id="Fatigue">
                                        <label for="Fatigue">Fatigue/Tired</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Withdrawing" id="Withdrawing">
                                        <label for="Withdrawing">Withdrawing or Isolating Self</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Appetite" id="Appetite">
                                        <label for="Appetite">Appetite Changes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Impulsivity" id="Impulsivity">
                                        <label for="Impulsivity">Impulsivity</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Motivation" id="Motivation">
                                        <label for="Motivation">Low Motivation</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Conflict" id="Conflict">
                                        <label for="Conflict">Conflict</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Recent" id="Recent">
                                        <label for="Recent">Recent Trauma or Loss</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Self-Esteem" id="Self-Esteem">
                                        <label for="Self-Esteem">Low Self-Esteem</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Suicidal" id="Suicidal">
                                        <label for="Suicidal">Suicidal Thoughts/Attempts</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Hallucinations" id="Hallucinations">
                                        <label for="Hallucinations">Hallucinations</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Sleep Disturbances" id="Disturbances">
                                        <label for="Disturbances">Sleep Disturbances</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Struggles Falling Asleep" id="Falling">
                                        <label for="Falling">Struggles Falling Asleep</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Struggles" id="Struggles">
                                        <label for="Struggles">Struggles Staying Asleep</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Insomnia" id="Insomnia">
                                        <label for="Insomnia">Insomnia</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="Nightmares" id="Nightmares">
                                        <label for="Nightmares">Nightmares</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="COVID(self/family)" id="COVID">
                                        <label for="COVID">COVID (self/family)</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="complaint[]" value="info" id="info">
                                        <label for="info">Other / More Information</label>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-3 operations-wrapper">
                                <label>Other medical conditions / operations:</label><br>
                                <textarea name="medicalConditions" rows="3" cols="50"></textarea>

                                <!-- Previous and Next buttons -->
                                <div class="d-flex align-items-center">
                                    <button class="btn-prev me-2" data-step="1">Previous</button>
                                    <button class="btn-next" data-step="3">Next</button>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-step personalinfo-wrapper step" data-step="3">
                            <h2>Step 3: Personal life / Family</h2>

                            <label class="heading">Relationship Status:</label>
                            <div class="d-flex align-items-cemter flex-wrap gap-5 mt-3 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="signle" id="single">
                                    <label class="form-check-label" for="single">Single</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="In relationship" id="relation">
                                    <label class="form-check-label" for="relation">In Relationship</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="Engaged" id="Engaged">
                                    <label class="form-check-label" for="Engaged">Engaged</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="Married" id="Married">
                                    <label class="form-check-label" for="Married">Married</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="Divorced" id="Divorced">
                                    <label class="form-check-label" for="Divorced">Divorced</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="relationshipStatus" value="Widow/er" id="Widow/er">
                                    <label class="form-check-label" for="Widow/er">Widow/er</label>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <label>Name of Partner:</label>
                                    <input type="text" name="partnerName"><br>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Duration of Current Relationship:</label>
                                    <input type="text" name="durationOfRelationship"><br>
                                </div>
                            </div>


                            <label>Quality of Relationship:</label>
                            <textarea name="qualityOfRelationship" rows="3" cols="50"></textarea><br>

                            <label>Number of Children / Dependants and Ages:</label>
                            <textarea name="childrenDependants" rows="3" cols="50"></textarea><br>

                            <label>Living Arrangements:</label>
                            <textarea name="livingArrangements" rows="3" cols="50"></textarea><br>

                            <label>Quality of Relationships in Family:</label>
                            <textarea name="qualityOfRelationshipsInFamily" rows="3" cols="50"></textarea><br>

                            <label>Family Stressors / Conflict:</label>
                            <textarea name="familyStressorsConflict" rows="3" cols="50"></textarea><br>

                            <label>Support System:</label>
                            <textarea name="supportSystem" rows="3" cols="50"></textarea><br>

                            <label>Next of Kin and Contact Number for Collateral:</label>
                            <textarea name="nextOfKinContact" rows="3" cols="50"></textarea><br>
                            <!-- Previous and Submit buttons -->
                            <button class="btn-prev" data-step="2">Previous</button>
                            <button class="btn-next" data-step="4">Next</button>
                        </div>

                        <div class="wizard-step work-wrapper step" data-step="4">
                            <h2>Step 4: Work Situation</h2>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <label>Job Title / Rank:</label>
                                    <input type="text" name="jobTitle"><br>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Employer / Institution:</label>
                                    <input type="text" name="employer"><br>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Years in Current Job:</label>
                                    <input type="text" name="yearsInJob"><br>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <label>Job Satisfaction:</label>
                                    <input type="text" name="jobSatisfaction"><br>
                                </div>
                            </div>

                            <div class="my-3">
                                <label class="heading">Job Role (Choose one):</label>
                                <div class="d-flex gap-5 flex-wrap mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="jobRole" value="Projects" id="projects">
                                        <label class="form-check-label" for="projects">Projects</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="jobRole" value="1" id="work">
                                        <label class="form-check-label" for="work">Routine Work</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="jobRole" value="1" id="Independent">
                                        <label class="form-check-label" for="Independent">Independent</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="jobRole" value="1" id="Teamwork">
                                        <label class="form-check-label" for="Teamwork">Teamwork</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input d-none" type="radio" name="jobRole" value="1" id="management">
                                        <label class="form-check-label" for="management">Management of
                                            Others/Processes/Systems</label>
                                    </div>

                                </div>
                            </div>

                            <div>
                                <label class="heading">Struggling with:</label>
                                <div class="d-flex flex-wrap check-wrap">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="concentration" id="concern">
                                        <label for="concern">Concentration</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Memory" id="Memory">
                                        <label for="Memory">Memory</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Reasoning" id="Reasoning">
                                        <label for="Reasoning">Reasoning</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Planning" id="Planning">
                                        <label for="Planning">Planning</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="roblem Solving" id="problem">
                                        <label for="problem">Problem Solving</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Judgment" id="Judgment">
                                        <label for="Judgment">Judgment</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="stress management" id="stress">
                                        <label for="stress">Stress Management</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Workload" id="Workload">
                                        <label for="Workload">Workload</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="quality of work" id="quality">
                                        <label for="quality">Quality of Work</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Conflict" id="Conflict">
                                        <label for="Conflict">Conflict</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="strugglingWith[]" value="Relationships at work" id="relationship">
                                        <label for="relationship">Relationships at Work</label>
                                    </div>

                                </div>
                            </div>


                            <div class="mt-3 operations-wrapper">
                                <label>Other Info:</label>
                                <textarea name="otherInfo" rows="3" cols="50"></textarea><br>

                                <div class="d-flex align-items-center">
                                    <button class="btn-prev me-2" data-step="3">Previous</button>
                                    <button class="btn-next" data-step="5">Next</button>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-step step" data-step="5">
                            <h2>Step 5: Free Time</h2>

                            <div class="operations-wrapper mb-3">
                                <label class="heading">Hobbies / Leisure / Recreation / Social / Weekends:</label>
                                <textarea name="hobbiesLeisure" rows="3" cols="50"></textarea><br>
                            </div>

                            <div class="operations-wrapper mb-3">
                                <!-- Mood -->
                                <label>Mood:</label>
                                <textarea name="mood" rows="3" cols="50"></textarea><br>
                            </div>

                            <div class="operations-wrapper mb-3">
                                <!-- Coping -->
                                <label>Coping:</label>
                                <textarea name="coping" rows="3" cols="50"></textarea><br>
                            </div>

                            <div class="mb-3">
                                <!-- Substance(s) -->
                                <label class="heading">Substance(s):</label>
                                <div class="d-flex align-items-center gap-5">
                                    <div class="form-check ps-0">
                                        <input class="form-check-input d-none" type="radio" name="substanceYesNo" value="Yes" id="Yes">
                                        <label class="form-check-label" for="Yes">Yes</label>
                                    </div>
                                    <div class="form-check ps-0">
                                        <input class="form-check-input d-none" type="radio" name="substanceYesNo" value="No" id="No">
                                        <label class="form-check-label" for="No">No</label>
                                    </div>

                                </div>
                            </div>


                            <!-- Substance(s) - If Yes -->
                            <div id="substanceYes">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Substance 1:</label>
                                        <input type="text" name="substance1">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Frequency:</label>
                                        <input type="text" name="substance1Frequency">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Last Use:</label>
                                        <input type="text" name="substance1LastUse"><br>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Substance 2:</label>
                                        <input type="text" name="substance2">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Frequency:</label>
                                        <input type="text" name="substance2Frequency">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Last Use:</label>
                                        <input type="text" name="substance2LastUse"><br>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Substance 3:</label>
                                        <input type="text" name="substance3">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Frequency:</label>
                                        <input type="text" name="substance3Frequency">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Last Use:</label>
                                        <input type="text" name="substance3LastUse"><br>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Substance 4:</label>
                                        <input type="text" name="substance4">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Frequency:</label>
                                        <input type="text" name="substance4Frequency">
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <label>Last Use:</label>
                                        <input type="text" name="substance4LastUse"><br>
                                    </div>
                                </div>

                                <!-- Add more substances if needed -->

                                <div class="mt-3">
                                    <label>1. Have you ever felt you ought to cut down on your drinking or drug
                                        use?</label>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="cutDown" value="Yes" id="Yes5">
                                            <label for="Yes5">Yes</label>
                                        </div>
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="cutDown" value="No" id="No5">
                                            <label for="No5">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label>2. Have people annoyed you by criticizing your drinking or drug use?</label>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="peopleAnnoyed" value="Yes" id="yes1">
                                            <label for="yes1">Yes</label>
                                        </div>
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="peopleAnnoyed" value="No" id="No1">
                                            <label for="No1">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label>3. Have you felt bad or guilty about your drinking or drug use?</label>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="feltBadGuilty" value="Yes" id="yes2">
                                            <label for="yes2">Yes</label>
                                        </div>
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="feltBadGuilty" value="No" id="No2">
                                            <label for="No2">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label>4. Have you ever had a drink or used first thing in the morning to steady
                                        your nerves or to get rid of a hangover?</label>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="drinkUsedMorning" value="Yes" id="yes3">
                                            <label for="yes3">Yes</label>
                                        </div>
                                        <div class="form-check ps-0">
                                            <input type="radio" class="form-check-label d-none" name="drinkUsedMorning" value="No" id="No3">
                                            <label for="No3">No</label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- Substance(s) - If No -->
                            <div class="operations-wrapper mt-3">
                                <!-- Expectations / Goals for Admission -->
                                <label>Expectations / Goals for Admission:</label>
                                <textarea name="expectationsGoals" rows="3" cols="50"></textarea><br>

                                <div class="d-flex align-items-center">
                                    <button class="btn-prev me-2" data-step="4">Previous</button>
                                    <button class="btn-next" data-step="6">Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step apomitems-wrapper step" data-step="6">
                            <h2>Step 6: APOM Items</h2>
                            <div class="skill mb-4">
                                <h2 class="card-title">Process Skill</h2>
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">
                                        <label>Attention</label>
                                        <input class="content" type="text" name="attention"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Pace</label>
                                        <input class="content" type="text" name="pace"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Knowledge - tools & materials</label>
                                        <input class="content" type="text" name="knowledgeToolsAndMaterials"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Knowledge - concept formation</label>
                                        <input class="content" type="text" name="knowledgeConceptFormation"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Skills - to use tools & materials</label>
                                        <input class="content" type="text" name="skillsToUseToolsAndMaterials"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Task Concept</label>
                                        <input class="content" type="text" name="taskConcept"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Organizing space and objects</label>
                                        <input class="content" type="text" name="organizingSpaceAndObjects"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Adaptation</label>
                                        <input class="content" type="text" name="adaptation"><br>
                                    </div>

                                </div>
                            </div>
                            <div class="skill">
                                <h2 class="card-title">Communication/Interaction skills</h2>
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Non-verbal: Physical contact</label>
                                        <input type="text" name="nonVerbalPhysicalContact"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Non-verbal: Eye contact</label>
                                        <input class="text" type="text" name="nonVerbalEyeContact"><br>
                                    </div>


                                    <div class="col-xl-3 col-lg-3">
                                        <label>Non-verbal: Gestures</label>
                                        <input class="text" type="text" name="nonVerbalGestures"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Non-verbal: Use of body</label>
                                        <input class="text" type="text" name="nonVerbalUseOfBody"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Verbal: Use of speech</label>
                                        <input type="text" name="verbalSpeech"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Verbal: Content</label>
                                        <input type="text" name="verbalContent"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Verbal: Express needs</label>
                                        <input type="text" name="verbalExpressNeeds"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Verbal: conversation</label>
                                        <input type="text" name="verbalConversation"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Relations: Social Norms</label>
                                        <input type="text" name="relationsSocialNorms"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Relations: Rapport</label>
                                        <input type="text" name="relationsRapport"><br>
                                    </div>




                                </div>
                            </div>
                            <div class="skill">
                                <h2 class="card-title">Life Skills</h2>
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">
                                        <label>Personal Care, hygiene, grooming</label>
                                        <input type="text" name="personalCare"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Personal safety</label>
                                        <input type="text" name="personalSafety"><br>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <label>Care of medication</label>
                                        <input type="text" name="careOfMedication"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Use of transport</label>
                                        <input type="text" name="useOfTransport"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Domestic skills</label>
                                        <input type="text" name="domesticSkills"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label> Child care skills</label>
                                        <input type="text" name="childCareSkills"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label> Money management and budgeting skills</label>
                                        <input type="text" name="moneyManagementAndBudgetingSkills"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">
                                        <label>Assertiveness</label>
                                        <input type="text" name="assertiveness"><br>
                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Stress Management</label>
                                        <input type="text" name="stressManagement"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Conflict Management</label>
                                        <input type="text" name="conflictManagement"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Problem Solving Skills:</label>
                                        <input type="text" name="problemSolvingSkills"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Pre-vocational skills</label>
                                        <input type="text" name="preVocationalSkills"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label> Vocational skills</label>
                                        <input type="text" name="vocationalSkills"><br>

                                    </div>



                                </div>
                            </div>
                            <div class="skill">
                                <h2 class="card-title">Role performance</h2>
                                <div class="row">


                                    <div class="col-xl-3 col-lg-3">

                                        <label>Awareness of roles</label>
                                        <input type="text" name="awarenessOfRoles"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Role expectations</label>
                                        <input type="text" name="roleExpectations"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Role Balance</label>
                                        <input type="text" name="roleBalance"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Competency</label>
                                        <input type="text" name="competency"><br>

                                    </div>
                                </div>
                            </div>
                            <div class="skill">
                                <h2 class="card-title">Balanced life style</h2>
                                <div class="row">


                                    <div class="col-xl-3 col-lg-3">

                                        <label>Time Use and Routines</label>
                                        <input type="text" name="timeUseRoutines"><br>

                                    </div>
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Habits</label>
                                        <input type="text" name="habits"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Mix of Occupations:</label>
                                        <input type="text" name="mixOfOccupations"><br>

                                    </div>



                                </div>
                            </div>
                            <div class="skill">
                                <h2 class="card-title">Motivation</h2>
                                <div class="row">


                                    <div class="col-xl-3 col-lg-3">

                                        <label>Active involvement</label>
                                        <input type="text" name="activeInvolvement"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Motives and drives</label>
                                        <input type="text" name="motivesAndDrives"><br>

                                    </div>
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Shows Interest</label>
                                        <input type="text" name="showsInterest"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Goal directed behaviour</label>
                                        <input type="text" name="goalDirectedBehaviour"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Locus of Control:</label>
                                        <input type="text" name="locusOfControl"><br>

                                    </div>

                                </div>
                            </div>
                            <div class="skill">
                                <h3 class="card-title">Self esteem</h3>
                                <div class="row">




                                    <div class="col-xl-3 col-lg-3">

                                        <label>Commitment to task /situation</label>
                                        <input type="text" name="commitmentToTaskSituation"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Using feedback</label>
                                        <input type="text" name="usingFeedback"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Self-worth</label>
                                        <input type="text" name="selfWorth"><br>

                                    </div>
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Attitude towards self: Self assurance</label>
                                        <input type="text" name="attitudeSelfAssurance"><br>

                                    </div>
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Attitude towards self: Self satisfaction</label>
                                        <input type="text" name="attitudeSelfSatisfaction"><br>

                                    </div>
                                    <div class="col-xl-3 col-lg-3">

                                        <label>Awareness of Qualities</label>
                                        <input type="text" name="awarenessOfQualities"><br>

                                    </div>


                                    <div class="col-xl-3 col-lg-3">

                                        <label>Social presence</label>
                                        <input type="text" name="socialPresence"><br>

                                    </div>

                                </div>

                            </div>
                            <div class="skill">
                                <h2 class="card-title">Affect</h2>
                                <div class="row">

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Repertoire of Emotions:</label>
                                        <input type="text" name="repertoireOfEmotions"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Control</label>
                                        <input type="text" name="emotionControl"><br>

                                    </div>

                                    <div class="col-xl-3 col-lg-3">

                                        <label>Mood</label>
                                        <input type="text" name="moods"><br>

                                    </div>

                                </div>
                            </div>
                            @if($checkinitialApomDone == 0)
                            <div class="col-xl-3 col-lg-3">
                                <label>Group:</label>
                                <select name="group">
                                    <option value="">Select-Group</option>
                                    @foreach($groupList as $value)
                                    <option value="{{$value['id']}}">{{$value['group_name']}}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select><br>
                            </div>
                            @endif

                            <!-- <div class="row">
                                
                                
                            </div> -->

                            <button class="btn-prev" data-step="5">Previous</button>
                            <button type="submit" id="apomSubmit" class="btn-submit">Submit</button>

                        </div>
                    </form>
                </div>
                @else

                <div class="container">
                    <div class="form-main">
                        <h3>Occupationaldd Therapy Screening on Admission</h3>
                        <div class="row">
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Patient Name : {{$patientApom->patientName}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Date of Screening :
                                    {{date('d-m-Y',strtotime($patientApom->dateOfScreening))}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">ID Number : {{$patientApom->idNumber}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Therapist Doing Interview :
                                    {{$patientApom->therapistName}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Age : {{$patientApom->age}}</span>
                            </div>

                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Duration : {{$patientApom->duration}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Psychiatrist : {{$patientApom->psychiatrist}}</span>
                            </div>

                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Place : {{$patientApom->place}}</span>
                            </div>

                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Psychologist : {{$patientApom->psychologist}}</span>
                            </div>

                            <h3>History</h3>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Previous Admissions / Diagnosis :
                                    {{$patientApom->prev_add_diagnosis}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Compliance / Follow-up :
                                    {{$patientApom->compliance_followup}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Current Complaints : {{$patientApom->complaint}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Other Medical Conditions / Operations :
                                    {{$patientApom->medicalConditions}}</span>
                            </div>
                            <h3>Personal life / Family</h3>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Relationship Status :
                                    {{$patientApom->relationshipStatus}}</span>
                            </div>

                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Name of Partner : {{$patientApom->partnerName}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Duration of Current Relationship :
                                    {{$patientApom->durationOfRelationship}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Quality of Relationship :
                                    {{$patientApom->qualityOfRelationship}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Number of Children / Dependants and Ages :
                                    {{$patientApom->childrenDependants}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Living Arrangements :
                                    {{$patientApom->livingArrangements}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Quality of Relationship in Family :
                                    {{$patientApom->qualityOfRelationshipsInFamily}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Family Stressor / Conflict :
                                    {{$patientApom->familyStressorsConflict}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Support System : {{$patientApom->supportSystem}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Next of kin and contact number for collateral :
                                    {{$patientApom->nextOfKinContact}}</span>
                            </div>
                            <h3>Work Situation</h3>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Job Title / Rank : {{$patientApom->jobTitle}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Employer / Institution : {{$patientApom->employer}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Years in current Job : {{$patientApom->yearsInJob}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Job Satisfaction : {{$patientApom->jobSatisfaction}}</span>
                            </div>
                            <div class="col-xxl-12 mb-4">
                                <div class="work-situation-wrp">

                                    <p><span></span>{{$patientApom->jobRole}}</p>

                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Struggling With :{{$patientApom->strugglingWith}} </span>

                            </div>

                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Other info : {{$patientApom->otherInfo}}</span>
                            </div>
                            <h3>Free Time</h3>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Hobbies / leisure / recreation / social / weekends (frequency /
                                    quality / motivation, balance) : {{$patientApom->hobbiesLeisure}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Mood : {{$patientApom->mood}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Coping : {{$patientApom->coping}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Substance(s) : {{$patientApom->substanceYesNo}}</span>
                            </div>
                            @if($patientApom->substanceYesNo == 'Yes')
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Substance : {{$patientApom->substance1}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Frequency : {{$patientApom->substance1Frequency}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Last use : {{$patientApom->substance1LastUse}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Substance : {{$patientApom->substance2}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Frequency : {{$patientApom->substance2Frequency}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Last use : {{$patientApom->substance2LastUse}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Substance : {{$patientApom->substance3}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Frequency : {{$patientApom->substance3Frequency}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Last use : {{$patientApom->substance3LastUse}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Substance : {{$patientApom->substance4}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Frequency : {{$patientApom->substance4Frequency}}</span>
                            </div>
                            <div class="col-xxl-4 col-lg-4 col-md-4 mb-4">
                                <span class="info-field">Last use : {{$patientApom->substance4LastUse}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">1. Have you ever felt you ought to cut down on your drinking or
                                    drug use? : {{$patientApom->cutDown}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">2. Have people annoyed you by criticizing your drinking or drug
                                    use? : {{$patientApom->peopleAnnoyed}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">3. Have you felt bad or guilty about your drinking or drug use?
                                    : {{$patientApom->feltBadGuilty}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">4. Have you ever had a drink or used first thing in the morning
                                    to steady your nerves or to get rid of a hangover? :
                                    {{$patientApom->drinkUsedMorning}}</span>
                            </div>
                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Expectations / goals for admission :
                                    {{$patientApom->expectationsGoals}}</span>
                            </div>
                            @endif
                            <h3>APOM items</h3>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Attention : {{$patientApom->attention}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Non-verbal:Eye contact :
                                    {{$patientApom->nonVerbalEyeContact}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Verbal:Use of speech : {{$patientApom->verbalSpeech}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Verbal:Content : {{$patientApom->verbalContent}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Relations:Social Norms :
                                    {{$patientApom->relationsSocialNorms}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Relations:Rapport : {{$patientApom->relationsRapport}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Personal Care, hygiene, grooming:
                                    {{$patientApom->personalCare}} </span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Assertiveness : {{$patientApom->assertiveness}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Stress Management : {{$patientApom->stressManagement}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Conflict management :
                                    {{$patientApom->conflictManagement}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Problem Solving Skills :
                                    {{$patientApom->problemSolvingSkills}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Role balance : {{$patientApom->roleBalance}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Time use and routines :
                                    {{$patientApom->timeUseRoutines}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Habits : {{$patientApom->habits}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Mix of occupations : {{$patientApom->mixOfOccupations}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Shows interest : {{$patientApom->showsInterest}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Locus of control : {{$patientApom->locusOfControl}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Self-worth : {{$patientApom->selfWorth}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Attitude towards self :Self assurance:
                                    {{$patientApom->attitudeSelfAssurance}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Attitude towards self :Self satisfaction:
                                    {{$patientApom->attitudeSelfSatisfaction}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Awareness of qualities :
                                    {{$patientApom->awarenessOfQualities}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Repertoire of emotions :
                                    {{$patientApom->repertoireOfEmotions}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Emotion control : {{$patientApom->emotionControl}}</span>
                            </div>
                            <div class="col-xxl-6 col-md-6 col-lg-6 mb-4">
                                <span class="info-field">Mood : {{$patientApom->moods}}</span>
                            </div>

                            <div class="col-xxl-12 col-lg-12 mb-4">
                                <span class="info-field">Group : {{ $patientApom->group->group_name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Initialize the wizard
                        var currentStep = 1;
                        showStep(currentStep);

                        // Store form data in an object
                        var formData = {};

                        // Handle "Next" button click
                        $(".btn-next").on("click", function() {
                            var currentForm = $('[data-step="' + currentStep + '"] form');
                            currentForm.serializeArray().forEach(function(input) {
                                formData[input.name] = input.value;
                            });

                            currentStep++;
                            showStep(currentStep);
                        });

                        // Handle "Previous" button click
                        $(".btn-prev").on("click", function() {
                            currentStep--;
                            showStep(currentStep);
                        });

                        // Function to show the current step and hide others
                        function showStep(stepNumber) {
                            $(".wizard-step").removeClass("active");
                            $('[data-step="' + stepNumber + '"]').addClass("active");
                        }
                    });

                    $(document).ready(function() {
                        // Show/hide substance details based on user selection
                        $('input[name="substanceYesNo"]').change(function() {
                            var selectedValue = $(this).val();
                            if (selectedValue === "Yes") {
                                $('#substanceYes').show();
                            } else if (selectedValue === "No") {
                                $('#substanceYes').hide();
                            }
                        });
                    });

                    function setDefaultDate() {
                        // Get the current date
                        const currentDate = new Date();

                        // Format the date to "yyyy-mm-dd" (the format required by the date input type)
                        const year = currentDate.getFullYear();
                        const month = String(currentDate.getMonth() + 1).padStart(2, "0"); // Months are zero-indexed, so we add 1
                        const day = String(currentDate.getDate()).padStart(2, "0");

                        const defaultDate = `${year}-${month}-${day}`;

                        // Set the default date to the input field
                        document.getElementById("dateOfScreening").value = defaultDate;
                    }

                    // Call the function after the page has loaded
                    window.addEventListener("load", setDefaultDate);
                </script>



            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->