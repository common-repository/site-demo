<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo get_bloginfo('name') ?></title>

	<style>
		/*  reset https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css */
		html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}

		body, html {
			font-size: 20px;
			height: 100%;
		}

		body {
			background: #999;
			display: flex;
			flex-direction: column;
		}

		#browser {
			background: #DDD;
			box-shadow: 0.3rem 0.3rem 0.6rem 0.3rem #777;
			border-top-left-radius: 1rem;
			border-top-right-radius: 1rem;
			display: flex;
			flex-direction: column;
			flex-grow: 1;
			margin: 2rem;
		}

		#header {
			display: flex;
			flex-direction: column;
			padding: 1rem;
		}

		#header-circles {
			margin-bottom: 0.618rem;
		}

		#header-circles div {
			border-radius: 50%;
			display: inline-block;
			height: 1rem;
			margin-right: 0.382rem;
			width: 1rem;
		}

		#header-input {
			align-items: center;
			background: white;
			border-radius: 0.236rem;
			display: flex;
			padding: 0.382rem;
		}

		#header-input input {
			background: none;
			border: 0;
			font-size: 1rem;
			flex-grow: 1;
			padding-left: .382rem;
		}

		#header-input input:focus {
			outline: none;
		}

		iframe {
			border: 1px solid #CCC;
			flex-grow: 1;
		}
	</style>
</head>
<body>
<div id="browser">
	<header id="header">
		<div id="header-circles">
			<div style="background: Tomato;"></div>
			<div style="background: orange;"></div>
			<div style="background: MediumSeaGreen;"></div>
		</div>
		<div id="header-input">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
				<path
						d="M18 10V6A6 6 0 006 6v4H3v14h18V10h-3zM8 10V6c0-2.206 1.794-4 4-4s4 1.794 4 4v4H8z"/>
			</svg>
			<input id="url" type="text" value="<?php echo esc_attr( get_query_var( 'sitedemo_url' ) ) ?>">
		</div>
	</header>
	<iframe id="iframe" src="<?php echo esc_attr( get_query_var( 'sitedemo_url' ) ) ?>"></iframe>
</div>
<?php include 'partials/menu.php' ?>

<script>
	const url = document.getElementById('url');
	const iframe = document.getElementById('iframe');

	function maybeUpdateUrl () {
		const option = document.getElementById('option-sync-url');

		if (!option.checked) {
			return false;
		}

		const currentUrl = iframe.contentWindow.location.href;
		url.value = currentUrl;
	}

	iframe.onload = function () {
		maybeUpdateUrl();
	};
</script>
</body>
</html>
