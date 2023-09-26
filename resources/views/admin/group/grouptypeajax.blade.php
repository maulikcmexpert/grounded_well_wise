<?php
if ($group_type == 'internal') { ?>
    <div class="row internalhtml">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
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
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
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

            </div>
        </div>
        <div class="col-lg-12 mt-5 position-relative">
            <div class="row" id="addSession"></div>
        </div>
        <div class="fv-row mb-7 fv-plugins-icon-container hide" id="doctorAssign" style="display: none;">
            <!--begin::Label-->
            <button class=" btn btn-primary mt-3 mb-3" id="addMore">Add Therapist</button>
            <div class="row mt-5">
                <!--end::Label-->
                <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4 d-flex flex-column">
                    <label class="required fw-bold fs-6 mb-2">Assign Therapist</label>

                    <select class="form-control form-select doctor_id" name="doctor_id[]" data-placeholder="Select Therapist">
                        <option value="">Select Therapist</option>
                        @foreach($doctors as $value)
                        <option value="{{ $value->id}}">{{ $value->first_name.' '.$value->last_name}}</option>
                        @endforeach
                    </select>
                    <span class="availdocerror"></span>
                </div>
                <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4">
                    <label class="required fw-bold fs-6 mb-2">start Time</label>
                    <input type="time" name="start_time[]" class="form-control start_time">
                    <span class="availdocerror"></span>
                </div>
                <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4">
                    <label class="required fw-bold fs-6 mb-2">End Time</label>
                    <input type="time" name="end_time[]" class="form-control end_time">
                    <span class="availdocerror"></span>
                </div>
            </div>

            <!--begin::Input-->


        </div>
    </div>
    <script>
        $("#start_session_date").datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            minDate: 0,
            daysOfWeekDisabled: [0, 6],

            todayHighlight: true,
        });
    </script>
<?php } elseif ($group_type == 'external') { ?>
    <div class="row externalhtml">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-2">Assign Therapist</label>

                <select class="form-control form-select" name="doctor_id" id="externalDoctor">
                    <option value="">Select Therapist</option>
                    @foreach($doctors as $value)
                    <option value="{{ $value->id}}">{{ $value->first_name.' '.$value->last_name}}</option>
                    @endforeach
                </select>
                <!--end::Input-->
                @if ($errors->has('doctor_id'))
                <span class="text-danger">{{ $errors->first('doctor_id') }}</span>
                @endif
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 ">
            <div class="fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-2">Number Of Sessions</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="total_session" class="form-control form-control-solid mb-3 mb-lg-0 total_session" id="external_total_session" placeholder="Number Of Sessions" value="">
                <!--end::Input-->
                @if ($errors->has('total_session'))
                <span class="text-danger">{{ $errors->first('total_session') }}</span>
                @endif
                <div class="fv-plugins-message-container invalid-feedback"></div>

            </div>
        </div>
        <div class="col-lg-12 mt-5 position-relative">
            <div class="row" id="addexternalSession"></div>
        </div>

    </div>

<?php }

?>