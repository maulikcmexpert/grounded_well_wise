@for($i = 1; $i <= $total_sessoin; $i++) <div class="row mt-5 position-relative">

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
        <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0 external_start_session_date" placeholder="Start Session Date" value="" autocomplete="off">
        <span class="availdocerror"></span>
    </div>

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Session name</label>
        <input type="text" name="session_name[]" class="form-control session_name">
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">start Time</label>
        <input type="time" name="start_time[]" class="form-control start_time">
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">End Time</label>
        <input type="time" name="end_time[]" class="form-control end_time">
        <span class="availdocerror"></span>
    </div>
    <span class=" externalsessionremove"><i class="fa fa-close"></i></span>

    </div>

    @endfor

    <script>
        $(".external_start_session_date").datepicker({
            dateFormat: "yy-mm-dd",
            autoclose: true,
            minDate: 0, // Set minDate to 0 to disable dates before today
            daysOfWeekDisabled: [0, 6],
            todayHighlight: true,
        });
    </script>