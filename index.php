
<?php
include("conexiune.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Practica Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>




<body>
 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Calculator Salarii</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
           
            <ul class="nav navbar-nav">
            <li><a href="info.php">Valoare Taxe </a></li>


            <ul class="nav navbar-nav">
            <li><a href="contact.php">Contact</a></li>


            

            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>



<left>

<div class="container">
      <br><br><br><br><br> 
      <br><br><br><br><br> 

  <center></br></br>
<form method="post" action="/">
    <label>Introduceti salariul Net :</label>
    <input type="text" name="salarNet" value=""/><br>

<label> Selecteaza Nr persoane in intretinere </label>    
<input list="browsers" name="browser">
  <datalist id="browsers">
      <option name="persoana" value="Nici o persoana in intretinere">
    <option name="persoana" value="O persoana in intretinere">
    <option value="Doua persoane in intretinere">
    <option value="Trei persoane in intretinere">
    <option value="Mai mult de trei persoane in intretinere">
  </datalist>


    
    <input type="submit" name="btn" value="Calculeaza"/>

    <br>

    
</form>



<?php

    $salNet = $_POST["salarNet"];
    
    $NrPers= $_POST["persoana"];
   
   if ($NrPers = "Nici o persoana in intretinere") {
    
   
   $select = "SELECT  minBrut, maxBrut, fara_Persoane FROM deduceri";
        $result = mysqli_query($conn, $select);
                if ($result->num_rows>0) {
                        while($row = $result->fetch_assoc()) {
                             if ($salNet>=$row['minBrut'] && $salNet<=$row['maxBrut']) {
                             $deduceri_personale=$row['fara_Persoane'];
                                                }
                                            }
                                        }}
                                   
elseif ($NrPers = "O persoana in intretinere") {
      $select = "SELECT  minBrut, maxBrut,o_Persoana FROM deduceri_opersoana";
        $result = mysqli_query($conn, $select);
                if ($result->num_rows>0) {
                        while($row = $result->fetch_assoc()) {
                             if ($salNet>=$row['minBrut'] && $salNet<=$row['maxBrut']) {
                             $deduceri_personale=$row['o_Persoana'];
                                                }
                                            }
                                        }
}

                                    


   // $deduceri_personale = $_POST["deduceri_personale"] ;
  

    $salariuBrut = ($salNet - 0.16*$deduceri_personale)/0.7014;
    $CAS_Angajat= ($salariuBrut * 0.105);
    $CASS_Angajat= ($salariuBrut * 0.055);
    $CFS_Angajat= ($salariuBrut * 0.005);
    $IMPOZIT_PE_VENIT=($salariuBrut-$deduceri_personale)*0.16;
    $CAS_Angajator =($salariuBrut *0.158);
    $CASS_Angajator =($salariuBrut *0.052);
    $CFS_Angajator =($salariuBrut *0.0050);
    $CONCEDII_SI_INDEMNIZATII_Angajator =(($salariuBrut *0.85)/100);
    $CREANTE_SALARIALE_Angajator =(($salariuBrut *0.25)/100);
    $FOND_RISC_SI_ACCIDENTE =(($salariuBrut *0.40)/100);
    $COST_TOTAL_ANGAJATOR =($salariuBrut+$CAS_Angajator+$CASS_Angajator+$CFS_Angajator+$CONCEDII_SI_INDEMNIZATII_Angajator+$CREANTE_SALARIALE_Angajator+$FOND_RISC_SI_ACCIDENTE );
?>

<br><br><br>
    <label>Contributii Angajat</label>
<br><br>
    <label>Deduceri Personale :   </label>
    <?php
    echo number_format((float)$deduceri_personale, 2, '.', '')?>
<br>  


    <label class="tab">CAS (pensii) :   </label>
    <?php
    echo number_format((float)$CAS_Angajat, 2, '.', '')
    ?>
<br>
    <label class="tab">CASS (Sanatate) : </label>
    <?php
    echo number_format((float)$CASS_Angajat, 2, '.', '')?>

<br>
    <label class="tab">CFS (Somaj):  </label> 
    <?php
    echo number_format((float)$CFS_Angajat, 2, '.', '')?>
<br>  
    <label>Impozit Pe Venit :   </label>
    <?php
    echo number_format((float)$IMPOZIT_PE_VENIT, 2, '.', '')?>
<br><br>
 <label>Contributii Angajator</label>
<br>


<br>
    <label>CAS (Pensii) :   </label>
    <?php
    echo number_format((float)$CAS_Angajator, 2, '.', '')?>



<br>
    <label>CASS (Sanatate)  :   </label>
    <?php
    echo number_format((float)$CASS_Angajator, 2, '.', '')?>



<br>
    <label>CFS (Somaj)  :   </label>
    <?php
    echo number_format((float)$CFS_Angajator, 2, '.', '')?>


<br>
    <label>Concedii Si Indemnizatii :   </label>
    <?php
    echo number_format((float)$CONCEDII_SI_INDEMNIZATII_Angajator, 2, '.', '')?>


<br>
    <label>Creante Salariale  :  </label> 
    <?php
    echo number_format((float)$CREANTE_SALARIALE_Angajator, 2, '.', '')?>

<br>
    <label>Fond Risc Si Accidente  :   </label>
    <?php
    echo number_format((float)$FOND_RISC_SI_ACCIDENTE, 2, '.', '')?>




    <br><br><br><br>

    <label>Salariul Net Este :  </label>
    <?php
    echo number_format((float)$salNet, 2, '.', '')?>
    <br>
    <label>Salariul Brut Este :  </label>
    <?php
    echo number_format((float)$salariuBrut, 2, '.', '')?>

    <br>
    <label>Cost Total Angajator :  </label>
    <?php
    echo number_format((float)$COST_TOTAL_ANGAJATOR, 2, '.', '')?>



      </div>
    </div>


</body>
</html>