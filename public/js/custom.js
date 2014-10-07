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
            url: url + "allowance/manage/",
            data: param,
            success: function(result) {
                if (result.valid) {
                    $("#allowance-save-message").text("Success!");
                    $("#allowance-save-message").addClass("alert-success");
                    $("#allowance-save-message").show();
                }
            },
            error: function(result) {
                $("#allowance-save-message").text("Error!");
                $("#allowance-save-message").addClass("alert-danger");
                $("#allowance-save-message").show();
            }
        });

    });
	
	$(".user-edit-button").click(function(){
		var parent=$(this).closest("li");		
		$("#edit-ssn").val(parent.children(".ssn").text());
		$("#edit-username").val(parent.children(".username").text());
		$("#user-edit-modal").modal();
	});
	
	$("#edit-password-toggle").click(function(){
		console.log("a"+$('#edit-password-toggle').attr('Checked'));
		if($('#edit-password-toggle').is(":checked") ){
			$('#edit-password').show();
		}else{
			$('#edit-password').hide();
		}
	});
	
    //MENU MANAGE USER
    $("#role-select").change(function() {
        var id = $("#role-select").val();
        window.location.replace(url + "user/manage/role/" + id + "/");
    });
	
    $("#convert-button").click(function() {
        $.post(url + "converter/", function(data) {
            $('#loading').hide();
        });
        $('#loading').show();
    });
});