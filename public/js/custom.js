var url = "http://localhost:8000/";

$(document).ready(function() {
    $(".editor").hide();
    $(".alert").hide();

    //MENU VIEW ALLOWANCE
    $("#allowance-button").click(function() {
        var id = $("#allowance-department").val();
        var month = $("#allowance-month").val();
        var year = $("#allowance-year").val();
        window.location.replace(url + "allowance/view/department/" + id + "/year/" + year + "/month/" + month + "/");
    });

    $("#allowance-download-button").click(function() {
        var id = $("#allowance-department").val();
        var month = $("#allowance-month").val();
        var year = $("#allowance-year").val();
        window.location.replace(url + "allowance/download/department/" + id + "/year/" + year + "/month/" + month + "/");
    });

    $("#allowance-select").change(function() {
        var id = $("#allowance-select").val();
        window.location.replace(url + "allowance/manage/department/" + id + "/");
    });

    $("#allowance-save").click(function() {
        var param = {
            id: $("#dept-id").val(),
            weekday_nominal: $("#weekday_nominal").val(),
            weekend_nominal: $("#weekend_nominal").val(),
            cut_nominal: $("#cut_nominal").val()
        };
        $.ajax({
            type: "PUT",
            dataType: "json",
            url: url + "allowance/manage",
            data: param,
            success: function(result) {
                var message = $("#allowance-save-message");
                if (result.valid) {
                    message.text('The allowance is successfully changed.');
                    message.addClass("alert-success");
                    message.show();
                }
            }
        });
    });

    $(".user-edit-button").click(function() {
        var parent = $(this).closest("li");
        $("#edit-id").val(parent.data('id'));
        $("#edit-ssn").val(parent.children(".ssn").text());
        $("#edit-username").val(parent.children(".username").text());
        $("#user-edit-modal").modal();
    });

    $("#edit-password-toggle").click(function() {
        console.log("a" + $('#edit-password-toggle').attr('Checked'));
        if ($('#edit-password-toggle').is(":checked")) {
            $('#edit-password').show();
        } else {
            $('#edit-password').hide();
        }
    });

    //MENU MANAGE USER
    $("#role-select").change(function() {
        var id = $("#role-select").val();
        window.location.replace(url + "user/manage/role/" + id + "/");
    });
    $("#user-add").submit(function(event) {
        event.preventDefault();
        $.post(url + 'user/add', $(this).serializeArray(), function(result) {
            location.reload(true);
        }, 'json');
    });
    $("#user-update").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'PUT',
            url: url + 'user/update',
            dataType: "json",
            data: $(this).serializeArray(),
            success: function(result) {
                if (result.valid) {//berhasil
                    location.reload(true);
                }
            }
        });
    });
    $(".user-delete-button").click(function() {
        var parent = $(this).closest("li");
        var username = parent.find('.username').text();
        var c = confirm("Apakah Anda yakin menghapus " + username + "?");
        if (c) {
            $.ajax({
                type: 'DELETE',
                url: url + 'user/delete',
                dataType: "json",
                data: {id: parent.data('id')},
                success: function(result) {
                    if (result.valid === 1) {//berhasil
                        parent.remove();
                    }
                }
            });
        }
    });

    //MENU CONVERT DOCUMENT
    $('#fileuploader').uploadFile({
        url: url + 'converter/upload',
        allowedTypes: 'mdb',
        fileName: 'file'
    });
    $('#convert-button').click(function() {
        $.post(url + 'converter/convert', function(data) {
            $('#loading').hide();
            $('<p/>').text(data).appendTo('.page_content_under');
        });
        $('#loading').show();
    });

    //MENU EDIT PROFILE
    $("#edit-profile").submit(function(event) {
        event.preventDefault();
        if ($("#new-password").val().localeCompare($("#confirm-password").val()) != 0) {
            message.text("The password does not match the confirmation.");
            message.addClass("alert-danger");
            message.show();
        } else {
            var param = {
                'old-password': $("#old-password").val(),
                'new-password': $("#new-password").val()
            };
            $.post(url + "user/edit", param, function(data) {
                if (data.valid) {
                    var message = $("#profile-edit-message");
                    message.text(data.message);
                    message.addClass("alert-success");
                    message.show();
                    $("#old-password").val("");
                    $("#new-password").val("");
                    $("#confirm-password").val("");
                } else {
                    var message = $("#profile-edit-message");
                    message.text(data.message);
                    message.addClass("alert-danger");
                    message.show();
                }
            });
        }
    });
});