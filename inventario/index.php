<?php session_start(); ?>
<?php include('model/db.php'); ?>
<?php include('controller/usuario.php'); 

	$user = new Usuario($db);

?>
<?php 
	
	if(isset($_POST['login'])){

		$usuario = $_POST['usuario'];
		$contrasena = $_POST['contrasena'];

		$row_user = $user->login($usuario,$contrasena);
		
		$_SESSION['nombre']=$row_user['nombre'];

		if($row_user['estado']=='A' && $row_user['privilegio']=='A'){

			header("Location:view/main_admin.php");

		}else if ($row_user['estado']=='A' && $row_user['privilegio']=='U') {
			
			header("Location:view/main_user.php");
		}

		
	}



 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Index | Inventario STM</title>
	<meta charset="utf-8">
	<link rel="icon" type="img/ico" href="resource/img/logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<style type="text/css">*{font-family: Lato;}</style>
</head>
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	  <a class="navbar-brand" href="#"><img src="resource/img/logo.png" width="32"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#" style="font-family: Pacifico;">STM Technology - SI<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0" method="POST">
	      <input class="form-control mr-sm-2" type="text" name="usuario" placeholder="Usuario..." aria-label="usuario" autocomplete="off" required="required">
	      <input class="form-control mr-sm-2" type="password" name="contrasena" placeholder="Contraseña..." aria-label="Contraseña" autocomplete="off" required="required">
	      <button class="btn btn-warning my-2 my-sm-0" type="submit"  name="login" style="color: white;"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp; Ingresar</button>
	    </form>
	  </div>
	</nav>
</header>
<body>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="resource/img/inventario-3.jpg" alt="First slide" height="600">
	      <div class="carousel-caption d-none d-md-block" style="top:170px;color: #DF7401;">
		    <h3 style="font-size: 78px;font-family: Pacifico;">Sistema de inventariado</h3>
		    <p style="font-size: 36px;font-family: Pacifico;">V 1.0</p>
		  </div>	
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="resource/img/inventario-4.jpg" alt="Second slide" height="600">
	      <div class="carousel-caption d-none d-md-block" style="top:170px;color: #DF7401;">
		    <h3 style="font-size: 78px;font-family: Pacifico;">Empezando la nueva era tecnológica.</h3>
		    <p style="font-size: 36px;font-family: Pacifico;"></p>
		  </div>
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</body>
<footer>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-bottom">
	<p style="color: white;width: 100%;text-align: center;padding-top: 20px;">&copy; Todos los derechos reservados. Desarrollado por Area de Tecnologias STM.</p>
	</nav>
</footer>
</html>