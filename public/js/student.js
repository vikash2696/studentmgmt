$(document).on("click", '#addStudent', function() {
	$.ajax({
		url: "student/addStudent",
		// data: formData,
		method: "GET",
		success: function(data){
			$(".container-fluid").html(data);
		}
	});
});
 
 $(document).on("click", '#cancel_add_std_btn', function() {
	$.ajax({
		url: "student",
		method: "GET",
		success: function(data){
			$(".container-fluid").html(data);
		}
	});
});

 $(document).on("click", '#student_add_btn', function() {
 	var form=$("#student");
	$.ajax({
		url: "student/addStudent",
		data:form.serialize(),
		method: "POST",
		dataType: "json",
		success: function(data){
			$.ajax({
				url: "student",
				method: "GET",
				success: function(data){
					$(".container-fluid").html(data);
				}
			});
		}
	});
});