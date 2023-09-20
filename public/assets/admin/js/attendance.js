$(document).ready(function () {
  const base_url = $("#base_url").val();
  $(".patientAttendance").change(function () {
    var patient_id = $(this).val();
    var session_id = $(this).attr("session_id");
    var group_id = $(this).attr("group_id");
    if ($(this).prop("checked") == true) {
      var checked = "1";
    } else {
      var checked = "0";
    }
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      method: "POST",
      url: base_url + "admin/group/store_patient_attendance",
      data: {
        patient_id: patient_id,
        session_id: session_id,
        group_id: group_id,
        checked: checked,
      },
      success: function (output) {},
    });
  });
});
