<?php
session_start(); 
//Inclusion des constantes pour la BD
require 'config.php'; 

function validatePassword (string $pwd) {

    if(strlen($pwd)<5) {
        return false; 
    }

    } return true; 

// déclaration des variables 
$message =''; 

if (isset($_POST['btSignin'])) {

    if (!empty($_POST['login']) && !empty($_POST['email']) 
    && !empty($_POST['pwd']) && !empty($_POST['pwd_conf'])) {

        $login = $_POST['login']; 
        $email = $_POST['email']; 
        $pwd = $_POST['pwd']; 
        $pwd_conf = $_POST['pwd_conf']; 

        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {

            if($pwd == $pwd_conf) {    

                if (validatePassword($pwd)) {

                    // Inscription

                    // Connexion à la BD

                    $link = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

                    if ($link) {}
                        // Nettoyer les données entrantes 
                            $login = mysqli_real_escape_string($link, $login);
                            $email = mysqli_real_escape_string($link, $email);

                            $pwd = password_hash ($pwd, PASSWORD_BCRYPT); 

                        // Préparer la requête 
                            $query= "INSERT INTO `users` ( `login`, `email`, `statut`, `password`, `created_at`,) 
                                    VALUES ( '$login', '$email', 'novice', '$pwd', current_timestamp());"; 
                        // Envoyer la requête 
                            $result = mysqli_query($link, $query);
                        // Vérifier si elle à réussi 
                            if ($result && mysqli_affected_rows($link)>0) {

                                // Connexion
                                $_SESSION['login'] = $login; 

                                //redirection 
                                header('location: index.php');
                                header('Status: 302'); 
                                exit;

                            }
                        // Se déconnecter 
                        
                    }


            } else 
                {$message = 'les mots de passe ne correspondent pas !';}


        } else 
            {$message = 'Votre email ne semble pas valide ! ';}

    } else 
        {$message = 'Veuilllez remplir tous les champs';}

    


} else 
    {$message = 'Bienvenu';}


?>



<form  action="<?= $_SERVER['PHP_SELF']?>" method="post">
    
    <div>
    <label>Login </label>
    <input type="text" name="login"  required>
    </div>

    <div>
    <label>email </label>
    <input type="email" name="email"  required>
    </div>

    <div>
    <label>Password </label>
    <input type="password" name="pwd" required>
    </div>

    <div>
    <label>Confirm password </label>
    <input type="password" name="pwd_conf" required>
    </div>

    <div>
    <button name="btSignin"> s'inscrire </button>
    </div>

</form>

<p> <?= $message ?> </p>




