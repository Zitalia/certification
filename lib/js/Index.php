<!DOCTYPE html>
<html style="height:100%;">
<head>
	<meta charset="utf-8">
	<title>Je m'ennuie.fr</title>
	<script type="text/javascript" src="lib/js/bootstrap.js"></script>
	<script type="text/javascript" src="lib/js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="lib/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="lib/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="lib/js/jquery.js"></script>
	<link rel="stylesheet" href="lib/css/bootstrap.css">

</head>
<body class="bg-dark text-white text-center ">


	<div  class="font-weight-bold" style="min-height:100vh; width:100%;">
		<div style=" margin-top:20vh;">
			<h3 style="margin-bottom:3vh;"> Bienvenue <br />
				Jeune crocodingo <br />
				<span class="text-danger">tu t'ennuie ? </span><br />
				 allez rejoins nous !
			</h3>
			<div>
				<form method="POST" action="Queryconnexion.php">
					<ul class="list-group"><li><label for="invitpseudo" class="font-weight-light">Votre Pseudo :</label></li>
				  		<li><input id="invitpseudo" type="text" name="invitpseudo" placeholder="Entrez un pseudo"></li>
				  		<li><label for="invitage" class="font-weight-light">   Votre age :</label></li>
				  		<li><input  id="invitage" type="number" name="invitage" placeholder="Age" style="width:5%;"></li>
				  		<li><legend >Sexe :</legend>
				    		<input type="radio" name="gender" id="male"> <label for="male">♂</label>
				    		<input type="radio" name="gender" id="female"> <label for="female">♀</label>
				    		<input type="radio" name="gender" id="crocodingo"> <label for="crocodingo">♂♀</label></li>
				    	<li><button type="submit" class="btn btn-primary">Submit</button></li>
			    	</ul>
				</form>
			</div>
		</div>
	
		<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" style="position:absolute 0,0;">
  Identifiez vous ! 
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zone V.I.P.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   		<h4>Si vous faites déja partie de l'aventure, identifiez vous, ou créez un compte !</h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
        <button type="button" class="btn btn-primary">Appliquez</button>
      </div>
    </div>
  </div>
</div>

	</div>
</body>
</html>