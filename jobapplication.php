<!DOCTYPE HTML>
<html> 
<head>
<style>
.error {color: #FF0000;}
</style>
</head>

<body>
<center><h1>Invia la tua Candidatura compilando il form che segue:</h1></center>
<span class="error">* i campi con l'asterisco sono obbligatori</span><br><br>
<?php
$nome = $cognome = $email = $telefono = $età = "";
$nomeErr = $cognomeErr = $emailErr = $telefonoErr = $etàErr = $titolo_studioErr = $posizioni_aperteErr = $sede_cuocoErr = $sede_cameriereErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["nome"])) {
  $nomeErr = "Non hai inserito il nome";
} else {
	$nome = $_POST["nome"];
}
if (empty($_POST["cognome"])) {
  $cognomeErr = "Non hai inserito il cognome";
} else {
	$cognome = $_POST["cognome"];
}
if (empty($_POST["email"])) {
  $emailErr = "Non hai inserito l'email";
} else {
	$email = $_POST["email"];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Email non valida";
	  unset($_POST["email"]);
    }
}
if (empty($_POST["telefono"])) {
  $telefonoErr = "Non hai inserito il telefono";
} else {
	$telefono = $_POST["telefono"];
	if (!preg_match('/^3\d{9}$/',$_POST["telefono"])) {
	  $telefonoErr = "Numero di telefono non valido";
	  unset($_POST["telefono"]);
	}
}
if (empty($_POST["età"])) {
  $etàErr = "Non hai inserito l'età";
} else {
    $età = $_POST["età"];
	if ($età>date("Y-m-d",strtotime("-18 year", time()))) {
	  $etàErr = "Età non valida";
	  unset($_POST["età"]);
    } 
}
if (empty($_POST["titolo_di_studio"])) {
  $titolo_studioErr = "Non hai inserito il titolo di studio";
} 
if (empty($_POST["posizione_cuoco"]) and empty($_POST["posizione_cameriere"])) {
  $posizioni_aperteErr = "Non hai inserito la posizione lavorativa";
}
if (empty($_POST["sede_lavoro_cuoco"])) {
  $sede_cuocoErr = "Non hai inserito la sede per la posizione di cuoco";
}
if (empty($_POST["sede_lavoro_cameriere"])) {
  $sede_cameriereErr = "Non hai inserito la sede per la posizione di cameriere";
}
}
?>
<form method="post" action="">  
  Nome: <input type="text" name="nome" value=<?php echo $nome;?>>
  <span class="error">* <?php echo $nomeErr; ?></span>
  <br><br>
  Cognome: <input type="text" name="cognome" value=<?php echo $cognome;?>>
  <span class="error">* <?php echo $cognomeErr; ?></span>
  <br><br>
  E-mail: <input type="text" name="email" value=<?php echo $email;?>>
  <span class="error">* <?php echo $emailErr; ?></span>
  <br><br>
  Telefono: <input type="text" name="telefono" value=<?php echo $telefono;?>>
  <span class="error">* <?php echo $telefonoErr; ?></span>
  <br><br>
  Età: <input type="date" name="età" value=<?php echo $età;?>>
  <span class="error">* <?php echo $etàErr; ?></span>
  <br><br>
  Titolo di Studio:
  <input type="radio" name="titolo_di_studio" <?php if (isset($_POST["titolo_di_studio"]) && $_POST["titolo_di_studio"]=="diploma") echo "checked";?> value="diploma">Diploma
  <input type="radio" name="titolo_di_studio" <?php if (isset($_POST["titolo_di_studio"]) && $_POST["titolo_di_studio"]=="laurea") echo "checked";?> value="laurea">Laurea
  <span class="error">* <?php echo $titolo_studioErr; ?></span>
  <br><br>
  Posizioni Aperte:
  <input type="radio" name="posizione_cuoco" <?php if (isset($_POST["posizione_cuoco"]) && $_POST["posizione_cuoco"]=="cuoco") echo "checked";?> value="cuoco">Cuoco
  <input type="radio" name="posizione_cameriere" <?php if (isset($_POST["posizione_cameriere"]) && $_POST["posizione_cameriere"]=="cameriere") echo "checked";?> value="cameriere">Cameriere
  <span class="error">* <?php echo $posizioni_aperteErr; ?></span>
  <br><br>
  
  <?php if(!empty($_POST["posizione_cuoco"])) : ?>
    Sede di Lavoro per la Posizione di Cuoco:
    <input type="radio" name="sede_lavoro_cuoco" <?php if (isset($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="milano") echo "checked";?> value="milano">Milano
    <input type="radio" name="sede_lavoro_cuoco" <?php if (isset($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="roma") echo "checked";?> value="roma">Roma
    <input type="radio" name="sede_lavoro_cuoco" <?php if (isset($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="nessuna preferenza") echo "checked";?> value="nessuna preferenza">Nessuna Preferenza
	<span class="error">* <?php echo $sede_cuocoErr; ?></span><br><br>
	<?php
	if (!empty($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="milano") {
	  echo "&nbsp;&nbsp; Posizioni a Milano per Cuoco:<br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Primi: Per la sede di Milano si cerca un cuoco specializzato nei primi piatti della cucina milanese con almeno 5 anni di esperienza. <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Secondi: Per la sede di Milano si cerca un cuoco specializzato nei secondi piatti della cucina milanese con almeno 2 anni di esperienza. <br><br>";
	}
	if (!empty($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="roma") {
	  echo "&nbsp;&nbsp; Posizioni a Roma per Cuoco:<br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Primi: Per la sede di Roma si cerca un cuoco specializzato nei primi piatti della cucina romana con almeno 2 anni di esperienza. <br><br>";
	}
	if (!empty($_POST["sede_lavoro_cuoco"]) && $_POST["sede_lavoro_cuoco"]=="nessuna preferenza") {
	  echo "&nbsp;&nbsp; Posizioni a Milano per Cuoco:<br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Primi: Per la sede di Milano si cerca un cuoco specializzato nei primi piatti della cucina milanese con almeno 5 anni di esperienza. <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Secondi: Per la sede di Milano si cerca un cuoco specializzato nei secondi piatti della cucina milanese con almeno 2 anni di esperienza. <br><br>
	    &nbsp;&nbsp; Posizioni a Roma per Cuoco:<br><br>
	    &nbsp;&nbsp;&nbsp;&nbsp; - Cuoco Primi: Per la sede di Roma si cerca un cuoco specializzato nei primi piatti della cucina romana con almeno 2 anni di esperienza. <br><br>";
	}
    ?>
  <?php endif; ?>
  
  <?php if(!empty($_POST["posizione_cameriere"])) : ?>
    Sede di Lavoro per la Posizione di Cameriere:
    <input type="radio" name="sede_lavoro_cameriere" <?php if (isset($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="milano") echo "checked";?> value="milano">Milano
    <input type="radio" name="sede_lavoro_cameriere" <?php if (isset($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="genova") echo "checked";?> value="genova">Genova
    <input type="radio" name="sede_lavoro_cameriere" <?php if (isset($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="nessuna preferenza") echo "checked";?> value="nessuna preferenza">Nessuna Preferenza
	<span class="error">* <?php echo $sede_cameriereErr; ?></span><br><br>
	<?php
	if (!empty($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="milano") {
	  echo "&nbsp;&nbsp; Posizioni a Milano per Cameriere: <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cameriere di Sala: Per la sede di Milano si cerca cameriere di sala con almeno 2 anni di esperienza. <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Maître: Per la sede di Milano si cerca Maître con decennale esperienza.<br><br>";
	}
	if (!empty($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="genova") {
	  echo "&nbsp;&nbsp; Posizioni a Genova per Cameriere: <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cameriere di Sala: Per la sede di Genova si cerca cameriere di sala con almeno 2 anni di esperienza. <br><br>";
	}
    if (!empty($_POST["sede_lavoro_cameriere"]) && $_POST["sede_lavoro_cameriere"]=="nessuna preferenza") {
	  echo "&nbsp;&nbsp; Posizioni a Milano per Cameriere: <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cameriere di Sala: Per la sede di Milano si cerca cameriere di sala con almeno 2 anni di esperienza. <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Maître: Per la sede di Milano si cerca Maître con decennale esperienza.<br><br>
	    &nbsp;&nbsp; Posizioni a Genova per Cameriere: <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp; - Cameriere di Sala: Per la sede di Genova si cerca cameriere di sala con almeno 2 anni di esperienza. <br><br>";
	}
    ?>
  <?php endif; ?>
  
  <?php if(empty($_POST['posizione_cuoco']) and empty($_POST['posizione_cameriere'])) : ?>
   <input type="submit" name="continua" value="Continua"><br><br>
  <?php endif; ?>
  
  CARICA CV:  <input type="file" name="cv"><br><br>
  <input type=reset name="reset" value="RESET"><br><br>
  
  <?php if(isset($_POST['posizione_cameriere']) or isset($_POST['posizione_cuoco'])) : ?>
   <input type="submit" name="submit" value="INVIA">
  <?php endif; ?>
  
  <?php 
  if (isset($_POST['nome']) and isset($_POST['cognome']) and isset($_POST['email']) and isset($_POST['telefono']) and isset($_POST['età']) and isset($_POST['titolo_di_studio']) and !empty($_POST['cv'])){
	if (isset($_POST['posizione_cuoco'])  and isset($_POST['sede_lavoro_cuoco']) and empty($_POST['posizione_cameriere'])) {
      echo "<br><br>Candidatura inviata con successo!";
    }
	if (isset($_POST['posizione_cameriere']) and isset($_POST['sede_lavoro_cameriere'])and empty($_POST['posizione_cuoco'])) {
      echo "<br><br>Candidatura inviata con successo!";
    }
    if (isset($_POST['posizione_cameriere']) and isset($_POST['sede_lavoro_cameriere'])and isset($_POST['posizione_cuoco']) and isset($_POST['sede_lavoro_cuoco'])) {
      echo "<br><br>Candidatura inviata con successo!";
    }
  }
  ?>
</form>
</body>
</html>