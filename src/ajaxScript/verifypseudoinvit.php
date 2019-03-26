<?php

include('../../Modele/modele.php');

$msgerrorpseudosame = "";

$pseudoinscrip = htmlspecialchars($_GET['invitpseudo']);

if (isset($pseudoinscrip)) { 
    $res = verifydispo($pseudoinscrip);
    $result = null;
    while($row = $res->fetch()) {
        $result = $row;
    }

    if($result == NULL) {
        
    }else{
        echo "*Quelqu'un se fais déja appelé comme sa .";
    }
}
