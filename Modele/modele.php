<?php

session_start();

function insertuser($pseudo, $passone, $mail, $age, $genre, $logdate){
    $bdd = co();
    $req = $bdd->query("
      INSERT INTO user( name, Password, mail, age, sexe, regdate, statut, logdate) 
      VALUES ( '".$pseudo."', '".$passone."', '".$mail."', ".$age.", ". $genre .", CURRENT_DATE(), 2, ".$logdate.")
    ");
}

function verifypassword($pwd1, $pwd2){
  $matchpass=false;
  if( isset($pwd1) AND isset($pwd2)){
    if ($pwd1 == $pwd2){
        $matchpass=true;
    }
  }
  return $matchpass; 
}
function getUser($pseudo, $pwd) {
  $bdd = co();
  $req = $bdd->prepare("
  SELECT * 
  FROM user 
  WHERE name = :name 
  AND Password = :pwd");
  $req->bindParam(':name', $pseudo, PDO::PARAM_STR);
  $req->bindParam(':pwd', $pwd, PDO::PARAM_STR);
  $req->execute();
  return $req;
}

function verifydispo($pseudo) {
  $bdd = co();
  $req = $bdd->prepare("
  SELECT * 
  FROM user 
  WHERE name = :name");
  $req->bindParam(':name', $pseudo, PDO::PARAM_STR);
  $req->execute();
  return $req;
}

function verifyDispoMail($mail) {
  $bdd = co();
  $req = $bdd->prepare("
  SELECT * 
  FROM user 
  WHERE mail = :mail ");
  $req->bindParam(':mail', $mail, PDO::PARAM_STR);
  $req->execute();
  return $req;
}

function leaderboard(){
  $bdd = co();
  $leados = $bdd->prepare("SELECT * FROM user ORDER BY `creepypts` + `jeuxpts` + `videopts` + `chattime` + `avis` DESC LIMIT 5");
  $leados->execute();
  return $leados;
}

function logdate() {
  $bdd = co();
  if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $result = verifydispo($name);
    if ($result) {
    $lastquerytime = time(); //Il a exécuté ce code MAINTENANT
    $query = $bdd->prepare("UPDATE user SET logdate='". $lastquerytime ."' WHERE name='". $name ."'"); //On l'écrit dans la table
    $query->execute();
    }
  }
      $fiveminago = time() - 5 * 60; //5*60s=5min de délai, mettez ce que vous voulez
      $resulsultats = $bdd->prepare("SELECT * FROM user WHERE logdate>'". $fiveminago ."' ORDER BY logdate DESC LIMIT 10"); //Tous ceux qui ont fait un truc y a moins de 5min
      $resulsultats->execute();  
      return $resulsultats;
}

function trouverunuserparpseudo($id){
  $bdd= co();
  $req= $bdd->prepare("SELECT * FROM user WHERE name='". $id ."'");
  $req-> execute();
  return $req ; 
}
// function pour la video
function miniavideo($limit){
  $bdd = co();
  $minvi = $bdd->prepare("SELECT * FROM video ORDER BY pts DESC LIMIT $limit ");
  $minvi->execute();
  return $minvi;
}
function miniavideorandom($limit){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM video ORDER BY rand() DESC LIMIT $limit ");
  $minvsi->execute();
  return $minvsi;
}
function recupvideo($id){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM video WHERE id = $id LIMIT 3");
  $minvsi->execute();
  return $minvsi;
}
function videodelasemaine($date){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM video WHERE date >=' ". $date ."' LIMIT 5");
  $minvsi->execute();
  return $minvsi;
}
function videolike($aadd, $idvideo){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE video SET pts = pts $aadd WHERE id = $idvideo");
  $minvsi->execute();
  return $minvsi;
}
function addptsviduser($pts, $nameuser){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE user SET videopts = videopts $pts WHERE name='". $nameuser ."'");
  $minvsi->execute();
  return $minvsi;
}

//function pour les jeux
function miniajeux($limit){
  $bdd = co();
  $minvi = $bdd->prepare("SELECT * FROM jeux ORDER BY pts DESC LIMIT $limit ");
  $minvi->execute();
  return $minvi;
}
function recupjeux($id){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM jeux WHERE id = $id LIMIT 3");
  $minvsi->execute();
  return $minvsi;
}
function miniajeuxrandom($limit){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM jeux ORDER BY rand() DESC LIMIT $limit ");
  $minvsi->execute();
  return $minvsi;
}
function bestjoueur($limit){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM user ORDER BY jeuxpts DESC LIMIT $limit ");
  $minvsi->execute();
  return $minvsi;
}
function bestjeux($limit){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM jeux ORDER BY pts DESC LIMIT $limit ");
  $minvsi->execute();
  return $minvsi;
}
function likejeu($aadd, $idjeu){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE jeux SET pts = pts $aadd WHERE id = $idjeu");
  $minvsi->execute();
  return $minvsi;
}
function addptsjeuxuser($pts, $nameuser){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE user SET jeuxpts = jeuxpts $pts WHERE name='". $nameuser ."'");
  $minvsi->execute();
  return $minvsi;
}

//function pour les histoires
function miniacreepyrandom($limit){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM histoire ORDER BY rand() DESC LIMIT $limit ");
  $minvsi->execute();
  return $minvsi;
}
function recuphistoire($id){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM histoire WHERE id = $id LIMIT 3");
  $minvsi->execute();
  return $minvsi;
}
function recuptoplecteur(){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM user ORDER BY creepypts DESC LIMIT 5");
  $minvsi->execute();
  return $minvsi;
}
function recuptophistoire(){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM histoire ORDER BY pts DESC LIMIT 5");
  $minvsi->execute();
  return $minvsi;
}
function storylike($aadd, $idhist){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE histoire SET pts = pts $aadd WHERE id = $idhist");
  $minvsi->execute();
  return $minvsi;
}
function addptshistoir($pts, $nameuser){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE user SET creepypts = creepypts $pts WHERE name='". $nameuser ."'");
  $minvsi->execute();
  return $minvsi;
}

//function chat
function recupmessage(){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM chat ORDER BY id DESC LIMIT 20");
  $minvsi->execute();
  return $minvsi;
}
function insertmessage($authorid, $content){
  $bdd = co();
  $req = $bdd->query("
    INSERT INTO chat( authorid, date, content) 
    VALUES ( '".$authorid."', LOCALTIME(), '".$content."' ) 
  ");
}
function recupmessagesuivant($id){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM chat WHERE chat.id > $id ORDER BY chat.id ");
  $minvsi->execute();
  return $minvsi;
}
function recuplesplusactifs(){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM user  ORDER BY chattime DESC LIMIT 5 ");
  $minvsi->execute();
  return $minvsi;
}
function recuplesplusaimees($datte){
  $bdd = co();
  $minvsi = $bdd->prepare("SELECT * FROM chat, user WHERE chat.date > '".$datte."' AND chat.authorid = user.name ORDER BY date LIMIT 8 ");
  $minvsi->execute();
  return $minvsi;
}
function addptschatuser($pts, $nameuser){
  $bdd = co();
  $minvsi = $bdd->prepare("UPDATE user SET chattime = chattime $pts WHERE name='". $nameuser ."'");
  $minvsi->execute();
  return $minvsi;
}

function co() {
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=jemennuie;charset=utf8mb4', 'root', '');
    return $bdd;
  } catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
}