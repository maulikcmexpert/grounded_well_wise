<?php

$totalInsertedSession = count($group_session);
?>
@if($totalInsertedSession == $totalSession)


@foreach($group_session as $key => $value)


<div class="row mt-5 position-relative">

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
        <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0  <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : 'external_start_session_date' ?>" placeholder="Start Session Date" value="{{ $value->session_date}}" autocomplete="off" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
        <span class="availdocerror"></span>
    </div>

    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
        <label class="required fw-bold fs-6 mb-2">Session name</label>
        <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
        <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">start Time</label>
        <input type="time" name="start_time[]" value="{{$groupTime[$key]->start_time}}" class="form-control start_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
        <span class="availdocerror"></span>
    </div>
    <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
        <label class="fw-bold fs-6 mb-2">End Time</label>
        <input type="time" name="end_time[]" value="{{$groupTime[$key]->end_time}}" class="form-control end_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
        <span class="availdocerror"></span>
    </div>

</div>



@endforeach
@elseif($totalInsertedSession < $totalSession) @foreach($group_session as $key=> $value)


    <div class="row mt-5 position-relative">

        <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
            <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
            <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0  <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : 'external_start_session_date' ?>" placeholder="Start Session Date" value="{{ $value->session_date}}" autocomplete="off" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
            <span class="availdocerror"></span>
        </div>

        <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
            <label class="required fw-bold fs-6 mb-2">Session name</label>
            <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
            <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
            <span class="availdocerror"></span>
        </div>
        <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <label class="fw-bold fs-6 mb-2">start Time</label>
            <input type="time" name="start_time[]" value="{{$groupTime[$key]->start_time}}" class="form-control start_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
            <span class="availdocerror"></span>
        </div>
        <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <label class="fw-bold fs-6 mb-2">End Time</label>
            <input type="time" name="end_time[]" value="{{$groupTime[$key]->end_time}}" class="form-control end_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
            <span class="availdocerror"></span>
        </div>

    </div>



    @endforeach
    <?php
    $newSession = $totalSession - $totalInsertedSession;
    ?>
    @if($newSession > 0)
    @for($i=1;$i<=$newSession;$i++) <div class="row mt-5 position-relative">

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
        @endif
        @elseif($totalInsertedSession > $totalSession)
        @if($startDatePerGroup[0]->start_date > date('Y-m-d'))

        <?php
        $j = 0;
        ?>
        @for($i=1;$i<=$totalSession;$i++) <div class="row mt-5 position-relative">

            <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
                <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
                <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0 " placeholder="Start Session Date" value="{{ $group_session[$j]->session_date}}" autocomplete="off" <?= ($group_session[$j]->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                <span class="availdocerror"></span>
            </div>

            <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
                <label class="required fw-bold fs-6 mb-2">Session name</label>
                <input type="hidden" name="session_id[]" value="{{ $group_session[$j]->id}}" class="form-control session_id">
                <input type="text" name="session_name[]" value="{{ $group_session[$j]->session_name}}" class="form-control session_name">
                <span class="availdocerror"></span>
            </div>
            <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
                <label class="fw-bold fs-6 mb-2">start Time</label>
                <input type="time" name="start_time[]" value="{{$group_session[$j]->start_time}}" class="form-control start_time">
                <span class="availdocerror"></span>
            </div>
            <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
                <label class="fw-bold fs-6 mb-2">End Time</label>
                <input type="time" name="end_time[]" value="{{$group_session[$j]->end_time}}" class="form-control end_time">
                <span class="availdocerror"></span>
            </div>

            </div>


            <?php $j++; ?>
            @endfor
            @else
            @foreach($group_session as $key => $value)

            <div class="row mt-5 position-relative">

                <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
                    <label class="required fw-bold fs-6 mb-2">Start Session Date</label>
                    <input type="text" name="start_session_date[]" class="form-control form-control-solid mb-3 mb-lg-0  <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : 'external_start_session_date' ?>" placeholder="Start Session Date" value="{{ $value->session_date}}" autocomplete="off" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                    <span class="availdocerror"></span>
                </div>

                <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6 d-flex flex-column">
                    <label class="required fw-bold fs-6 mb-2">Session name</label>
                    <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                    <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                    <span class="availdocerror"></span>
                </div>
                <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
                    <label class="fw-bold fs-6 mb-2">start Time</label>
                    <input type="time" name="start_time[]" value="{{$groupTime[$key]->start_time}}" class="form-control start_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                    <span class="availdocerror"></span>
                </div>
                <div class="col-12 col-xxl-3 col-xl-3 col-lg-4 col-md-6">
                    <label class="fw-bold fs-6 mb-2">End Time</label>
                    <input type="time" name="end_time[]" value="{{$groupTime[$key]->end_time}}" class="form-control end_time" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
                    <span class="availdocerror"></span>
                </div>

            </div>


            @endforeach
            @endif
            @endif
            <script>
                $(".external_start_session_date").datepicker({
                    dateFormat: "yy-mm-dd",
                    autoclose: true,
                    minDate: 0, // Set minDate to 0 to disable dates before today
                    daysOfWeekDisabled: [0, 6],
                    todayHighlight: true,
                });
            </script>