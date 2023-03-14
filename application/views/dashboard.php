<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SAKAN - ASSIGNMENT</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

	<style type="text/css">

		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding: 0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>
<body>

<div id="container">

	<h1>Dashboard
		<span style="float: right; font-size: 15px">
			<a href="
			<?php echo(key_exists('logged_in', $_SESSION) && $_SESSION['logged_in'] ? '#' : base_url('api/auth/login')) ?>">
				<?php echo(key_exists('logged_in', $_SESSION) && $_SESSION['logged_in'] ? 'Logout' : 'Login') ?>
			</a>
		</span>
	</h1>

	<div id="body">
		<div class="row justify-content-center align-items-center">
			<div class="col-md-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">

						<form id="filter-form" action="<?php echo base_url('api/dashboard/filter') ?>" method="POST">
							<div class="row">
								<div class="form-group col-md-5">
									<label for="date_from">Date from:</label>
									<input required type="date" class="form-control" id="date_from" name="date_from"/>
								</div>

								<div class="form-group col-md-5">
									<label for="date_to">Date to:</label>
									<input required type="date" class="form-control" id="date_to" name="date_to"/>
								</div>

								<div class="form-group col-md-1">
									<label for="date_to">Filter:</label>
									<button type="submit" class="btn btn-success">Submit</button>
								</div>

							</div>
						</form>

					</div>

					<div class="panel-body" style="border: 1px ">
						<table class="table table-striped table-bordered">
							<thead>
							<tr>
								<td>Hour</td>
								<td>Count</td>
								<td>Users</td>
							</tr>
							</thead>
							<tbody id="peak_hours">

							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong>
		seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
	</p>
</div>


<script>
	$("form").submit(function (e) {

		e.preventDefault();

		var form = $(this);
		var actionUrl = form.attr('action');

		$('table tbody').html('');

		var date_from = $('form input[name="date_from"]').val();
		var date_to = $('form input[name="date_to"]').val();

		if (date_from > date_to){
			alert('Date from must be less than Date to!');
			return false;
		}


		$.ajax({
			url: actionUrl,
			method: 'POST',
			data: form.serialize(),
			dataType: "json",
			encode: true,
		})
			.done(function (data) {
				for (i = 0; i < data.length; i++) {
					$('#peak_hours').append(`
						<tr>
							<td>`+ data[i]['peak_hours'] +`</td>
							<td>`+ data[i]['count'] +`</td>
							<td>
								<a href="<?php echo base_url('api/dashboard/users?peak_date=') ?>` + data[i]['peak_hours'] + `"> Show list</a>
						</td></tr>
					`);
				}
			});
	});

</script>

</body>
</html>


