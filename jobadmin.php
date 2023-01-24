<!DOCTYPE HTML>
<html>
        <!-- 
           CREATE TABLE myapplicants (
             id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             Nome VARCHAR(30) NOT NULL,
             Cognome VARCHAR(30) NOT NULL,
             Email VARCHAR(50) NOT NULL,
             Telefono INT(11) NOT NULL,
	     Età DATE NOT NULL,
	     Titolo_di_Studio VARCHAR(30) NOT NULL,
	     Poizione_Lavorativa VARCHAR(30) NOT NULL,
	     Sede_Lavorativa VARCHAR(30) NOT NULL,
	     CV LONGBLOB (o varbinary)
           ); -->
<style>
table, th, td {
  border:1px solid black;
}
</style>
	
<body>
<?php
$f1a='0000-01-01';
$f1b=date("Y-m-d");
$f2=$f3=$f4a=$f4b='';

if (!empty($_POST["filtro_età"])) {
   if($_POST["filtro_età"]==18) {
      $f1a = date("Y-m-d",strtotime("-25 year", time()));
      $f1b = date("Y-m-d",strtotime("-18 year", time()));
   }
   if($_POST["filtro_età"]==25) {
      $f1a = date("Y-m-d",strtotime("-35 year", time()));
      $f1b = date("Y-m-d",strtotime("-25 year", time()));
   }
   if($_POST["filtro_età"]==35) {
      $f1a = date("Y-m-d",strtotime("-45 year", time()));
      $f1b = date("Y-m-d",strtotime("-35 year", time()));
   }
   if($_POST["filtro_età"]==45) {
      $f1b = date("Y-m-d",strtotime("-45 year", time()));
   }
}
if (!empty($_POST["filtro_titolo_studio"])) {
   if($_POST["filtro_titolo_studio"]=='diploma')
      $f2='laurea';
   else $f2='diploma';
}
if (!empty($_POST["filtro_posizione_lavorativa"])) {
   if($_POST["filtro_posizione_lavorativa"]=='data scientist')
      $f3="statistico";
   else $f3="data scientist";
}
if (!empty($_POST["filtro_sede_lavorativa"])) {
   if ($_POST["filtro_sede_lavorativa"]=="milano") {
      $f4a="roma"; 
      $f4b="genova";
   }
   if ($_POST["filtro_sede_lavorativa"]=="roma") {
      $f4a="milano"; 
      $f4b="genova";
   }
   if ($_POST["filtro_sede_lavorativa"]=="genova") {
      $f4a="milano"; 
      $f4b="roma";
   }
}
?>
	
<center><h2>APPLICAZIONE FILTRI</h2></center>
	
<form method="post" action="">
Filtro Età:
<input type="radio" name="filtro_età" <?php if (isset($_POST['filtro_età']) && $_POST['filtro_età']=="18") echo "checked";?> value="18">18-25 anni
<input type="radio" name="filtro_età" <?php if (isset($_POST['filtro_età']) && $_POST['filtro_età']=="25") echo "checked";?> value="25">25-35 anni
<input type="radio" name="filtro_età" <?php if (isset($_POST['filtro_età']) && $_POST['filtro_età']=="35") echo "checked";?> value="35">35-40 anni
<input type="radio" name="filtro_età" <?php if (isset($_POST['filtro_età']) && $_POST['filtro_età']=="45") echo "checked";?> value="45">> 45 anni
<br><br>
Filtro Titolo di Studio:
<input type="radio" name="filtro_titolo_studio" <?php if (isset($_POST['filtro_titolo_studio']) && $_POST['filtro_titolo_studio']=="diploma") echo "checked";?> value="diploma">Diploma
<input type="radio" name="filtro_titolo_studio" <?php if (isset($_POST['filtro_titolo_studio']) && $_POST['filtro_titolo_studio']=="laurea") echo "checked";?>  value="laurea">Laurea
<br><br>
Filtro Posizione Lavorativa:
<input type="radio" name="filtro_posizione_lavorativa" <?php if (isset($_POST['filtro_posizione_lavorativa']) && $_POST['filtro_posizione_lavorativa']=="data scientist") echo "checked";?> value="data scientist">Data Scientist
<input type="radio" name="filtro_posizione_lavorativa" <?php if (isset($_POST['filtro_posizione_lavorativa']) && $_POST['filtro_posizione_lavorativa']=="statistico") echo "checked";?> value="statistico">Statistico
<br><br>
Filtro Sede Lavorativa:
<input type="radio" name="filtro_sede_lavorativa" <?php if (isset($_POST['filtro_sede_lavorativa']) && $_POST['filtro_sede_lavorativa']=="milano") echo "checked";?> value="milano">Milano
<input type="radio" name="filtro_sede_lavorativa" <?php if (isset($_POST['filtro_sede_lavorativa']) && $_POST['filtro_sede_lavorativa']=="roma") echo "checked";?> value="roma">Roma
<input type="radio" name="filtro_sede_lavorativa" <?php if (isset($_POST['filtro_sede_lavorativa']) && $_POST['filtro_sede_lavorativa']=="genova") echo "checked";?> value="genova">Genova
<br><br><br>
<input type="submit" name="submit" value="Applica Filtro">
</form>
<br><br><br>
	
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "mydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql="SELECT * FROM myapplicants
      WHERE (Età BETWEEN '$f1a' AND '$f1b') AND Titolo_di_Studio!='$f2' and Posizioni_Aperte!='$f3' and Sede_Lavorativa!='$f4a' and Sede_Lavorativa!='$f4b'";
$result = mysqli_query($conn,$sql);

$rowcount = mysqli_num_rows($result);
if ($rowcount==0) {
  echo "Al momento non vi sono candidati in base ai filtri selezionati.<br><br>";
}

mysqli_close($conn);
?>
	
<table style="width:100%">
  <tr>
    <th>id</th>
    <th>Nome</th>
    <th>Cognome</th>
    <th>Email</th>
    <th>Telefono</th>
    <th>Età</th>
    <th>Titolo di Studio</th>
    <th>Posizione Lavorativa</th>
    <th>Sede Lavorativa</th>
    <th>CV</th>
  </tr>
  <?php while($row = mysqli_fetch_array($result)) : ?>
  <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['Nome'];?></td>
    <td><?php echo $row['Cognome'];?></td>
    <td><?php echo $row['Email'];?></td>
    <td><?php echo $row['Telefono']; ?></td>
    <td><?php echo $row['Età'];?></td>
    <td><?php echo $row['Titolo_di_Studio'];?></td>
    <td><?php echo $row['Posizioni_Aperte'];?></td>
    <td><?php echo $row['Sede_Lavorativa'];?></td>
    <td><?php echo $row['CV'];?></td>
  </tr>
  <?php endwhile; ?>
</table>
</body>
</html>
