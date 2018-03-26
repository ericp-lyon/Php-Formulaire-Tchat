<!doctype html>
<html lang="fr">

<head>

<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Formation PHP</title>

<!-- Bootstrap core CSS -->

<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!-- <link  -->
<!-- href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"  -->
<!-- rel="stylesheet" type="text/css" id="bootstrap-css"> -->
<!-- <script  -->
<!-- src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css"  -->
<!-- href="/formation-php/web/assets/stylesheets/tchat.css" id="bootstrap-css"> -->
<!-- <script src="/formation-php/web/assets/javascripts/index.js"></script> -->

<link
	href="/formation-php/web/node_modules/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <!-- Custom fonts for this template --> -->
<link href="/formation-php/web/css/agency.min.css" rel="stylesheet"
	type="text/css">
<link
	href="/formation-php/web/node_modules/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700"
	rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700'
	rel='stylesheet' type='text/css'>

<!-- Custom styles for this template -->
<link href="css/agency.min.css" rel="stylesheet">

</head>

<body>
<header class="masthead">
	<div class="container">
		<div class="intro-text">
			<div class="intro-lead-in"><?= $titre?></div>
			<div class="intro-heading text-uppercase"><?= $titre2?></div>
			<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger"
				href="#services">Tell Me More</a>
		</div>
	</div>
</header>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" >Formation PHP</a>
		<button class="navbar-toggler navbar-toggler-right" type="button"
			data-toggle="collapse" data-target="#navbarResponsive"
			aria-controls="navbarResponsive" aria-expanded="false"
			aria-label="Toggle navigation">
			Menu <i class="fa fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
			
<?php if($_SESSION["user"]->role !== \App\Role\Role::VISITOR_VALUE):?>

				<li class="nav-item"><a class="nav-link js-scroll-trigger"
					href="/formation-php/web/">Home</a></li>
					
					<li class="nav-item"><a class="nav-link js-scroll-trigger"
					href="/formation-php/web/signout">Signout</a></li>
<?php endif;?>

<?php if($_SESSION["user"]->role === \App\Role\Role::VISITOR_VALUE):?>
					
				<li class="nav-item"><a class="nav-link js-scroll-trigger"
					href="/formation-php/web/signup">Signup</a></li>
					
				<li class="nav-item"><a class="nav-link js-scroll-trigger"
					href="/formation-php/web/signin">Signin</a></li>
<?php endif;?>	
				
				<li class="nav-item"><a class="nav-link js-scroll-trigger"
					href="/formation-php/web/channel">Channel</a></li>
			</ul>
		</div>
	</div>
</nav>