<?php    

// Démarrer ou récupérer une session  
session_start(); 

//Inclusion des constantes pour la BD
require 'config.php'; 


// déclaration des varaibles 

$message = ''; 

if (isset($_POST['btSearch'])) {

    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp']; 

                // Connexion au serveur de bases de données
                $db = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

                if ($db) { 

                    // Préparation de la requête: nettoyer les données entrantes
                    $pseudo = mysqli_real_escape_string($db, $pseudo);
             
			        //Préparer la requête
                    $query = "SELECT password FROM users WHERE login='$pseudo'";

                    // Envoi de la requête
                    $result = mysqli_query($db, $query);

                    // Vérification du résultat
                    if ($result) {

                        $result = mysqli_fetch_assoc($result);
                        //var_dump($result);

                        if ($mdp == $result['password']) {

                            $_SESSION['login'] = $pseudo;
                            $message = 'connexion réussi';
                        }  else {$message = 'Erreur de mdp';}


                    } else { $message = 'problème résultat';}
                       
                    // Déconnexion du serveur de bases de données
                    mysqli_close($db);
                    

             } else {$message = 'Problème connexion db' ;}

     } else {$message = 'Problème psd et mdp';}


}

?>

<?php     include 'includes/header.php'?>

<p><?= $message ?></p>


<body>
    <form name="" action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <label>Pseudo </label>
            <input type="text" name="pseudo" placeholder="Entez votre nom d'utilisateur" required>
        <label>Mot de passe </label>
            <input type="password" name="mdp" placeholder="Entez votre mot de passe"required>
            <button type="submit" name='btSearch'> Connexion </button>
    </form>

</body>


<?php     include 'includes/footer.php'?>











