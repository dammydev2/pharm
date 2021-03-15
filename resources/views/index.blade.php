
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
<title> Master login Form Responsive Widget Template  :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=" Master  Login Form Widget Tab Form,Login Forms,Sign up Forms,Registration Forms,News letter Forms,Elements"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Cormorant+SC:300,400,500,600,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

{{-- <script type="text/javascript">
	$(document).ready(function(){
     $("#frm1").submit();
});
</script> --}}
</head>

<body onload="document.frm1.submit()">
	<div class="padding-all">
		<div class="header">
			<h1><span style="color: rgba(200, 50, 50, 0.9);"><img src="images/fmc.jpeg" alt=""> PharmaSoft  Logi</span>n Form</h1>
		</div>

		<div class="design-w3l" style="background-color: rgba(200, 50, 50, 0.5);">
			<div class="mail-form-agile">
				<form method="post" action="{{ url('/login') }}" id="frm1">
					{{ csrf_field() }}
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
					<input type="text" name="email"  placeholder="User Name  or  email..." required=""/>
					<input type="password"  name="password" class="padding" placeholder="Password" required=""/>
					<input type="submit" style="background-color: rgba(200, 50, 50, 0.9);" value="login">
				</form>
			</div>
		  <div class="clear"> </div>
		</div>
		
		<div class="footer">
		<p>© {{ date('Y') }} . All Rights Reserved | </p>
		</div>
	</div>
</body>
</html>