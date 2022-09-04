
<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Fortune Online - Casa de cambio digital</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />

    <meta name="msapplication-TileColor" content="#0061da">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

	<!-- Dashboard Css -->
	<link href="{{asset('assets/css/registro.css')}}" rel="stylesheet" />
	<!--Font Awesome-->
    <link href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/fontawesome-free/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext" rel="stylesheet">
	<!-- //web-fonts -->
</head>

<body>
	<div class="main-bg" style="background: url({{asset('assets/images/fondologin.jpg')}}) no-repeat center;">
		<!-- title -->
		<h1>&nbsp; </h1>
		<!-- //title -->
		<div class="sub-main-w3">
			<div class="image-style" style="background: url({{asset('assets/images/fortuneonline.png')}}) no-repeat center;">

            </div>

			<!-- vertical tabs -->
			<div class="vertical-tab">

                @yield('content')

            </div>

			<!-- //vertical tabs -->
			<div class="clear">

            </div>
		</div>
	</div>
</body>
</html>
