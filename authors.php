




<?php 


//Inclusion des constantes pour la BD
require 'config.php'; 




if(!empty($_POST['pays'])) {

    $pays = $_POST['pays'];


        //Connexion au serveur de bases de données
    $db = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

    // Préparation de la requête: nettoyer les données entrantes
    // $pays = mysqli_real_escape_string($db, $pays);
    
    mysqli_real_escape_string($db, $pays);
    
    $query = "SELECT DISTINCT nationality FROM `authors` ORDER BY nationality ";

    // Envoi de la requête
    $result = mysqli_query($db, $query);

    if($result) {
        // Extraction des données
        $pays = [] ;
        
    while(( $ligne = mysqli_fetch_assoc($result)) !== null) {

        
	$tabLignes[] = $ligne[0];
}

        // Libérer la mémoire du jeu de résultats
        mysqli_free_result($result);

       
    } else { echo "Une erreur de requête s’est produite."; }

  
    //echo '<pre>';
    var_dump($tabLignes);
    //echo '</pre>';
    // Déconnexion du serveur de bases de données
    mysqli_close($db);

     


    } else { echo "hello"; }

    

?>


<?php     include 'includes/header.php'?>

<body>
<form name="" action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <label for="label"> Choisissez la nationalité:</label>
    <select name="pays" >
        <option value="">--Pays</option>
        <option name="usa">États-Unis</option>
        <option name="be">Belgique</option>
        <option name="gb">Grande-Bretagne</option>
        <option name="fr">France</option>
    </select>
    <button name='btSearch'> Rechercher </button>
</form>



<ul>
<?php foreach ($tabLignes as $ligne) { ?>

    
   <?php ?>;
    <!-- <li>  </li> -->

<?php } ?>;

</ul>

</body>
<?php     include 'includes/footer.php'?>
