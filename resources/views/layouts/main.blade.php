<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>RO Status Checker</title>

		<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"/>
		<script>
			window.Laravel =  <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?>
		</script>
	</head>
	<body>
		<div id="app">
			<div class="flex-center position-ref full-height">

				<div class="content">
					<div class="title m-b-md">
						RO Status Checker
					</div>

					@yield( 'content' )
					
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	</body>
</html>
