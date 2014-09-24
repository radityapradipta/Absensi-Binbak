$(document).ready(function(){
	
	$("select").change(function() {
		var id=$("#absent-department").val();
		var month=$("#absent-month").val();
		var year=$("#absent-year").val();
		//alert(id+" "+month+" "+year+" ");
		window.location.replace("http://localhost:8000/absensi/department/"+id+"/year/"+year+"/month/"+month+"/")
	});

});