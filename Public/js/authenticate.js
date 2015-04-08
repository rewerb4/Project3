// Delay processing until the DOM has loaded.
$(function() {

	$('#loginForm').submit(function(event) {
		$.ajax({
			url: '/auth',
			type: 'post',
			data: 'username='+$('#username').val()+'&password='+$('#password').val(),
			dataType: 'json',
			success: function(result)
			{
				$('#formError').css('color', 'red');
				if (result.success == true)
				{
					$('#loginError').css('color', 'blue');
				}

				$('#loginError').text(result.message);
			},
			error: function()
			{
				alert('An error has occurred. Please try again later.');
			}
		});
		
		event.preventDefault();
	});

});
