<?php
session_start();
	include_once("facadeAccount.php");
	//Esegue l'autenticazione di un utente nel sistema passando al database username e password e verificando se esiste un occorrenza,
	//poi in base al tipo di utente reindirizza alla giusta pagina web
	
	$facade=new FacadeGestioneAccount();
	$user=$_POST['username'];
	$pss=$_POST['password'];
	
	$utente=$facade->login($user,$pss);
	if($utente!=null){
		if($utente->getTipo()=='cliente'){
			header("location: ../indexCliente.php");
		}
		if($utente->getTipo()=='agente'){
			header("location: ../indexAgente.php");
		}
		else if($utente->getTipo()=='amministratore'){
			header("location: ../indexAmministratore.php");
		}
		$_SESSION['cod']=$utente->getCodice();
		$_SESSION['username']=$utente->getUsername();
		$_SESSION['tipo']=$utente->getTipo();
	
	}
	//Messaggio di Errore
	else  
		echo "<script type='text/javascript'>alert('Autenticazione Fallita [Username o Password errati]');window.location.replace('../index.php');</script>";
		
?>