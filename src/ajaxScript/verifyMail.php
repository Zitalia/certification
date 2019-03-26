<?php

include('../../Modele/modele.php');

$msgerrorpseudosame = "";

$mail = htmlspecialchars($_GET['registemail']);


if (isset($mail)) { 
    $res = verifyDispoMail($mail);


    $result = null;
    while($row = $res->fetch()) {
        $result = $row;
    }
    
    if($result == NULL) {
        
    }else{
        echo "*Ce mail est déja utilisé.";
    }
}
