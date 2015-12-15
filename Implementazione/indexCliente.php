<head>
</head>
<body>
<?php
//pagina iniziale cliente
	include_once("subsystem/database.php");
	include_once("subsystem/facadeImmobili.php");
	include_once("subsystem/facadeTrattative.php");
	include_once("subsystem/facadeAccount.php");
	include_once("subsystem/funzioni.php");
	
	
	
	if(isset($_GET['trattative'])){
		mostraTrattative();
  
  }
else if(isset($_GET['barra'])){
		if($_GET['barra']=='vendi')
			  formVenditaImmobile();
			//pagina vendita immobile
	}
	
	else if(isset($_GET['barra'])){
		if($_GET['barra']=='contatti')
			echo "Codice da compilare";
			
			//pagina chi siamo in costruzione
	}
	 
	   
	
else if(isset($_GET['id'])){
	$id=$_GET['id'];
	mostraImmobile($id);
	}

//crea una trattativa
else if(isset($_GET['offerta'])){
	$f=new FacadeGestioneTrattative();
	if(isset($_GET['immobile'])){
		$acq=$_SESSION['cod'];
		$imm=$_GET['immobile'];
		$f->creaTrattativa($acq, "null", $imm, 0);
		echo "<script type='text/javascript'>alert('Trattativa aperta');window.location.replace('indexCliente.php');</script>" ;
		//header("location:indexCliente.php");
	}
	
}

else if(isset($_GET['logout'])){
	logout();
}

else{
  
  mostraCatalogo();
  
  
  }

  

?>
</body>