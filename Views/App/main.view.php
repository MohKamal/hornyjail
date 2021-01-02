<!DOCTYPE html>
<html lang="en">
<head>
	<title>Horny Jail | OP</title>
	<meta charset="UTF-8">
	<meta name="description" content="Photographer html template">
	<meta name="keywords" content="photographer, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link href="@{{Assets}}images/favicon.ico" rel="shortcut icon"/>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
	<style>
		body{
			margin:0;
			padding:0;
		}
		/* .container{
			width:90%
			margin:10px auto;
		} */
		.portfolio-menu{
			text-align:center;
		}
		.portfolio-menu ul li{
			display:inline-block;
			margin:0;
			list-style:none;
			padding:10px 15px;
			cursor:pointer;
			-webkit-transition:all 05s ease;
			-moz-transition:all 05s ease;
			-ms-transition:all 05s ease;
			-o-transition:all 05s ease;
			transition:all .5s ease;
		}

		.portfolio-item{
			width:100%;
		}
		.portfolio-item .item{
			width:303px;
			float:left;
			margin-bottom:10px;
		}

		a,
      img {
        display: block;
      }

      img {
        border: 0;
        width: 220px;
        height: 280px;
      }

      img:not([src]) {
        visibility: hidden;
      }

      /* Fixes Firefox anomaly during image load */
      @-moz-document url-prefix() {
        img:-moz-loading {
          visibility: hidden;
        }
      }
	</style>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Image and text -->
	<nav class="navbar navbar-light bg-light fixed-top shadow-lg p-3 mb-5 bg-white rounded">
		<a class="navbar-brand" href="#">
			Horny Jail
		</a>
	</nav>
	@php
		for ($i = 1; $i <= 10; $i++){
	@endphp
	<a class="navbar-brand" href="#">@php echo $i @endphp</a>
	@php
		}
	@endphp

	<div class="container" style="padding-top: 20px;">
			<!--======
			<div class="portfolio-menu mt-2 mb-4">
				<ul>
					<li class="btn btn-outline-dark active" data-filter="*">All</li>
					<li class="btn btn-outline-dark" data-filter=".gts">Girls T-shirt</li>
					<li class="btn btn-outline-dark" data-filter=".lap">Laptops</li>
					<li class="btn btn-outline-dark text" data-filter=".selfie">selfie</li>
				</ul>
			</div>
			======-->
			<div class="row">
				<div class="portfolio-item row" id="display">
				</div>
			</div>
	</div>
	<nav class="navbar navbar-light bg-light fixed-bottom d-flex justify-content-center shadow-lg p-3 mb-5 bg-white rounded">
		<button id="loadmore" type="button" class="btn btn-danger btn-lg mr-2 mb-2">NEED MORE OP !!!</button>
		<button id="somethingelse" type="button" class="btn btn-warning btn-lg">NEED SOMETHING ELSE OP !!!</button>
	</nav>

	<!--====== Javascripts & Jquery ======-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
    <script src="@{{Scripts}}/lazyload.min.js"></script>
	<script type = "text/javascript" language="javascript"> 
		var pageCount = 1;
		var lazyLoadInstance = null;
		$(document).ready(function () {
			lazyLoadInstance = new LazyLoad({
			});
			loadMore();
			$("#loadmore").on('click', function(){
				loadMore();
			});

			$("#somethingelse").on('click', function(){
				window.location.replace("/s");
			});

		});

		function loadMore(){
			$.get("/pictures?page=" + pageCount, function(pics, status){
				$.each(pics, function(k, v) {
					if(checkURL(v.url)){
						if(urlExist(v.url)){
							var picture = `
									<div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
									<a href="` + v.url + `" class="fancylight popup-btn" data-fancybox-group="light">
									<img class="img-fluid" data-src="` + v.url + `" src="` + v.url + `" alt="` + v.name + `">
									</a>
									</div>`;
							$('#display').append(picture); 

							var popup_btn = $('.popup-btn');
								popup_btn.magnificPopup({
									type : 'image',
									gallery : {
										enabled : true
								}
							});
						}
					}
				});
			});

			lazyLoadInstance.update();
			pageCount++;
		}

		function urlExist(url){
			var request = new XMLHttpRequest();  
			request.open('GET', url, true);
			request.onreadystatechange = function(){
				if (request.readyState === 4){
					if (request.status === 404) {  
						return false;
					}  
				}
			};
			return true;
		}

		function checkURL(url) {
			return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
		}

		$('.portfolio-item').isotope({
		 	itemSelector: '.item',
		 	layoutMode: 'fitRows'
		});
		$('.portfolio-menu ul li').click(function(){
			$('.portfolio-menu ul li').removeClass('active');
			$(this).addClass('active');

			var selector = $(this).attr('data-filter');
			$('.portfolio-item').isotope({
				filter:selector
			});
			return  false;
		});
	</script>
	</body>
</html>
