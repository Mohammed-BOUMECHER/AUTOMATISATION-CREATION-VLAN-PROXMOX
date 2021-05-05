<!DOCTYPE html>
  <html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="style.css" />
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

    <div class="topnav">
    <a class="active">Gestion VLAN</a>
    </div>
    <h2>Sauvegarde VLAN </h2><br>

    <div class="container">
      <form method="post" action="">

        <table>
          <tr>
            <td><label for="nvlan">N° VLAN </label></td>
            <td>
            <input type="text" class="form-control" id="nvlan" placeholder="300X" min="3050" max="3200" name="nvlan">
            </td>
          </tr>
          <tr>
            <td>
              <br><br>
            </td>
            <td>
              <br><br>
            </td>
          </tr>
          <tr>
            <td><label for="des">Description </label></td>
            <td>
            <input type="text" class="form-control" id="des" placeholder="VLAN_300X_NameSocity" name="des">
            </td>
          </tr>
          <tr>
            <td>
              <br><br>
            </td>
            <td>
              <br><br>
            </td>
          </tr>
          <tr>
            <td><label for="vlanLinux">Vlan row device </label></td>
            <td>
            <input type="text" class="form-control" id="vlanLinux" placeholder="bondX" name="vlanLinux">
            </td>
          </tr>
          <tr>
            <td>
              <br><br>
            </td>
            <td>
              <br><br>
            </td>
          </tr>
          <tr>
            <td><label for="bLinux">MTU </label></td>
            <td>
            <input type="text" class="form-control" id="bLinux" placeholder="9000" name="bLinux">
            </td>
          </tr>
          <br>

<!-- 
        <tr>
          <td><label for="adresse">Adresse ip :</label></td>
          <td>
            <input type="number" name="adr1" size="3" min="0" max="255" placeholder="192" step="1" required style="max-width: 4em;">
            <input type="number" name="adr2" size="3" min="0" max="255" placeholder="168" step="1" required style="max-width: 4em;">
            <input type="number" name="adr3" size="3" min="0" max="255"step="1" placeholder="1"required style="max-width: 4em;">
            <input type="number" name="adr4" size="3" min="0" max="255"step="1"placeholder="1" required style="max-width: 4em;"> 
          </td>
        </tr>
        <tr>
          <td><label for="hLog">Host Login: </label></td>
          <td>
          <input type="text" class="form-control" id="hLog" placeholder="root" name="hLog">
          </td>
        </tr>
        <br>
        <tr>
          <td><label for="mdp">Mot de passe: </label></td>
        <td>
        <input type="password" class="form-control" id="mdp"name="mdp">
        </td>
        </tr>
        <br> -->
        <style>
            
            body{
                background-image: url("burst.png");
                background-size: 30%;
                background-position: center;
                background-repeat: no-repeat;
                height: 800px;  
                background-size: 15%;

            }
        </style>

          <tr>
            <td>
              <br><br><br>
            </td>
            <td>
              <br><br><br>
            </td>
          </tr>

          <tr>
            <br>
            <td><center><input type="submit" name="Valider" value="Ajouter"class="btn btn-success btn-lg"></center></td>
            <td><a href="modifierVLAN.php" target="_self"> <input type="button" value="Modifier VLAN"class="btn btn-primary btn-lg"> </a></td>
            <td><a href="listVLAN.php" target="_self"> <input type="button" value="Liste VLAN"class="btn btn-primary btn-lg"> </a></td>
          </tr>

        </table>

      </form>
    </div>
  </body>
</html>

<?php 
include 'connectBDD.php';

// Script recuperer les valeurs des attributs
if(isset($_POST['Valider'])){
  $i = 1;
  // Extraction des valeurs de $_POST
  foreach ($_POST as $key => $value) {

  if ($key == 'nvlan') {        
  $nvlan = $value ;      


// Verification de l'existance de VLAN




  $handle = fopen("interfaces", "r");
  $chaine = "";

  // Concatenation
  if ($handle) {
    // process the line read.
      while (($line = fgets($handle)) !== false) {

          // process the line read.
        $chaine .=$line;
      
      }

      fclose($handle);
  } else {
      // error opening the file.
      print("File not exist !");
  }

  // print($chaine);
 //    print("\r\n");
    $mystring = $line;
    $word = "bond1.".$nvlan;

  // Test if string contains the word 
  if(strpos($chaine, $word) !== false){
        // echo "YES, Word Found!";
?>

        <script type="text/javascript">

             var msg="VLAN deja existant !! veuillez entrer un nouveau VLAN";
             console.log(msg)
             alert(msg);
         
      </script>
        <?php
      exit;
        // print("\r\n"); 
    } else{
        // echo "Word Not Found!";

        // print("\r\n"); 
    }

  }
  //---------------------------------------------------------------------------------------------//

  // Recuperation du nom VLAN
  if ($key == 'des') {       
  $des =$value ;        
  }

  // Recuperation du vlanlinux
  if ($key == 'hLog') {        
  $hLog =$value ;        
  }

  // Recuperation du vmbr
  if ($key == 'bLinux') {        
  $bLinux =$value ;        
  }

 // Recup Ip addresse
  if ($key == 'adr'.$i) {
  
    if($i == 1){
      $adresse =$value ;
    }
    else $adresse = $adresse.'.'.$value;
      
    $i++;
  }

  // Recuperation du Host
  if ($key == 'vlanLinux') {        
  $vlanLinux =$value ;        
  }

  // Recuperation mdp
  if ($key == 'mdp') {        
  $mdp =$value ;        
  }

}    


// Ouverture du ficher interface et modifier de dans
$fichier = fopen('interfaces1','r+');

if($fichier!=NULL) {
  //Completer l'ecriture avec les commandes d'attribution et de redemarrage de l'interface

  // fputs($fichier,"$adresse\n");
  // fputs($fichier,"$vlanLinux\n");
  // fputs($fichier,"$mdp\n");
  // fputs($fichier,"\n");

  fputs($fichier,"#$des\n");
  fputs($fichier,"auto $vlanLinux.$nvlan\n");
  fputs($fichier,"iface $vlanLinux.$nvlan inet manuel\n");
  fputs($fichier,"mtu $bLinux\n");

  fputs($fichier,"\n");
  fputs($fichier,"#$des\n");
  fputs($fichier,"auto vmbr$nvlan \n");
  fputs($fichier,"iface vmbr$nvlan inet manual\n");
  fputs($fichier,"bridge-ports $vlanLinux.$nvlan\n");
  fputs($fichier,"bridge-stp off\n");
  fputs($fichier,"bridge-fd 0\n");
  fputs($fichier,"mtu $bLinux\n");
  fputs($fichier,"\n");

}else
{ echo "\nErreur Ouverture fichier.";   }

fclose($fichier);

// ######################
$fichier = fopen('interfaces1','r+');
if($fichier!=NULL) {

}else { echo "\nErreur Ouverture fichier.";   }

fclose($fichier);

//variable de type bond1.3XXX
$bondvlan = "$vlanLinux.$nvlan";
$vmbr = "vmbr$nvlan";


//Inserer dans la BDD
$sql = "INSERT INTO VLAN (id, nom_vlan, bondvlan, vmbr) VALUES (NULL,'$des','$bondvlan','$vmbr')";       
    $run_sql=mysqli_query($conn, $sql);
    if (!$run_sql)
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    };
 mysqli_close($conn);


//Execution du fichier bash: scriptphp.sh
exec("sudo /bin/bash /var/www/html/gestionVLAN/script.sh");
  }
?>
<!-- #VLAN_3002_CSF_X

auto bond1.3003
iface bond1.3003 inet manual -->

<!-- #VLAN_3002_CSF_X
auto vmbr3002
iface vmbr3002 inet manual
bridge-ports bond1.3002
bridge-stp off
bridge-fd 0
mtu 9000
#VLAN_3002_CSF_X -->