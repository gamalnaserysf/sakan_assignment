<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SAKAN - ASSIGNMENT</title>
	<link
		rel="stylesheet"
		href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"
	/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<style>
		/*Custom CSS of Form*/
		body {
			margin: 0;
			padding: 0;
			height: 1100vh;
			background-color: #D0D0D0;
		}

		#login .container #login-column #login-box {
			margin-top: 120px;
			max-width: 600px;
			height: 320px;
			border: 1px solid #9C9C9C;
			background-color: #EAEAEA;
		}

		#login .container #login-column #login-box #login-form {
			padding: 20px;
		}

	</style>
</head>
<body>

<div class="container">
	<br>
	<br>
	<div class="row justify-content-center align-items-center">
		<div class="col-md-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Users Dashboard Login Form</h1>
				</div>

				<div class="panel-body" style="border: 1px ">
					<form id="login-form" action="<?php echo base_url('api/auth/login') ?>" method="POST">
						<div id="alert" style="display: none"></div>
						<div class="form-group">
							<label for="name">Email:</label>
							<input type="text" class="form-control" id="email" name="email"
								   placeholder="email@example.com"/>
						</div>

						<div class="form-group">
							<label for="password">Password: </label>
							<input type="text" class="form-control" id="password" name="password"
								   placeholder="password"/>
						</div>

						<button type="submit" class="btn btn-success">Submit</button>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	$("form").submit(function (e) {

		e.preventDefault();

		var form = $(this);
		var actionUrl = form.attr('action');

		$.ajax({
			url: actionUrl,
			method: 'POST',
			data: form.serialize(),
			dataType: "json",
			encode: true,
		})
			.done(function (data) {
				if (!data['success']) {
					$("#alert").html(
						'<div class="alert alert-danger">' + data.message + "</div>"
					).show();
				} else {
					form.html(
						'<div class="alert alert-success">' + data.message +
						'<p>Welcome, mr. <strong>' + data.data.name + '</strong></p></div>').show();

					form[0].reset()

					window.setTimeout(function(){

						// Move to a new location or you can do something else
						window.location.href = "<?php echo base_url('api/dashboard') ?>";

					}, 1500);
				}
			});
	});

</script>

</body>
</html>
