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
    <a class="active">Modifier VLAN</a>
    </div>
    <h2>Modifier les VLAN </h2><br>

    <div class="container">
      <form method="post" action="">

        <table>
          <tr>
            <td><label for="nvlan">ID VLAN a modifier </label></td>
            <td>
            <input type="text" class="form-control" id="id_vlan" placeholder="1" min="3050" max="3200" name="id_vlan">
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

          <tr>
            <td><label for="nvlan">Nouveau VLAN </label></td>
            <td>
            <input type="text" class="form-control" id="vlan_nouveau" placeholder="300X" min="3050" max="3200" name="vlan_nouveau">
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

          <tr>
            <td><label for="des">Description VLAN </label></td>
            <td>
            <input type="text" class="form-control" id="des_nouveau" placeholder="VLAN_300X_NameSocity" name="des_nouveau">
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
          <tr>
            <td><label for="vlanLinux">Vlan row device </label></td>
            <td>
            <input type="text" class="form-control" id="vlanLinux" placeholder="bondX" name="vlanLinux">
            </td>
          </tr>

          <tr>
            <td>
              <br><br><br>
            </td>
            <td>
              <br><br><br>
            </td>
          </tr>


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

          <br>
            <tr><br><td></td><td><center><input type="submit" name="Modifier" value="Modifier"class="btn btn-success btn-lg"></center></td>
            <td><a href="index.php" target="_self"> <input type="button" value="Retour"class="btn btn-danger btn-lg"> </a></td>
          </tr>

        </table>
      </form>
    </div>
  </body>
</html>

<?php 
include 'connectBDD.php';

// Script recuperer les valeurs des attributs
if(isset($_POST['Modifier'])){
  foreach ($_POST as $key => $value) {
    // Recuperation du nom VLAN
    if ($key == 'id_vlan') {       
    $id_vlan =$value ;        
    }

    // Recuperation du vlanlinux
    if ($key == 'vlan_nouveau') {        
    $vlan_nouveau =$value ;        
    }

    // Recuperation du vmbr
    if ($key == 'des_nouveau') {        
    $des_nouveau =$value ;        
    }
  

    // Recuperation du bond
    if ($key == 'vlanLinux') {        
    $vlanLinux =$value ;        
    }
  }

  $bondvlan = "$vlanLinux.$vlan_nouveau";
  $vmbr = "vmbr$vlan_nouveau";

  // Modifier la BDD
  // $sql = "INSERT INTO VLAN (nom_vlan, bondvlan, vmbr) VALUES (NULL,'$des','$bondvlan','$vmbr')";
  $sql = "UPDATE VLAN SET nom_vlan = '$des_nouveau', bondvlan = '$bondvlan', vmbr = '$vmbr' WHERE id = $id_vlan";
    $run_sql=mysqli_query($conn, $sql);
    if (!$run_sql)
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    };
   mysqli_close($conn);

    header('Location: listVLAN.php');
  //  // Editer les fichiers
  //  // Vider le contenu du fichier interfaces
  // $fichier = fopen('interfaces','r+');

  // if($fichier!=NULL) {
  //     ftruncate($fichier, 0);

  // }else{
  //         echo "\nErreur Ouverture fichier.";   
  //     }

  // fclose($fichier);
  // //interfaces1
  // $fichier = fopen('interfaces1','r+');

  // if($fichier!=NULL) {
  //     ftruncate($fichier, 0);

  // }else{
  //         echo "\nErreur Ouverture fichier.";   
  //     }

  // fclose($fichier);
  // //interfaces2
  // $fichier = fopen('interfaces2','r+');

  // if($fichier!=NULL) {
  //     ftruncate($fichier, 0);

  // }else{
  //         echo "\nErreur Ouverture fichier.";   
  //     }

  // fclose($fichier);

  // // Editer les fichiers
  //  $sql1 = ('SELECT id, nom_vlan, bondvlan, vmbr FROM VLAN ORDER BY ID DESC LIMIT 0, 10');
  //                       $run_sql1 = mysqli_query($conn,$sql1);

  //                           while($rows = mysqli_fetch_array($run_sql1))
  //                               {
  //                                   //Editer le fichier
  //                                   // Ouverture du ficher interface et modifier de dans
  //                                   $fichier = fopen('interfaces1','r+');

  //                                   if($fichier!=NULL) {
  //                                     //Completer l'ecriture avec les commandes d'attribution et de redemarrage de l'interface

  //                                     fputs($fichier,"#".$rows['nom_vlan']."\n");
  //                                     fputs($fichier,"auto ".$rows['bondvlan']."\n");
  //                                     fputs($fichier,"iface ".$rows['bondvlan']." inet manuel\n");
  //                                     fputs($fichier,"mtu 9000\n");

  //                                     fputs($fichier,"\n");
  //                                     fputs($fichier,"#".$rows['nom_vlan']."\n");
  //                                     fputs($fichier,"auto ".$rows['vmbr']."\n");
  //                                     fputs($fichier,"iface ".$rows['vmbr']." inet manual\n");
  //                                     fputs($fichier,"bridge-ports ".$rows['bondvlan']."\n");
  //                                     fputs($fichier,"bridge-stp off\n");
  //                                     fputs($fichier,"bridge-fd 0\n");
  //                                     fputs($fichier,"mtu 9000\n");
  //                                     fputs($fichier,"\n");

  //                                   }else
  //                                   { echo "\nErreur Ouverture fichier.";   }

  //                                   fclose($fichier);
  //                                   exec("sudo /bin/bash /var/www/html/gestionVLAN/script.sh");
  //                               }
  //                               mysqli_close($conn);

  // $sql = ('SELECT id, nom_vlan, bondvlan, vmbr FROM VLAN ORDER BY ID DESC LIMIT 0, 10');
  //     $run_sql=mysqli_query($conn,$sql);

  //         while($rows= mysqli_fetch_array($run_sql))
  //             {
  //             echo '<p> <strong> ' . htmlspecialchars($rows['id']) . 
  //             '</strong> :  ' . htmlspecialchars($rows['nom_vlan']) . 
  //             '</strong> :  ' . htmlspecialchars($rows['bondvlan']) . 
  //             '</strong> :  ' . htmlspecialchars($rows['vmbr']). '</p>';
  //             }
  //             mysqli_close($conn);
  // Ouverture du ficher interface et modifier de dans
                                                          //   $fichier = fopen('interfaces1','r+');

                                                          //   if($fichier!=NULL) {
                                                          //   //Completer l'ecriture avec les commandes d'attribution et de redemarrage de l'interface

                                                          //   // fputs($fichier,"$adresse\n");
                                                          //   // fputs($fichier,"$vlanLinux\n");
                                                          //   // fputs($fichier,"$mdp\n");
                                                          //   // fputs($fichier,"\n");

                                                          //   fputs($fichier,"#$des\n");
                                                          //   fputs($fichier,"auto $vlanLinux.$nvlan\n");
                                                          //   fputs($fichier,"iface $vlanLinux.$nvlan inet manuel\n");
                                                          //   fputs($fichier,"mtu $bLinux\n");

                                                          //   fputs($fichier,"\n");
                                                          //   fputs($fichier,"#$des\n");
                                                          //   fputs($fichier,"auto vmbr$nvlan \n");
                                                          //   fputs($fichier,"iface vmbr$nvlan inet manual\n");
                                                          //   fputs($fichier,"bridge-ports $vlanLinux.$nvlan\n");
                                                          //   fputs($fichier,"bridge-stp off\n");
                                                          //   fputs($fichier,"bridge-fd 0\n");
                                                          //   fputs($fichier,"mtu $bLinux\n");
                                                          //   fputs($fichier,"\n");

                                                          // }else
                                                          // { echo "\nErreur Ouverture fichier.";   }

                                                          // fclose($fichier);

// // ######################
// $fichier = fopen('interfaces1','r+');
// if($fichier!=NULL) {

// }else { echo "\nErreur Ouverture fichier.";   }

// fclose($fichier);






// // Affichage
//  $sql = ('SELECT nom, message FROM VLAN ORDER BY ID DESC LIMIT 0, 10');
//         $run_sql=mysqli_query($conn,$sql);
        
//         while($rows= mysqli_fetch_array($run_sql))
//         {
//             echo '<p><strong>' . htmlspecialchars($rows['nom']) . '</strong> : ' . htmlspecialchars($rows['message']) . '</p>';
//         }

//Execution du fichier bash: scriptphp.sh
// exec("sudo /bin/bash /var/www/html/gestionVLAN/script.sh");
  }
?>
