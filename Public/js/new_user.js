// Delay processing until the DOM has loaded.
$(function() {

	$('#userForm').submit(function(event) {
		
		if ($('#password').val() == $('#passwordRetype').val())
		{
			$.ajax({
				url: '/new_user',
				type: 'post',
				data: 'username='+$('#username').val()+'&password='+$('#password').val(),
				dataType: 'json',
				success: function(result)
				{
					$('#formError').css('color', 'red');
					if (result.success == true)
					{
						$('#formError').css('color', 'blue');
					}
	
					$('#formError').text(result.message);
				},
				error: function()
				{
					alert('An error has occurred. Please try again later.');
				}
			});
		}
		else
		{
			$('#formError').text('Password does not match retype.');
		}
		
		event.preventDefault();
	});

});
