$(function () {
  const base_url = $("#base_url").val();

  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,

    ajax: base_url + "admin/subadmin",
    columns: [
      { data: "number", name: "number" },
      { data: "first_name", name: "first_name" },
      { data: "email", name: "email" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
      },
    ],
  });

  $("#subadminForm").validate({
    rules: {
      first_name: { required: true },
      last_name: { required: true },
      email: {
        required: true,
        email: true,
        remote: {
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: base_url + "admin/subadmin/check_email_is_already",
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
      password: { required: true, min: 6 },
    },
    messages: {
      first_name: {
        required: "Please enter first name",
      },
      last_name: {
        required: "Please enter last name",
      },
      email: {
        required: "Please enter email",
        email: "Please enter valid email",
        remote: "Email is already exist",
      },
      password: {
        required: "Please enter password",
        min: "Password must be 6 or grater than 6 character",
      },
    },
  });

  $(document).on("click", "#delete_subadmin", function (event) {
    event.preventDefault();
    var URL = $(this).data("url");
    swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete subadmin, it will be also gone subadmin from database.",
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
              toastr.success("Subadmin Deleted successfully !");
            } else {
              toastr.error("Subadmin don't Deleted !");
            }
          },
        });
      }
    });
  });
});
