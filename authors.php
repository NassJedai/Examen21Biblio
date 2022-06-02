<?php 

require 'config.php'; 

// déclaration des variables 

$nationality = '';



$link = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); 

    if($link) { 

        //mysqli_real_query(); 
        $query = "SELECT DISTINCT nationality FROM `authors` ORDER BY nationality";

        $result = mysqli_query($link, $query); 

        if($result) {

            $nationalitys = [];

            while(($data = mysqli_fetch_row($result)) !== null) {

                $nationalitys[] = $data [0];

            }


        } mysqli_free_result($result); 

    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    if (isset($_GET['btSearch'])) { 

        $nationality = $_GET['nationality'];

        $query = "SELECT firstname, lastname FROM `authors` WHERE
         nationality='France' ORDER BY 2";

        $result = mysqli_query($link, $query); 

        if($result) {

            $authors = [];

            while(($author = mysqli_fetch_assoc($result)) !== null) {

                $authors[] = $author ;

                // echo '<pre>';
                // var_dump($authors);
                // echo '</pre>';
        }
        
            


        } mysqli_free_result($result); 

    } 

} mysqli_close($link);
?>





<?php require 'includes/header.php' ?>

<form action="<?= $_SERVER['PHP_SELF']?>" method="get">

        <select>
            <?php foreach($nationalitys as $nationality) {?>
                <option name="nationality"><?= $nationality ;?></option>
            <?php } ?>
        </select>
 
        <button name="btSearch">Rechercher</button>
</form>

    <ul>
 
    <?php foreach($authors as $author) {?>
        <li><?= $author['firstname']. ' ' .$author['lastname'] ;?></li>
    <?php } ?>
    </ul>


<?php require 'includes/footer.php' ?>