<div class="row mt-5  position-relative">
    <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4 d-flex flex-column">
        <label class="fw-bold fs-6 mb-2">Assign Therapist</label>

        <select class="form-control form-select doctor_id" name="doctor_id[]" id="multiple-select-field" data-placeholder="Choose anything">
            <option value="">Select Therapist</option>
            @foreach($doctors as $value)
            <option value="{{ $value->id}}">{{ $value->first_name.' '.$value->last_name}}</option>
            @endforeach
        </select>
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4">
        <label class="fw-bold fs-6 mb-2">start Time</label>
        <input type="time" name="start_time[]" class="form-control start_time">
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-4 col-lg-4 col-md-4 col-sm-4">
        <label class="fw-bold fs-6 mb-2">End Time</label>
        <input type="time" name="end_time[]" class="form-control end_time">
        <span class="availdocerror"></span>
    </div>
    <span class="btn otremove"><i class="fa fa-close"></i></span>

</div>