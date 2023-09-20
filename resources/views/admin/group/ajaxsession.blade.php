@for($i = 1; $i <= $total_sessoin; $i++) <div class="col-4 position-relative">
    <label class="required fw-bold fs-6 mb-2">Session name</label>
    <input type="text" name="session_name[]" class="form-control session_name">
    <span class="availdocerror"></span>
    <button class="btn btn-close otremove">

        </div>
        @endfor