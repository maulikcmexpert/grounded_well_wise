$(function () {
  const base_url = $("#base_url").val();

  var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,

    ajax: base_url + "admin/ras_question",
    columns: [
      { data: "number", name: "number" },
      { data: "question", name: "question" },
      {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
      },
    ],
  });

  $(document).on("click", "#addMore", function (event) {
    event.preventDefault();
    var html = "";

    html += '<div class="fv-row mb-7 fv-plugins-icon-container">';
    html += '<label class="required fw-bold fs-6 mb-2">Question</label>';
    html +=
      '<input type="text" name="question[]" class="form-control form-control-solid mb-2 mb-lg-0" placeholder="Question" value="">';
    html +=
      '<button class="btn btn-light me-3" id="remove">Remove</button>  <span class="text-danger"></span></div>';

    $(".rasQuestion").append(html);
  });

  $(document).on("click", "#remove", function () {
    $(this).parent().remove();
  });

  $(document).on("click", "#questionSubmit", function (event) {
    var subscale = $("#subscale").val();

    if (subscale === "") {
      $(".error-subscale").html("Please select question subscale.");
      event.preventDefault();
    }
    var textInputs = $(".question");
    for (var i = 0; i < textInputs.length; i++) {
      var textBox = $(textInputs[i]);
      if (textBox.val() === "") {
        $(".error-question").html("Please enter question.");
        event.preventDefault();
        return false;
      }
    }
  });

  $(document).on("click", "#delete_question", function (event) {
    event.preventDefault();
    var URL = $(this).data("url");
    swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete question, it will be also gone question from database.",
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
              toastr.success("Question Deleted successfully !");
            } else {
              toastr.error("Question don't Deleted !");
            }
          },
        });
      }
    });
  });
});
