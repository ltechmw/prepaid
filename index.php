<!DOCTYPE html>
<html lang="en">

<head>
	<link href="./assests/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="./assests/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<link href="./assests/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<script src="./assests/js/jquery-3.6.0.min.js"></script>
	<script src="./assests/js/jquery.dataTables.min.js"></script>
	<script src="./assests/js/bootstrap.min.js"></script>
	<script src="./assests/js/dataTables.bootstrap5.min.js"></script>
	<script src="./assests/js/bootstrap-datepicker.min.js"></script>
	<style>
		#hide {
			display: none;
		}
	</style>
</head>

<body>
	<div class="row m-3">

		<h3 class="text-primary font-weight-bold">Find your Prepaid Tokens</h3>
		<form role="form" id="tokenForm">
			<div class="row">
				<div class="col-lg-2 col-xl-2 col-md-4 col-sm-12 col-xs-12  mb-2">
					<label for="inputmeterNo" class="col-form-label mx-1">Meter</label>
					<div class="input-group date mx-1">
						<input type="number" class="form-control" id="inputmeterNo" name="meterNo" placeholder="Meter Number" required>
					</div>
				</div>
				<div class="col-lg-2 col-xl-2 col-md-4 col-sm-12 col-xs-12  mb-2">
					<label class="col-form-label mx-1">From</label>
					<div id="from" class="input-group date mx-1" data-date-format="dd-mm-yyyy">
						<input class="form-control" name="from" type="text" required />
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>
				</div>
				<div class="col-lg-2 col-xl-2 col-md-4 col-sm-12 col-xs-12 mb-4">
					<label class="col-form-label mx-1">To</label>
					<div id="to" class="input-group date mx-1" data-date-format="dd-mm-yyyy">
						<input class="form-control" name="to" type="text" required />
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					</div>

				</div>
				<div class="row ">
					<div class="col-12 mx-1">
						<input type="button" value="Retrieve Token(s)" id="submit" name="submit" class="btn btn-primary" />
					</div>
				</div>

			</div>
		</form>
		<div class="row">
			<div class="mt-1 pt-4 mx-1 mb-5" id="result"></div>
		</div>
	</div>

	<script>
		$(function() {
			$("#from").datepicker({
				autoclose: true,
				todayHighlight: true
			}).datepicker('update', new Date());

			$("#to").datepicker({
				autoclose: true,
				todayHighlight: true
			}).datepicker('update', new Date());
		});

		$("#submit").click(function() {
			$('#result').html('loading...');
			$.post('TokenRetriever.php', $('#tokenForm').serialize(),
				function(data, status) {
					$('#result').html(data);
					$('#table').DataTable({
						order: [
							[5, 'desc']
						]
					});
					$('.dataTables_length').addClass('bs-select');
				})
		});
	</script>
</body>

</html>