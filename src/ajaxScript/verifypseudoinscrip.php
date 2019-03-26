<?php

include('../../Modele/modele.php');

$registerpseudo = htmlspecialchars($_GET['registerpseudo']);

if (isset($registerpseudo)) { 
    $res = verifydispo($registerpseudo);
    $result = null;
    while($row = $res->fetch()) {
        $result = $row;
    }

    if($result == NULL) {

    }else{
        echo "*Quelqu'un se fais déja appelé comme sa .";
    }
}
