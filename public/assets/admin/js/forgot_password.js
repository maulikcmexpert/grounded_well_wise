$("#kt_password_reset_form").validate({
  rules: {
    email: {
      required: true,
      remote: {
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "check_email_is_registered",
        method: "POST",
        data: {
          email: function () {
            return $("input[name='email']").val();
          },
        },
      },
    },
  },
  messages: {
    email: {
      required: "Please enter email",
      remote: "Email is not registered",
    },
  },
});

$("#resetPassword").validate({
  rules: {
    email: {
      required: true,
    },
    password: {
      required: true,
      minlength: 8,
    },
    password_confirmation: {
      required: true,
      minlength: 8,
      equalTo: "#password",
    },
  },
  messages: {
    email: {
      required: "Please enter email",
      remote: "Email is not registered",
    },
    password: {
      required: "Please enter password",
      minlength: "Password must be grater then and equal to 8 char",
    },
    password_confirmation: {
      required: "Please enter confirm password",
      minlength: "Password must be grater then and equal to 8 char",
      equalTo: "Password does not match",
    },
  },
});
