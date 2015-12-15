
<?php
	include_once("database.php");
	include_once("facadeImmobili.php");
	include_once("immobile.php");
	include_once("utente.php");
	$descrizione="";
	$tipoContratto="";
	//$proprietario="";
	define("UPLOAD_DIR","./immobili/");
	$prezzo=0;
	$metratura=0;
	$tipo="";
	$immagine="";
	session_start();
	if($_POST['descrizione']==""||$_POST['contratto']== ""||$_POST['prezzo']==""||$_POST['metratura']==""||$_POST['tipo']==""||$_POST['comune']== "")
				echo "<script type='text/javascript'>alert('Errore nella compilazione');window.location.replace('../indexCliente.php');</script>" ;
    else{
		if(isset($_POST['descrizione']))
			$descrizione=$_POST['descrizione'];
		
		if(isset($_POST['contratto']))
			$tipoContratto=$_POST['contratto'];
		
		if(isset($_SESSION['cod']))
			$proprietario=$_SESSION['cod'];
		
		if(isset($_POST['prezzo']))
			$prezzo=doubleval($_POST['prezzo']);
		
		if(isset($_POST['metratura']))
			$metratura=doubleval($_POST['metratura']);
		
		
		if(isset($_POST['tipo']))
			$tipo=$_POST['tipo'];
		
		if(isset($_POST['comune']))
			$comune=$_POST['comune'];
		
		if(isset($_FILES['immagine'])){
		
			$immagine=$_FILES['immagine'];
		
		move_uploaded_file($immagine['tmp_name'],UPLOAD_DIR.$immagine['name']);
		
		}
	
	$f=new FacadeGestioneImmobili();
//print_r($_FILES['immagine']);	
	$f->creaImmobile( 0, $tipoContratto, $descrizione, $proprietario, "immobili/".$immagine['name'], $metratura, $prezzo, $tipo,$comune);
	echo "<script type='text/javascript'>alert('Immobile inviato per l\'approvazione');window.location.replace('../indexCliente.php');</script>" ;
}
	//header("location:../indexCliente.php");
	
	
?>
