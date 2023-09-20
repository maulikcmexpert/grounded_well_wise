$(function () {
  const base_url = $("#base_url").val();
  var errordoctorAssign = 0;
  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,

    ajax: base_url + "admin/group",
    columns: [
      { data: "number", name: "number" },
      { data: "group_name", name: "group_name" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
      },
    ],
  });

  $(document).on("click", "#delete_group", function (event) {
    event.preventDefault();
    var URL = $(this).data("url");
    swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete group, it will be also gone session of this group forever.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          method: "DELETE",
          url: URL,
          dataType: "json",
          success: function (output) {
            if (output == true) {
              table.ajax.reload();
              toastr.success("Group Deleted successfully !");
            } else {
              toastr.error("Group don't Deleted !");
            }
          },
        });
      }
    });
  });

  $("#groupForm").validate({
    rules: {
      group_name: {
        required: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/group/check_group_is_already",
          method: "POST",
          data: {
            group_name: function () {
              return $("input[name='group_name']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      group_details: { required: true },
      start_session_date: { required: true },
      total_session: { required: true, number: true, min: 1 },
    },
    messages: {
      group_name: {
        required: "Please enter group name",
        remote: "Group name is already exist",
      },
      group_details: {
        required: "Please enter group details",
      },
      start_session_date: {
        required: "Please select start session date",
      },
      total_session: {
        required: "Please enter number of sessions",
        number: "Please enter in digit",
        min: "Please enter digit grater than 0",
      },
    },
    submitHandler: function (form) {
      var error = errorHandle();

      if (error == 0 && errordoctorAssign == 0) {
        form.submit();
      }
    },
  });

  $("#addMore").on("click", function (event) {
    event.preventDefault();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/ajax_doctor_call",
      type: "POST",
      success: function (output) {
        $("#doctorAssign").append(output);
      },
    });
  });

  $("#addUpdateMore").on("click", function (event) {
    event.preventDefault();

    var group_id = $(this).attr("group_id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/ajax_update_doctor_call",
      type: "POST",
      data: { group_id: group_id },
      success: function (output) {
        $("#doctorAssign").append(output);
      },
    });
  });

  $(document).on("keyup", ".total_session", function () {
    var totalSession = $(this).val();

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/ajax_session_call",
      type: "POST",
      data: { totalSession: totalSession },
      success: function (output) {
        $("#addSession").html(output);
      },
    });
  });

  // update Group //

  // Get the pathname of the URL
  var pathname = window.location.pathname;
  var pathSegments = pathname.split("/");
  var main_position = $.inArray("group", pathSegments);
  var last_position = $.inArray("edit", pathSegments);
  if (main_position !== -1 && last_position !== -1) {
    var totalSession = $(".update_total_session").val();
    var groupId = $("#groupId").val();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/ajax_update_session",
      data: { totalSession: totalSession, groupId: groupId },
      type: "POST",
      success: function (output) {
        // for (var i = 1; i <= totalSession; i++) {
        $("#addSession").html(output);
        // }
      },
    });
  }

  $(document).on("keyup", ".update_total_session", function () {
    var totalSession = $(this).val();
    var groupId = $("#groupId").val();
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/ajax_update_session",
      data: { totalSession: totalSession, groupId: groupId },
      type: "POST",
      success: function (output) {
        // for (var i = 1; i <= totalSession; i++) {
        $("#addSession").html(output);
        // }
      },
    });
  });
  // update Group //

  $(document).on("click", ".otremove", function () {
    $(this).parent().remove();
    var totalSession = $("#total_session").val();

    $("#total_session").val(totalSession - 1);
  });

  $(document).on("click", ".otupdateremove", function () {
    var outrThis = $(this);
    var doctor_id = $(this).attr("doctor_id");
    var group_id = $(this).attr("group_id");
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: base_url + "admin/group/remove_assign_doctor",
      type: "POST",
      dataType: "json",
      data: { doctor_id: doctor_id, group_id: group_id },
      success: function (output) {
        if (output == true) {
          outrThis.parent().remove();
          location.reload();
          toastr.success("Doctor removed successfully from this group !");
        } else {
          location.reload();
          toastr.error("Doctor don't removed !");
        }
      },
    });
  });

  function errorHandle() {
    var error = 0;
    $(".session_name").each(function () {
      var session_name = $(this).val();
      if (session_name.length == "") {
        $(this)
          .next("span")
          .text("Please enter session name")
          .addClass("text-danger");
        error++;
      }
    });
    return error;
  }

  $(document).on("change", ".doctor_id", function () {
    var outerThis = $(this); //

    var doctor_id = $(this).val();
    var startDate = $(".start_session_date").val();
    var start_time = $(this).parent().next().find(".start_time").val();
    var end_time = $(this).parent().next().next().find(".end_time").val();
    return checkDoctorAvailable(
      outerThis,
      doctor_id,
      start_time,
      end_time,
      startDate
    );
  });

  $(document).on("change keyup", ".start_time", function () {
    var outerThis = $(this); //

    var startDate = $(".start_session_date").val();
    var doctor_id = $(this).parent().prev().find(".doctor_id").val();
    var start_time = $(this).val();
    var end_time = $(this).parent().next().find(".end_time").val();

    if (start_time < end_time) {
      $(outerThis).siblings(".availdocerror").text("");

      return checkDoctorAvailable(
        outerThis,
        doctor_id,
        start_time,
        end_time,
        startDate
      );
    } else {
      if (start_time.length != 0 && end_time.length != 0) {
        $(outerThis)
          .siblings(".availdocerror")
          .text("start time should be less than end time")
          .addClass("text-danger");
      }
      errordoctorAssign = 1;
      return errordoctorAssign;
    }
  });

  $(document).on("change keyup", ".end_time", function () {
    var outerThis = $(this); //

    var end_time = $(this).val();
    var startDate = $(".start_session_date").val();
    var start_time = $(this).parent().prev().find(".start_time").val();
    var doctor_id = $(this).parent().prev().prev().find(".doctor_id").val();
    if (end_time > start_time) {
      return checkDoctorAvailable(
        outerThis,
        doctor_id,
        start_time,
        end_time,
        startDate
      );
    } else {
      if (start_time.length != 0 && end_time.length != 0) {
        $(outerThis)
          .siblings(".availdocerror")
          .text("End time should be grater than start time")
          .addClass("text-danger");

        errordoctorAssign = 1;
        return errordoctorAssign;
      }
    }
  });

  function checkDoctorAvailable(
    outerThis,
    doctor_id,
    start_time,
    end_time,
    startDate
  ) {
    var total_session = $("#total_session").val();

    if (
      start_time.length != "" &&
      end_time.length != "" &&
      doctor_id.length != "" &&
      startDate != "" &&
      total_session != "" &&
      outerThis != ""
    ) {
      errordoctorAssign = 0;
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "admin/group/is_doctor_available",
        type: "POST",
        data: {
          doctor_id: doctor_id,
          start_time: start_time,
          end_time: end_time,
          startDate: startDate,
          total_session: total_session,
        },
        success: function (output) {
          if (output == "false") {
            $(outerThis)
              .siblings(".availdocerror")
              .text("Doctor is already allocated on this time")
              .addClass("text-danger");

            errordoctorAssign++;
            return errordoctorAssign;
          } else {
            $(outerThis).siblings(".availdocerror").text("");
          }
        },
      });
    }
  }

  $(document).on("change", ".start_session_date", function () {
    if ($(this).val()) {
      // If a date is selected, show the other div
      $("#doctorAssign").show();
    } else {
      // If no date is selected, hide the other div
      $("#doctorAssign").hide();
    }
  });

  // $(function () {
  //   var dtToday = new Date();

  //   var month = dtToday.getMonth() + 1;
  //   var day = dtToday.getDate();
  //   var year = dtToday.getFullYear();
  //   if (month < 10) month = "0" + month.toString();
  //   if (day < 10) day = "0" + day.toString();

  //   var maxDate = year + "-" + month + "-" + day;

  //   // or instead:
  //   // var maxDate = dtToday.toISOString().substr(0, 10);

  //   $(".start_session_date").attr("min", maxDate);
  // });

  $(document).ready(function () {
    $("#start_session_date").datepicker({
      dateFormat: "yy-mm-dd",
      autoclose: true,
      minDate: 0,
      daysOfWeekDisabled: [0, 6],

      todayHighlight: true,
    });
  });

  // Function to display selected doctors as "like tags"
  $("#multiple-select-field").select2({
    theme: "bootstrap-5",
    width: $(this).data("width")
      ? $(this).data("width")
      : $(this).hasClass("w-100")
      ? "100%"
      : "style",
    placeholder: $(this).data("placeholder"),
    closeOnSelect: false,
  });

  //  group Assign
});
