<!doctype html>
<html lang="en">

<head>
    @include('backend.section.link')

	<title> Edupress- Admin Dashboard </title>

	<style>
		html{
			visibility: hidden;
			opacity: 0;
			transition: opacity 0.3s ease-in-out;
		}
	</style>
	
	<script>
		(function(){
			if(localStorage.getItem("theme") === "dark"){
				document.documentElement.classList.add("dark-theme");
				// document.querySelector("html").style.visibility = "visible";
				// document.querySelector("html").style.opacity = "1";
			} else {
				document.documentElement.style.visibility = "visible";
				document.documentElement.style.opacity = "1";
				// document.querySelector("html").style.visibility = "visible";
				// document.querySelector("html").style.opacity = "1";
			}
			document.documentElement.style.visibility = "visible";
			document.documentElement.style.opacity = "1";
		})();
	</script>
	
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('backend.section.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
		@include('backend.section.header')
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
            @yield('content')
		</div>
		<!--end page wrapper -->
        
		@include('backend.section.footer')

	</div>
	<!--end wrapper-->


	


	@include('backend.section.scrip')
</body>

</html>