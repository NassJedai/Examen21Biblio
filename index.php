<?php    

// Démarrer ou récupérer une session  
session_start(); 

//Inclusion des constantes pour la BD
require 'config.php'; 

?>


<?php     include 'includes/header.php'?>

<body>

<?php if(empty($_SESSION['login'])) { ?>

    <form name="" action="login.php" method="post">
        <label>Pseudo </label>
            <input type="text" name="pseudo" placeholder="Entez votre nom d'utilisateur" required>
        <label>Mot de passe </label>
            <input type="password" name="mdp" placeholder="Entez votre mot de passe"required>
            <button type="submit" name='btSearch'> Connexion </button>
    </form>

<?php } else { ?>

    <p><a href="login.php">Se déconnecter </p>
    <?php } ?>

</body>

<?php     include 'includes/footer.php'?>