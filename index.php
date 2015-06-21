<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>scandata</title>

	<link href='http://fonts.googleapis.com/css?family=Fira+Sans:300,400' rel='stylesheet' type='text/css'>
	<style>
		/* CSS RESET */
		/* http://meyerweb.com/eric/tools/css/reset/ */
		a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,div,dl,dt,em,embed,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,output,p,pre,q,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video{margin:0;padding:0;border:0;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:after,blockquote:before,q:after,q:before{content:'';content:none}table{border-collapse:collapse;border-spacing:0}

		*, html, body {
			font-family: 		'Fira Sans', Helvetica, Arial, sans-serif;
			text-align:			center;
			color: 				rgb(70,70,70);
		}

		h1 {
			font-size: 		60px;
			font-weight:	400;
			margin-bottom:  5px;
		}
		h2 {
			font-size:		24px;
			font-weight:	400;
		}
		p {
			font-size: 		16px;
			font-weight: 	400;
			line-height: 	1.5em;
		}

		a, a:link, a:visited {
			color: 				black;
			text-decoration: 	none;
		}
		a:active, a:hover {
			color: 				black;
			text-decoration:  	none;
			border-bottom:		1px solid rgba(255,255,255,0);
		}

		header a, header a:link, header a:visited {
			color: 				rgb(70,70,70);
			border-bottom:		1px solid rgba(255,255,255,0);
		}
		header a:hover {
			color: 				black;
			border-bottom:		1px solid rgb(0,0,0);
		}

		footer a, footer a:link, footer a:visited {
			border-bottom:		1px solid black;
		}
		footer a:hover, footer a:active {
			border-bottom:		1px solid rgba(255,255,255,0);
		}

		#wrapper {
			width: 				100%;
			min-width: 			320px;
			background-color:   black;
		}

		header {
			width: 				100%;
			padding: 			20px 0 30px 0;
			background-color: 	white;
		}
		header h2 {
			margin:				0.3em 0 1em 0;
		}

		footer {
			width: 				100%;
			padding: 			40px 0 60px 0;
			background-color: 	white;
		}
		footer p {
			width: 				80%;
			margin: 			0 auto 1.5em auto;
			min-width: 			280px;
		}

		.ppm {
			width: 				25%;
			float: 				left;
			line-height: 		0;
			outline:				none;
			overflow: 			hidden;

			-moz-box-sizing:	border-box;
			-webkit-box-sizing:	border-box;
			box-sizing:			border-box;
		}
		.ppm:hover img {
			outline:			3px solid white;
			outline-offset: 	-3px;
		}
		.ppm img {
			width: 			100%;
			height: 		auto;
		}
		.grid:nth-child(4n+1) {
			clear: 			left;
		}

		.clear {
			clear: 			both;
		}

	</style>
</head>

<body>
	<div id="wrapper">
		<?php
			$images = glob('images/*.jpg');
			for ($i=0; $i<4; $i++) {
				$image = $images[$i];
				$path = substr( basename($image), 0, -6);
				echo '<div class="ppm">';
				echo '<a href="https://archive.org/details/' . $path . '" target="_blank">';
				echo '<img src="' . $image . '">';
				echo '</a>';
				echo '</div>' . PHP_EOL;
			}
		?>
		<div class="clear"></div>

		<header>
			<h1>scandata</h1>
			<h2><a href="http://www.jeffreythompson.org">JEFF THOMPSON</a></h2>
			<p>2015 + <a href="#info">info</a></p>
		</header>

		<div id="entries">
		<?php
			for ($i=4; $i<count($images); $i++) {
				$image = $images[$i];
				$path = substr( basename($image), 0, -6);
				echo '<div class="ppm grid">';
				echo '<a href="https://archive.org/details/' . $path . '" target="_blank">';
				echo '<img src="' . $image . '">';
				echo '</a>';
				echo '</div>' . PHP_EOL;
			}
		?>
		</div>

		<div class="clear"></div>
		<a name="info"></a>
		<footer>
			<p>These images were scraped from the <a href="https://archive.org">Internet Archive website</a>. Used for calibrating large book scanners, they automate the process of color correction and the removal of hot spots created by the scanner’s lights, and are meant to be read by the calibration software rather than humans.</p>

			<p>When present in an Internet Archive entry, the images are stored in an odd file format (.ppm) inside a zip archive called “scandata.zip,” from which the title for this collection comes. Using a script written in Python, URLs for Internet Archive entries containing these files were pulled from the Bing search engine API, their contents downloaded, and the images converted to JPGs. They are shown here with a link to the Internet Archive entry from which they came. This collection represents a small fraction of the thousands of such files on Internet Archive’s site.</p>

			<p>All images copyright their creators, everything else <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY-NC-SA</a>.

			<p><a href="http://www.jeffreythompson.org">jeffreythompson.org</a></p>
		</footer>

	</div> <!-- end wrapper -->
</body>
</html>

