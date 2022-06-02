<?php 

require 'config.php'; 

// déclaration des variables 

$nationalitys = [];


$link = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); 

    if($link) { 
        //mysqli_real_query(); 
        $query = "SELECT DISTINCT nationality FROM `authors` ORDER BY nationality";

        $result = mysqli_query($link, $query); 

        if($result) {

            $nationalitys = [];

            while(($ligne = mysqli_fetch_assoc($result)) !== null) {

                $nationalitys [] = $ligne;

                echo '<pre>';
                var_dump($nationalitys);
                echo '</pre>';
        }
        
        mysqli_free_result($result); 


        mysqli_close($link);

        }

    }
?>





<?php require 'includes/header.php' ?>

<form action="<?= $_SERVER['PHP_SELF']?>" method="get">

    <?php foreach($nationalitys as $nationality) {?>
        <select>
            <option name="nationality"><?= $nationality ;?></option>
        </select>
    <?php } ?>
        <button name="btSearch">Rechercher</button>

</form>

    <ul>
        <li><strong>France</strong></li>
        <li>Honoré de Balzac</li>
    </ul>


<?php require 'includes/footer.php' ?>