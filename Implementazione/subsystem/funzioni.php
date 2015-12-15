<?php
header('Content-type: text/html;charset=utf-8');
session_start();
	include_once("database.php");
	include_once("facadeImmobili.php");
	include_once("facadeTrattative.php");
	include_once("facadeAccount.php");
	include_once("immobile.php");
	include_once("utente.php");
	
	
	function mostraClienti(){
		$f=new FacadeGestioneAccount();
		$stringa="";
		$clienti=array();
		if($_SESSION['tipo']=='agente'){
			$view = file_get_contents('indexAgente.html');
			$clienti=$f->getUtenti();
			$stringa="<form method='GET' action='indexAgente.php'>";
			}
		else{
			$view = file_get_contents('indexAmministratore.html');
			$clienti=$f->getAgenti();
			$stringa="<form method='GET' action='indexAmministratore.php'>";
		}
		
		if($clienti!=null){
			
			foreach($clienti as $value){
				$id=$value->getCodice();
				$stringa=$stringa."<div>Nome: ".$value->getNome()."<br>CF: ".$value->getCodice()."<br><button type='submit' name='cf'value='$id'>Visualizza</button></div>"."<br><br>";
			}
		}
		
		$stringa=$stringa."</div></form>";
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	
	}
	
	function assegnaAgenti(){
		$f=new FacadeGestioneAccount();
		$stringa="Scegli un Agente:<br><br>";
		$agenti=array();
		$view = file_get_contents('indexAmministratore.html');
		$agenti=$f->getAgenti();
		if(isset($_GET['immobile']))
			$id=$_GET['immobile'];
		else $id=$_GET['trattativa'];
		if($agenti!=null){
			foreach($agenti as $value){
				$cf=$value->getCodice();
			
			if(isset($_GET['immobile']))
				$stringa=$stringa."<form method='GET' action='indexAmministratore.php'><div>Nome: ".$value->getNome()."<br>CF: ".$value->getCodice()."<br><button type='submit' name='action'value='assegnaImmobile'>Assegna</button><input type='hidden' name='agente' value='$cf'><input type='hidden' name='oggetto' value='$id'></div></form>"."<br><br>";
			else 
				$stringa=$stringa."<form method='GET' action='indexAmministratore.php'><div>Nome: ".$value->getNome()."<br>CF: ".$value->getCodice()."<br><button type='submit' name='action'value='assegnaTrattativa'>Assegna</button><input type='hidden' name='agente' value='$cf'><input type='hidden' name='oggetto' value='$id'></div></form>"."<br><br>";
			
			}
		}
	//	$stringa=$stringa."</div></form>";
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	}
	
	function mostraTrattative(){
		$ft=new FacadeGestioneTrattative();
		$view="";
		
		
		$trattative=$ft->getTrattative();
		$stringa="<form method='GET' ><div>";
		
	
	if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='cliente'){
				$view = file_get_contents('indexCliente.html');
				foreach($trattative as $value){
					if($value->getAcquirente()==$_SESSION['cod']){
						$immobile=$value->getImmobile();
						if($value->getApprovata()==0) $stato="In attesa";
						else $stato="Approvata.Verrai ricontattato da un agente entro 48ore";
						$stringa=$stringa."<div>Codice: ".$value->getId()."<br>Data Creazione: ".$value->getData()."<br>"."Immobile: <button type='submit' value='$immobile' name='id'>Dettagli</button><br>Stato: $stato</div><br><br>";
																}
											}
				
				}
			else if($_SESSION['tipo']=='agente'){
				$fa=new FacadeGestioneAccount();
				$fi=new FacadeGestioneImmobili();
				$view = file_get_contents('indexAgente.html');
				foreach($trattative as $value){
					if($value->getAgente()==$_SESSION['cod']){
						$immobile=$value->getImmobile();
						$id=$value->getId();
						if($value->getApprovata()==0) $stato="In attesa";
						else $stato="Approvata";
						$cf=$value->getAcquirente();
						$acquirente=$fa->visualizzaCliente($cf);
						$nome=$acquirente->getNome();
						$cf2=$fi->visualizzaImmobile($immobile)->getProprietario();
						$proprietario=$fa->visualizzaCliente($cf2)->getNome();
						$stringa=$stringa."<div>Codice: ".$value->getId()."<br>Data Creazione: ".$value->getData()."<br>"."Acquirente: <a href='indexAgente.php?cf=$cf'>$nome</a>"."<br>Immobile: <button type='submit' value='$immobile' name='id'>Dettagli</button><br>"."Proprietario: <a href='indexAgente.php?cf=$cf2'>$proprietario</a>"."<br>Stato: $stato</div><br>";
						if($value->getApprovata()==0)
							$stringa=$stringa."<button name='approva' value='$id'>Approva</button><button name='eliminaTrattativa' value='$id'>Elimina</button><br><br>";
						else 	$stringa=$stringa."<button name='eliminaTrattativa' value='$id'>Elimina</button><br><br>";
					}
				}
			}
			
			else{
				$view = file_get_contents('indexAmministratore.html');
				foreach($trattative as $value){
					if($value->getAgente()==null||$value->getApprovata()==0){
						$immobile=$value->getImmobile();
						$id=$value->getId();
						if($value->getAgente()==null)
							$stringa=$stringa."<form method='GET' action ='indexAmministratore.php'><div>Codice: ".$value->getId()."<br>Data Creazione: ".$value->getData()."<br>"."Immobile: <button type='submit' value='$immobile' name='id'>Dettagli</button><br><button type='submit' name='action' value='assegna'>Assegna</button><input type='hidden' name='trattativa' value='$id'/></div><br><br></form></form>";
						else
							$stringa=$stringa."<form method='GET' action ='indexAmministratore.php'><div>Codice: ".$value->getId()."<br>Data Creazione: ".$value->getData()."<br>"."Immobile: <button type='submit' value='$immobile' name='id'>Dettagli</button><br><button type='submit' name='action' value='assegna'>Riassegna</button><input type='hidden' name='trattativa' value='$id'/></div><br><br></form></form>";
						
						}
											}
				
				
				}
		
		}
	
	$stringa=$stringa."</div></form>";
	$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
	echo $view_xhtml_valorizzata;
	}
	
	function mostraCatalogo(){
	$f=new FacadeGestioneImmobili();
		$view="";
		$stringa="";
		$immobili=$f->getImmobili();
		
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='cliente'){
				$view = file_get_contents('indexCliente.html');
				$stringa="<form method='GET' action='indexCliente.php' ><div id='catalogo' >";
				foreach($immobili as $value){
					if($value->getApprovato()!=0&&$value->getProprietario()!=$_SESSION['cod']){
						$temp=$value->getId();
						$metratura=$value->getMetratura();
						$contratto=$value->getContratto();
						$immagine=$value->getImmagine();
						$stringa=$stringa."<div id=$temp name='immobile'><img src=$immagine class='image'></img><br><br>Metratura: $metratura <br>Contratto:".$contratto."<br><button type='submit' name=id value=$temp >Visualizza</button>"."</div>"."<br>";
			}
	}
				}
				
			else if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
				$stringa="<form method='GET' action='indexAgente.php' ><div id='catalogo' >";
				foreach($immobili as $value){
					if($value->getAgente()==$_SESSION['cod']){
						$temp=$value->getId();
						$metratura=$value->getMetratura();
						$contratto=$value->getContratto();
						$immagine=$value->getImmagine();
						$stringa=$stringa."<div id=$temp name='immobile'><img src=$immagine class='image'></img><br>Metratura: $metratura <br>Contratto:".$contratto."<br><button type='submit' name=id value=$temp >Visualizza</button>"."</div>"."<br>";
					}
				}
				
			}
			else if($_SESSION['tipo']=='amministratore'){
				$view = file_get_contents('indexAmministratore.html');
				$stringa="<form method='GET' action='indexAmministratore.php' ><div id='catalogo' >";
				foreach($immobili as $value){
					
						$temp=$value->getId();
						$metratura=$value->getMetratura();
						$contratto=$value->getContratto();
						$immagine=$value->getImmagine();
						$stringa=$stringa."<div id=$temp name='immobile'><img src=$immagine class='image'></img><br>Metratura: $metratura <br>Contratto:".$contratto."<br><button type='submit' name=id value=$temp >Visualizza</button>"."</div>"."<br>";
					
				}
				
			}
			
			else{
				$view = file_get_contents('indexAmministratore.html');
				$stringa="<form method='GET' action='indexAmministratore.php' ><div id='catalogo' >";
				foreach($immobili as $value){
					if($value->getApprovato()==0&&$value->getAgente()==null){
					$temp=$value->getId();
					$metratura=$value->getMetratura();
					$contratto=$value->getContratto();
					$immagine=$value->getImmagine();
					$stringa=$stringa."<div id=$temp name='immobile'><img src=$immagine class='image'></img><br>Metratura: $metratura <br>Contratto:".$contratto."<br><button type='submit' name=id value=$temp >Visualizza</button>"."</div>"."<br>";
						
					}
				}
		}
		
	}
	
	$stringa=$stringa."</div></form>";
	  $view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
  echo $view_xhtml_valorizzata;
	}

	
	function mostraImmobile($id){
		$f=new FacadeGestioneImmobili();
		$f2=new FacadeGestioneAccount();
		$immobile=$f->visualizzaImmobile($id);
		$stringa="";
		if($immobile==null){
			return null;
		}
		$id=$immobile->getId();
		$descrizione=$immobile->getDescrizione();
		$prezzo=$immobile->getPrezzo();
		$comune=$immobile->getComune();
		$cod=$immobile->getProprietario();
		$tipo=$immobile->getTipo();
		$proprietario=$f2->visualizzaCliente($immobile->getProprietario())->getNome();
		$i=$immobile->getImmagine();
		$stringa="<form method='GET' ><div><img src= '$i' class='image' /></div><div class='info'><br>
		Comune: $comune<br>Descrizione: $descrizione<br>Prezzo: $prezzo € <input type='hidden' name='immobile' value='$id'><br>Tipo: $tipo</div>";//il campo hidden serve per inviare l'id dell'immobile
		
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='cliente'){
				$view = file_get_contents('indexCliente.html');
				$cod=$_SESSION['cod'];
				
				//controllo se il cliente ha già aperto una trattativa su questo immobile
				$db=new Database();
				$query="SELECT * FROM  trattativa as t,immobile as i WHERE ( t.immobile='$id' and i.id='$id' ) and( t.acquirente='$cod' or i.proprietario='$cod')";
				//return $query;
				$db->query($query);
				$res=$db->result;
				$row=mysql_fetch_array($res);
				if($row==null)	
					$stringa=$stringa."<button type='submit' value='offri' name='offerta'>Sono Interessato</button>";
				
				}
			else if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
				if($immobile->getApprovato()==0)
					$stringa=$stringa."Proprietario:<a href='indexAgente.php?cf=$cod'>$proprietario</a> <br><button type='submit' value='eliminaImmobile' name='action'>Elimina</button><button type='submit' value='approva' name='action'>Approva</button>";
				else $stringa=$stringa."Proprietario: <a href='indexAgente.php?cf=$cod'>$proprietario</a><br><button type='submit' value='eliminaImmobile' name='action'>Elimina</button><button type='submit' value='modificaImmobile' name='action'>Modifica</button>";
			}
			else{
				$view = file_get_contents('indexAmministratore.html');
				if($immobile->getAgente()==null)
					$stringa=$stringa."Proprietario:<a>$proprietario</a><br><button type='submit' value='assegna' name='action'>Assegna</button>";

				}
		}
		$stringa=$stringa."</form>";
		  $view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		  echo $view_xhtml_valorizzata;
		
	}
	
	
	//crea form per inserimento immobili
	function formVenditaImmobile(){
		$f=new FacadeGestioneImmobili();
		$view="";
		$stringa="";
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='cliente')
				$view = file_get_contents('indexCliente.html');
			else if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
			}
			else{$view = file_get_contents('indexAmministratore.html');}
		}
		
		$stringa=$stringa."<form method='POST' action='subsystem/controlInserimentoImmobile.php' enctype='multipart/form-data'>Descrizione: <br><textarea name='descrizione' rows='15' cols='50'>Inserisci Descrizione</textarea><br><br>Comune: <input type='text' name='comune'><br><br>Metratura: <input type='number' name='metratura'/><br><br>Prezzo:<input type='number' name='prezzo'/><br>
		<br>Contratto: <select  name='contratto'><option value='vendita'>Vendita</option><option value='affitto'>Affitto</option></select><br><br>Tipo: <input type='text' name='tipo'/><br><br>Immagine:   <input type='file' name='immagine'/><input type='hidden' name='MAX_FILE_SIZE' value='300000'/><br><br><input type='submit'/></form>";
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	
	
	}
	
	//crea form  per informazioni
		 /* function formChiSiamo(){
		  echo ( Siamo un agenzia Immobiliare situata a Fisciano che si occupa di compra vendita di immobili dal 1985.)


<img style="margin-left:100px; margin-top:20px" src=img/agenti.jpg class='image' >
</div></div>

		 */

	
	function logout(){
		session_destroy();
		header("location:index.php");
	
	}

	function formRegistrazioneCliente(){
		$f=new FacadeGestioneAccount();
		$view="";
		$stringa="";
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
				$stringa="<form method='GET' action='indexAgente.php'>";
			}		
			else if($_SESSION['tipo']=='amministratore'){
				$view = file_get_contents('indexAmministratore.html');
				$stringa="<form method='GET' action='indexAmministratore.php'>";
			}
		}
		$stringa=$stringa."Codice Fiscale: <input type='text' name='codiceFiscale'/><br><br>Nome e Cognome: <input type='text' name='nome'/><br><br>
		Data Nascita: <input type='date' name='data'/><br><br>Email: <input type='email' name='email'><br><br>Telefono: <input type='number' name='telefono'/><br><br>Username: <input type='text' name='username'/><br><br>Password: <input type='password' name='password'><br><br><button type='submit' name='action' value='Registra'>Registra</button>";
	
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	}
	
	function mostraUtente($cod){
		
		$f=new FacadeGestioneAccount();
		$view="";
		$stringa="";
		$utente=$f->visualizzaCliente($cod);
		$stringa="";
		
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='cliente')
				$view = file_get_contents('indexCliente.html');
			else if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
				$stringa=$stringa."<form method='GET' action='indexAgente.php'><div>";
			}
			else{
				$view = file_get_contents('indexAmministratore.html');
				$stringa=$stringa."<form method='GET' action='indexAmministratore.php'><div>";

			}
		}
		
		$stringa=$stringa."Nome: ".$utente->getNome()."<br>Data di Nascita: ".$utente->getDataNascita()."<br>Email: ".$utente->getEmail()."<br>Tel: ".$utente->getTelefono()."<br>Username: ".$utente->getUsername();
		$stringa=$stringa."<br><br><button type='submit' name='action' value='modifica'>Modifica</button><input type='hidden' name='cod' value='$cod'/>    <button type='submit' name='action' value='elimina'>Elimina</button>";

		$stringa=$stringa."</div></form>";
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	}
	
	function formModificaUtente($cod){
		$f=new FacadeGestioneAccount();
		$view="";
		$utente=$f->visualizzaCliente($cod);
		$stringa="";
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
				$stringa="<form method='GET' action='indexAgente.php'>";
			}
			if($_SESSION['tipo']=='amministratore'){
				$view = file_get_contents('indexAmministratore.html');
				$stringa="<form method='GET' action='indexAmministratore.php'>";
			}	
		}
		$_SESSION['modificaUtente']= $cod;
		$nome=$utente->getNome();
		$data=$utente->getDataNascita();
		$originalDate = $data;
		$newDate = date('Y-m-d', strtotime($originalDate));
		$email=$utente->getEmail();
		$telefono=$utente->getTelefono();
		$username=$utente->getUsername();
		$password=$utente->getPassword();
		$stringa=$stringa."Codice Fiscale: <input type='text' name='codiceFiscale' value='$cod'/><br><br>Nome e Cognome: <input type='text' name='nome' value='$nome'/><br><br>
		Data Nascita: <input type='date' name='data' value=$newDate /><br><br>Email: <input type='email' name='email' value='$email'><br><br>Telefono: <input type='number' name='telefono' value='$telefono'/><br><br>Username: <input type='text' name='username' value='$username'/><br><br>Password: <input type='password' name='password' value='passsword'><br><br><button type='submit' name='action' value='conferma'>Conferma</button>";
	
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
	}
	
	function formModificaImmobile($id){
		$f=new FacadeGestioneImmobili();
		$view="";
		$immobile=$f->visualizzaImmobile($id);
		$stringa="";
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='agente'){
				$view = file_get_contents('indexAgente.html');
			}		
		}
		
		$descrizione=$immobile->getDescrizione();
		$contratto=$immobile->getContratto();
		$metratura=$immobile->getMetratura();
		$prezzo=$immobile->getPrezzo();
		$tipo=$immobile->getTipo();
		$immagine=$immobile->getImmagine();
		$comune=$immobile->getComune();
		$stringa=$stringa."<form method='GET' action='indexAgente.php'>Descrizione: <br><textarea name='descrizione' rows='15' cols='50' '>$descrizione</textarea><br><br><br><br>Comune: <input type='text' name='comune' value='$comune'><br><br>Metratura: <input type='number' name='metratura' value='$metratura'/><br><br>Prezzo:<input type='number' name='prezzo' value='$prezzo'/><br>
		<br>Contratto: <input type='text' name='contratto' value='$contratto'/><br><br>Tipo: <input type='text' name='tipo' value='$tipo'/> <input type='hidden' name='immagine'  value='$immagine'/*'/><br><br><button type='submit' name='modificaImmobile' value='$id'>Modifica</button></form>";
		$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
		echo $view_xhtml_valorizzata;
		
	}
	
	function mostraNotifiche(){
			$fi=new FacadeGestioneImmobili();
			$ft=new FacadeGestioneTrattative();
			$immobili=$fi->getImmobili();
			$trattative=$ft->getTrattative();
			$stringa="";
			$view="";
			if($_SESSION['tipo']=='amministratore'){	//caso amministratore
				$stringa="<form method='GET' action='indexAmministratore.php' ><div>";
				$view = file_get_contents('indexAmministratore.html');
				foreach($immobili as $value){
					if($value->getAgente()==null){
						$id=$value->getId();
						$stringa=$stringa."C'è un nuovo immobile da assegnare<br><button type='submit' name='id' value='$id'>Visualizza</button><br><br>";
						}
				}
				
				foreach($trattative as $value){
					if($value->getAgente()==null){
						$stringa=$stringa."Ci sono nuove Trattative da assegnare<br><button type='submit' name='bar' value='trattative'>Visualizza</button><br><br>";
						break;
					}
				}
				
			}
			else if($_SESSION['tipo']=='agente'){//caso agente
				$stringa="<form method='GET' action='indexAgente.php' ><div>";
				$view = file_get_contents('indexAgente.html');
				foreach($immobili as $value){
					if($value->getApprovato()==0&&$value->getAgente()==$_SESSION['cod']){
						$id=$value->getId();
						$stringa=$stringa."Ti è stato assegnato un nuovo Immobile<br><button type='submit' name='id' value='$id'>Visualizza</button><br><br>";
						}
				}
				foreach($trattative as $value){
					if($value->getApprovata()==0&&$value->getAgente()==$_SESSION['cod']){
						$stringa=$stringa."Ci sono nuove Trattative da approvare<br><button type='submit' name='bar' value='trattative'>Visualizza</button><br><br>";
						break;
					}
				}
			}
			$stringa=$stringa."</div></form>";
			$view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
			echo $view_xhtml_valorizzata;
			
	
	}
	?>