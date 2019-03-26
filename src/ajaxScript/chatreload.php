<?php
include('../../Modele/modele.php');

$lastmessageid = htmlspecialchars($_GET['lastmessageid']);

if (isset($lastmessageid)){
    $recupmessagesuivant = recupmessage();
    $recupmessagesuivant = $recupmessagesuivant->fetchAll();
    $recupmessagesuivant = array_reverse($recupmessagesuivant);
    foreach($recupmessagesuivant as $unmessage){
        echo "<p> <u>" . substr($unmessage['date'], 0, 10) . "</u>  <b>" . $unmessage['authorid'] . " :</b> " . $unmessage['content'] . " </p>";
    };
};