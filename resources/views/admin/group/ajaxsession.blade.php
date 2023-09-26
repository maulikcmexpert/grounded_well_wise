@for($i = 1; $i <= $total_sessoin; $i++) <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
    <label class="required fw-bold fs-6 mb-2">Session name</label>
    <input type="text" name="session_name[]" class="form-control session_name">
    <span class="availdocerror"></span>
    <span class=" sessionremove"><i class="fa fa-close"></i></span>

    </div>
    @endfor