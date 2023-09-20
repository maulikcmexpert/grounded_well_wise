$(function () {
  const base_url = $("#base_url").val();

  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,

    ajax: base_url + "admin/doctor",
    columns: [
      { data: "number", name: "number" },
      { data: "name", name: "name" },
      { data: "profession", name: "profession" },

      { data: "group_assignment", name: "group_assignment" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: true,
      },
    ],
  });

  $("#DoctorForm").validate({
    rules: {
      avatar: { required: true, accept: "image/*" },
      first_name: { required: true },
      last_name: { required: true },
      date_of_birth: { required: true },
      profession: { required: true },
      email: {
        required: true,
        email: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/doctor/check_email_is_already",
          method: "POST",
          data: {
            email: function () {
              return $("input[name='email']").val();
            },
          },
        },
      },
      identity_number: {
        required: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/doctor/check_identity_number_is_already",
          method: "POST",
          data: {
            identity_number: function () {
              return $("input[name='identity_number']").val();
            },
          },
        },
      },
      password: { required: true, min: 6 },
      gender: { required: true },
      contact_number: { required: true, number: true },
    },
    messages: {
      avatar: {
        required: "Please upload avatar",
        accept: "Please upload avtar in jpg,png,jpeg format",
      },
      first_name: { required: "Please enter first name" },
      last_name: { required: "Please enter last name" },
      profession: { required: "Please enter profession" },
      date_of_birth: { required: "Please select date of birth" },
      email: {
        required: "Please enter email",
        email: "Please enter vaild email",
        remote: "Email is already exist",
      },
      identity_number: {
        required: "Please enter identity number",
        remote: "identity_number is already exist",
      },
      password: {
        required: "Please enter password",
        min: "Password must be minimum 6 and more character",
      },
      gender: { required: "Please enter gender" },
      contact_number: {
        required: "Please enter contact number",
        number: "Please enter only digit",
      },
    },
  });

  $("#DoctorUpdateForm").validate({
    rules: {
      avatar: { accept: "image/*" },
      first_name: { required: true },
      last_name: { required: true },
      date_of_birth: { required: true },
      profession: { required: true },
      email: {
        required: true,
        email: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/doctor/check_email_is_already",
          method: "POST",
          data: {
            email: function () {
              return $("input[name='email']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      identity_number: {
        required: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/doctor/check_identity_number_is_already",
          method: "POST",
          data: {
            identity_number: function () {
              return $("input[name='identity_number']").val();
            },
            id: function () {
              return $("input[name='id']").val();
            },
          },
        },
      },
      password: { required: true, min: 6 },
      gender: { required: true },
      contact_number: { required: true, number: true },
    },
    messages: {
      avatar: {
        required: "Please upload avatar",
        accept: "Please upload avtar in jpg,png,jpeg format",
      },
      first_name: { required: "Please enter first name" },
      last_name: { required: "Please enter last name" },
      profession: { required: "Please enter profession" },
      date_of_birth: { required: "Please select date of birth" },
      identity_number: {
        required: "Please enter identity number",
        remote: "identity_number is already exist",
      },
      password: {
        required: "Please enter password",
        min: "Password must be minimum 6 and more character",
      },
      gender: { required: "Please enter gender" },
      contact_number: {
        required: "Please enter contact number",
        number: "Please enter only digit",
      },
    },
  });

  //  Status Handle //

  $(document).on("click", ".changeStatus", function (event) {
    event.preventDefault();

    var status = $(this).attr("statusdata");
    var patient_id = $(this).attr("patient_id");
    if (status == 0) {
      var statusVal = "Inactive";
    } else {
      var statusVal = "Active";
    }
    swal({
      title: `Are you sure you want to ` + statusVal + ` this patient ?`,
      text: "If you " + statusVal + " this patient, Heshe will not be access.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willStatus) => {
      if (willStatus) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          method: "POST",
          url: base_url + "patient/change_status",
          data: { status: status, patient_id: patient_id },
          success: function (output) {
            if (output == true) {
              table.ajax.reload();
              toastr.success("status is changed");
            } else {
              toastr.error("status is not changed");
            }
          },
        });
      }
    });
  });

  $(document).on("click", "#delete_doctor", function (event) {
    var userURL = $(this).data("url");
    event.preventDefault();
    swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete this, it will be gone forever.",
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
          url: userURL,
          dataType: "json",
          success: function (output) {
            if (output == true) {
              table.ajax.reload();
              toastr.success("Doctor Deleted successfully !");
            } else {
              toastr.error("Doctor don't Deleted !");
            }
          },
        });
      }
    });
  });

  $(document).on("click", ".removeFromGroup", function (event) {
    var assign_id = $(this).attr("id");
    var group_id = $(this).attr("group_id");
    var doctor_id = $(this).attr("doctor_id");

    event.preventDefault();
    swal({
      title: `Are you sure you want to remove this doctor from this group?`,
      text: "If you delete this, it will be gone forever.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willRemove) => {
      if (willRemove) {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          method: "POST",
          url: base_url + "admin/doctor/remove_from_group",
          data: {
            assign_id: assign_id,
            group_id: group_id,
            doctor_id: doctor_id,
          },
          success: function (output) {
            if (output == true) {
              location.reload();

              toastr.success("Doctor removed from group successfully !");
            } else {
              location.reload();

              toastr.error("Doctor don't removed !");
            }
          },
        });
      }
    });
  });

  $(document).on("click", ".group-box", function () {
    var group_id = $(this).find(".assignGroupId").val();
    var doctor_id = $(".doctor_id").val();

    $("#doctorId").val(doctor_id);
    $("#groupId").val(group_id);
  });
});
var error = 0;
$(document).on("change keyup", ".start_time", function () {
  var outerThis = $(this); //

  var group_id = $(".assignGroupId").val();
  var doctor_id = $(".doctor_id").val();
  var start_time = $(this).val();
  var end_time = $(this).parent().next().find(".end_time").val();

  if (start_time < end_time) {
    return checkDoctorAvailable(
      outerThis,
      doctor_id,
      start_time,
      end_time,
      group_id
    );
  } else {
    if (start_time.length != 0 && end_time.length != 0) {
      $(outerThis)
        .siblings(".availdocerror")
        .text("start time should be less than end time")
        .addClass("text-danger");
    }
    error = 1;
    return error;
  }
});

$(document).on("change keyup", ".end_time", function () {
  var outerThis = $(this); //
  var group_id = $(".assignGroupId").val();
  var doctor_id = $(".doctor_id").val();
  var end_time = $(this).val();
  var start_time = $(this).parent().prev().find(".start_time").val();
  if (end_time > start_time) {
    return checkDoctorAvailable(
      outerThis,
      doctor_id,
      start_time,
      end_time,
      group_id
    );
  } else {
    if (start_time.length != 0 && end_time.length != 0) {
      $(outerThis)
        .siblings(".availdocerror")
        .text("End time should be grater than start time")
        .addClass("text-danger");

      error = 1;
      return error;
    }
  }
});

function checkDoctorAvailable(
  outerThis,
  doctor_id,
  start_time,
  end_time,
  group_id
) {
  var domElement = outerThis.get(0); // or var domElement = outerThis[0];

  if (
    start_time.length != "" &&
    end_time.length != "" &&
    doctor_id.length != "" &&
    group_id != "" &&
    outerThis != ""
  ) {
    error = 0;
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: $("#checkDoctorUrl").val(),
      type: "POST",
      data: {
        doctor_id: doctor_id,
        start_time: start_time,
        end_time: end_time,
        group_id: group_id,
      },
      success: function (output) {
        if (output == "false") {
          $(outerThis)
            .siblings(".availdocerror")
            .text("Doctor is already allocated on this time")
            .addClass("text-danger");

          error++;
          return error;
        } else {
          $(outerThis).siblings(".availdocerror").text("");
        }
      },
    });
  }
}

$("#assignTime").validate({
  rules: {
    start_time: { required: true },
    end_time: { required: true },
  },
  messages: {
    start_time: { required: "Please enter start time " },
    end_time: { required: "Please enter end time " },
  },
  submitHandler: function (form) {
    if (error == 0) {
      form.submit();
    }
  },
});
