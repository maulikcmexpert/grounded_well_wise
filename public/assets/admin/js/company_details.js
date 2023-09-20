$("#companyDetailForm").validate({
    rules: {
        title: { required: true },
        about_us: { required: true },
        t_c_title: { required: true },
        term_and_condition: { required: true },
        p_p_title: { required: true },
        privacy_policy: { required: true },
    },
    messages: {
        title: {
            required: "Please enter title",
        },
        about_us: {
            required: "Please enter abous us ",
        },
        t_c_title: {
            required: "Please enter terms and condition title",
        },
        term_and_condition: {
            required: "Please enter terms and condition",
        },
        p_p_title: {
            required: "Please enter privacy policy title",
        },
        privacy_policy: { required: "Please enter privacy policy" },
    },
});
