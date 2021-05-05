<html>
	<head>        
        <title>Liste des VLAN</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div id="page-content-wrapper" style="height:768px">
            <div class="container-fluid">
                <centre> <h1 style="color:#2F4F4F;margin-left:550px;">Liste des VLAN</h1></centre>
                    <br><br><hr>

                    <p><center><font size="5" face="arial" color="black">  </center></p>
                    <p><center><font size="4" face="arial" color="black">  </center></p>
                    <div id="trait"></div></br> 
                <center>

                    <form action="forum.php" method="post" role="form">
                        <div class="col-md-6" style="border-left:10px outset #2A4F1A;background-color:#A9A9A9;padding-top:10px;padding-bottom:10px;border-radius:20px;">

                        <p><center><h4> * > Liste des VLAN < * </h4> </center></p>	

                        <?php
                        include 'connectBDD.php';

                        // Vider le contenu du fichier interfaces
                        $fichier = fopen('interfaces','r+');

                        if($fichier!=NULL) {
                            ftruncate($fichier, 0);

                        }else{
                                echo "\nErreur Ouverture fichier.";   
                            }

                        fclose($fichier);
                        //interfaces1
                        $fichier = fopen('interfaces1','r+');

                        if($fichier!=NULL) {
                            ftruncate($fichier, 0);

                        }else{
                                echo "\nErreur Ouverture fichier.";   
                            }

                        fclose($fichier);
                        //interfaces2
                        $fichier = fopen('interfaces2','r+');

                        if($fichier!=NULL) {
                            ftruncate($fichier, 0);

                        }else{
                                echo "\nErreur Ouverture fichier.";   
                            }

                        fclose($fichier);



                        $sql = ('SELECT id, nom_vlan, bondvlan, vmbr FROM VLAN ORDER BY ID');
                        $run_sql=mysqli_query($conn,$sql);

                            while($rows= mysqli_fetch_array($run_sql))
                                {
                                    print("___________ VLAN ".$rows['id']." ___________");
                                    echo '<p> <strong> ' . htmlspecialchars($rows['id']) . 
                                    '</strong> :  ' . htmlspecialchars($rows['nom_vlan']) . 
                                    '</strong> :  ' . htmlspecialchars($rows['bondvlan']) . 
                                    '</strong> :  ' . htmlspecialchars($rows['vmbr']). '</p>';




                                    //Editer le fichier
                                    // Ouverture du ficher interface et modifier de dans
                                    $fichier = fopen('interfaces1','r+');

                                    if($fichier!=NULL) {
                                      //Completer l'ecriture avec les commandes d'attribution et de redemarrage de l'interface

                                      fputs($fichier,"#".$rows['nom_vlan']."\n");
                                      fputs($fichier,"auto ".$rows['bondvlan']."\n");
                                      fputs($fichier,"iface ".$rows['bondvlan']." inet manuel\n");
                                      fputs($fichier,"mtu 9000\n");

                                      fputs($fichier,"\n");
                                      fputs($fichier,"#".$rows['nom_vlan']."\n");
                                      fputs($fichier,"auto ".$rows['vmbr']."\n");
                                      fputs($fichier,"iface ".$rows['vmbr']." inet manual\n");
                                      fputs($fichier,"bridge-ports ".$rows['bondvlan']."\n");
                                      fputs($fichier,"bridge-stp off\n");
                                      fputs($fichier,"bridge-fd 0\n");
                                      fputs($fichier,"mtu 9000\n");
                                      fputs($fichier,"\n");

                                    }else
                                    { echo "\nErreur Ouverture fichier.";   }

                                    fclose($fichier);
                                    exec("sudo /bin/bash /var/www/html/gestionVLAN/script.sh");
                                      //interfaces1
                        $fichier = fopen('interfaces1','r+');

                        if($fichier!=NULL) {
                            ftruncate($fichier, 0);

                        }else{
                                echo "\nErreur Ouverture fichier.";   
                            }

                        fclose($fichier);
                                
                                }
                                mysqli_close($conn);
                        ?>


                        </div>    
                    </form>
                </center>


            </div>
            <center><a href="index.php" target="_self"> <input type="button" value="Menu principal" style="background-color: #f44336;border-radius: 8px;font-size: 20px;transition-duration: 0.4s;"> </a></center></br>
        </div>
            <!-- /#wrapper -->



        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
        </script>
        <style>
            hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
            }
        </style>
    </body>
</html>



