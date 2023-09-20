$(function () {
    const base_url = $("#base_url").val();
    const group_id = $("#group_id").val();
    var table = $(".data-table").DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "admin/group/session_list/" + group_id,
        columns: [
            { data: "number", name: "number" },
            { data: "group_name", name: "group_name" },
            { data: "session_name", name: "session_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#totalSession").validate({
        rules: {
            total_session: {
                required: true,
                number: true,
            },
        },
        messages: {
            total_session: {
                required: "Please enter total number of session",
                number: "Pleae enter only digit",
            },
        },
        submitHandler: function (form) {
            $sessionCount = $("#totalCount").val();
            if ($sessionCount != 0) {
                swal({
                    title: `Are you sure you want to create session ?`,
                    text: "You have already added session if you create again new session will be addon .",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                }).then((willCreate) => {
                    if (willCreate) {
                        form.submit();
                    }
                });
            } else {
                form.submit();
            }
        },
    });

    $(document).on("click", "#delete_session", function (event) {
        var URL = $(this).data("url");
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
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    method: "DELETE",
                    url: URL,
                    dataType: "json",
                    success: function (output) {
                        if (output == true) {
                            table.ajax.reload();
                            toastr.success(
                                "Group Session Deleted successfully !"
                            );
                        } else {
                            toastr.error("Group Session don't Deleted !");
                        }
                    },
                });
            }
        });
    });

    $("#groupSessionForm").validate({
        rules: {
            group_id: { required: true },
            session_name: {
                required: true,
            },
            session_details: { required: true },
        },
        messages: {
            group_id: { required: "Please select group" },
            session_name: {
                required: "Please enter session name",
            },
            session_details: {
                required: "Please enter session details",
            },
        },
    });
});
