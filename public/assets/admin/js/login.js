$("#kt_sign_in_form").validate({
  rules: {
    email: { required: true, email: true },
    password: { required: true, minlength: 6 },
  },
  messages: {
    email: {
      required: "Please enter email",
      email: "Please enter valid email",
    },
    password: {
      required: "Please enter password",
      minlength: "Password must be grater then and equals to 6 character",
    },
  },
});
