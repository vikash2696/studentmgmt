$(document).on("click", '#addStudent', function() {
	$.ajax({
		url: "student/addStudent",
		// data: formData,
		method: "POST",
		success: function(data){
			$(".container-fluid").html(data);
		}
	});
});
