<?php
$totalInsertedSession = count($group_session);
?>
@if($totalInsertedSession == $totalSession)

@foreach($group_session as $value)

<div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
    <label class="required fw-bold fs-6 mb-2">Session name</label>
    <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
    <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
    <span class="availdocerror"></span>
</div>

@endforeach
@elseif($totalInsertedSession < $totalSession) @foreach($group_session as $value) <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
    <label class="required fw-bold fs-6 mb-2">Session name</label>
    <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
    <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'readonly' : '' ?>>
    <span class="availdocerror"></span>
    </div>

    @endforeach
    <?php
    $newSession = $totalSession - $totalInsertedSession;
    ?>
    @if($newSession > 0)
    @for($i=1;$i<=$newSession;$i++) <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
        <label class="required fw-bold fs-6 mb-2">Session name</label>
        <input type="text" name="session_name[]" class="form-control session_name">
        <span class="availdocerror"></span>
        <span class=" sessionremove"><i class="fa fa-close"></i></span>

        </div>

        @endfor
        @endif


        @elseif($totalInsertedSession > $totalSession)
        @if($startDatePerGroup[0]->start_date > date('Y-m-d'))

        <?php
        $j = 0;
        ?>
        @for($i=1;$i<=$totalSession;$i++) <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
            <label class="required fw-bold fs-6 mb-2">Session name</label>
            <input type="hidden" name="session_id[]" value="{{ $group_session[$j]->id}}" class="form-control session_id">
            <input type="text" name="session_name[]" value="{{ $group_session[$j]->session_name}}" class="form-control session_name">
            <span class="availdocerror"></span>

            </div>


            <?php $j++; ?>
            @endfor

            @else

            @foreach($group_session as $value)

            <div class="col-12 col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="required fw-bold fs-6 mb-2">Session name</label>
                <input type="hidden" name="session_id[]" value="{{ $value->id}}" class="form-control session_id">
                <input type="text" name="session_name[]" value="{{ $value->session_name}}" class="form-control session_name" <?= ($value->session_date <= date('Y-m-d')) ? 'disabled' : '' ?>>
                <span class="availdocerror"></span>

            </div>


            @endforeach
            @endif
            @endif