<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: grey;
				display: table;
				font-weight: bold;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 52px;
				margin-bottom: 40px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Whoops :( &nbsp; <br/>Page Not Found.</div>
				<div><a href="{{ base_url() }}" class="">Back to Home</a></div>
			</div>
		</div>
	</body>
</html>
