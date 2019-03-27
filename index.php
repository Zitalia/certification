
<?php
include('Modele/modele.php');


ini_set('display_errors',1);

if (isset($_GET['invitpseudo']) AND isset($_GET['invitage'])) {
	if($_GET['invitage'] >= 10){
		$_SESSION['name'] = htmlspecialchars($_GET['invitpseudo']);
		$_SESSION['age'] = htmlspecialchars($_GET['invitage']);
		$_SESSION['sexe'] = htmlspecialchars($_GET['genderinvit']);
	}
}

// if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")
// {
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//     exit();
// }

function ismobile(){
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
	
};
	$ismobile = ismobile();

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array([
	'index' => 'Hello {{ name }}!',
	'session' => $_SESSION,
]);
$loader = new Twig_Loader_Filesystem('templates');

$twig = new Twig_Environment($loader, [
	'debug' => true,
]);
$twig -> addExtension(new Twig_Extension_Debug());


if(!isset($_GET['routage'])) {
	$_GET['routage'] = 'index';
}

$route = $_GET['routage'];
//Accueil

if($_GET['routage'] != 'index'){
	if(empty($_SESSION['name'])){
		header('Location: https://jemennuie.be');
	}
}

//execution de ma fonction recuperant le leaderboard
$leaderboard = leaderboard();
$leaderboard = $leaderboard->fetchAll();
// ma foncion qui me permet de recuperer les utilisateurs connectés
$online = logdate();
$online = $online->fetchAll();
//Vidéos
// function pour afficher les vod les mieux noté
$miniavideo = miniavideo(5);
$miniavideo = $miniavideo->fetchAll();
// function creant la grille de video
$miniavidxdouze = miniavideorandom(12);
$miniavidxdouze = $miniavidxdouze->fetchAll();
// function recuperant les video de maniere random
$videorandomtroi = miniavideorandom(3);
$videorandomtroi = $videorandomtroi->fetchAll();
// function recuperant les video dela semaine
$date = date("Y-m-d");
$date = date("Y-m-d", strtotime("$date -7 days"));
$vodday = videodelasemaine($date);
$vodday = $vodday->fetchAll();
//Jeux
//function creant la grille de jeux
$miniajeuxxdouze = miniajeux(12);
$miniajeuxxdouze = $miniajeuxxdouze->fetchAll();
//function pour aller vers le jeux
$minjerand = miniajeuxrandom(3);
$minjerand = $minjerand->fetchAll();
//meilleurjoueur
$bestjoueur= bestjoueur(5);
$bestjoueur = $bestjoueur->fetchAll();
//milleur jeux
$bestjeux = bestjeux(5);
$bestjeux = $bestjeux->fetchAll();
//Histoire
$storyminia = miniacreepyrandom(12);
$storyminia = $storyminia->fetchAll();
//meilleur elcterur
$recuptoplecteur = recuptoplecteur();
$recuptoplecteur = $recuptoplecteur->fetchAll();
//meilleur histoire
$recuptophistoire = recuptophistoire();
$recuptophistoire = $recuptophistoire->fetchAll();
//chat
$recupmessage = recupmessage();
$recupmessage = $recupmessage->fetchAll();
$recupmessage = array_reverse($recupmessage);
//les plus actifs 
$recuplesplusactifs = recuplesplusactifs();
$recuplesplusactifs = $recuplesplusactifs->fetchAll();
//Les ychatteurs en lignes
$datatatadex = LOCALTIME(time());
$datatatadex[1] -= 15;
$datatatadex[4] += 1;
if($datatatadex[1]<0){
	$temp = $datatatadex[1];
	$datatatadex[2] -= 1;
	$datatatadex[1] = 60 + $temp;
};
function makeDate($data)
{
	return 
	1900 + $data[5]         . "-" .
	addZero($data[4]) . "-" . 
	addZero($data[3])       . " " .
	addZero($data[2])       . ":" . 
	addZero($data[1])       . ":" . 
	addZero($data[0]);
}
function addZero($number)
{
	if($number < 10){
		$number = "0". $number ; 
	};
	return $number;
};
$rrr = makeDate($datatatadex);
$recuplesplusaimees = recuplesplusaimees($rrr);
$recuplesplusaimees = $recuplesplusaimees->fetchAll();



switch ($route) {
	case 'index':
		echo $twig->render('indexview.html.twig', [
			'session' => session_destroy(),
			'ismobile' => $ismobile
		]);
		break;
	case 'accueil':
		echo $twig->render('pages/accueilview.html.twig', [
			'session' => $_SESSION,
			'route' => $route,
			'leados' => $leaderboard,
			'ounlaine' => $online,
			'ismobile' => $ismobile
		]);
		break;

	case 'inscription':
		$ok = register();
		if($ok) {
			echo $twig->render('indexview.html.twig', [
			]);
		}
		break;

		case 'jeux':
		echo $twig->render('pages/jeux.html.twig', [
			'session' => $_SESSION,
			'route' => $route,
			'minjexdouze' => $miniajeuxxdouze,
			'minjerand' => $minjerand,
			'bestp' => $bestjoueur,
			'bestg' => $bestjeux,
			'ismobile' => $ismobile
		]);
		break;

		case 'selectedjeux':
			$jeuxUrl = recupjeux($_GET['jeuxId']);
			$jeuxUrl = $jeuxUrl->fetchAll();
		echo $twig->render('pages/selectedjeu.html.twig', [
			'session' => $_SESSION,
			'route' => $route,
			'UrlJeux' => $jeuxUrl,
			'minjexdouze' => $miniajeuxxdouze,
			'minjerand' => $minjerand,
			'bestp' => $bestjoueur,
			'bestg' => $bestjeux,
			'ismobile' => $ismobile
		]);
		break;

		case 'videos':
		echo $twig->render('pages/selectvideo.html.twig', [
			'session' => $_SESSION,
			'route' => $route,
			'miniavid' => $miniavideo,
			'vidrandom' => $videorandomtroi,
			'vodday' => $vodday,
			'miniavidxdouze' => $miniavidxdouze,
			'ismobile' => $ismobile
		]);
		break;

		case 'videoselected':
			$videoUrl = recupvideo($_GET['videoId']);
			$videoUrl = $videoUrl->fetchAll();
		echo $twig->render('pages/video.html.twig', [
			'session' => $_SESSION,
			'route' => $route,
			'miniavid' => $miniavideo,
			'vidrandom' => $videorandomtroi,
			'urlVideo' => $videoUrl,
			'vodday' => $vodday,
			'ismobile' => $ismobile
		]);
		break;
		
		case 'creepyPasta':
			if(isset($_GET['histoireId'])){
				$histoireURL = recuphistoire($_GET['histoireId']);
				$histoireURL = $histoireURL->fetchAll();
				$histoireURL = $histoireURL[0];
				echo $twig->render('modals/bodyModalAjax.html.twig', [
					'session' => $_SESSION,
					'route' => $route,
					'Storyrandom' => $storyminia,
					'histoireURL' => $histoireURL,
					'ismobile' => $ismobile
				]);
			} else {
				echo $twig->render('pages/creepy.html.twig', [
					'session' => $_SESSION,
					'route' => $route,
					'Storyrandom' => $storyminia,
					'recuptoplecteur' => $recuptoplecteur,
					'recuptophistoire' => $recuptophistoire,
					'ismobile' => $ismobile
				]);
			}
			break;

			case 'chat':
			echo $twig->render('pages/chat.html.twig', [
				'session' => $_SESSION,
				'route' => $route,
				'recupmessage' => $recupmessage,
				'plusactifs' => $recuplesplusactifs,
				'plusaimees' => $recuplesplusaimees,
				'ismobile' => $ismobile
			]);
			break;

			case 'forum':
			echo $twig->render('pages/forum.html.twig', [
				'session' => $_SESSION,
				'route' => $route,
				'ismobile' => $ismobile
			]);
			break;
}

function register(){
	$success = false;
	$registerpseudo = htmlspecialchars($_GET['registerpseudo']);
	$registerpassword1 = htmlspecialchars($_GET['registerpassword1']);
	$registerpassword2 = htmlspecialchars($_GET['registerpassword2']);
	$registemail = htmlspecialchars($_GET['registemail']);
	$registeage = htmlspecialchars($_GET['registeage']);
	$gender = htmlspecialchars($_GET['gender']);
	$timiming = time();

	if (isset($registerpassword1) 
	&& isset($registemail)
	&& isset($registeage)
	&& isset($gender) ) { 
		if (strlen($registerpseudo) > 3 && strlen($registerpassword1) >= 6) {
			$hashedpass = password_hash($registerpassword1, PASSWORD_DEFAULT);
			insertuser($registerpseudo, $hashedpass, $registemail, $registeage, $gender, $timiming);
			$success = true;
		}
	}
	return $success;
}

$valuelike = "+1";
$valuedislike = "-1";
if(isset($_POST['idjeulike']) or isset($_POST['idjeudisl'])){
	$idjeulike = $_POST['idjeulike'];
	$idjeudislike = $_POST['idjeudisl'];
	$namefefefusxsece = $_SESSION['name'];
	likejeu($valuelike, $idjeulike);
	likejeu($valuedislike, $idjeudislike);
	addptsjeuxuser($valuelike, $namefefefusxsece);
}

if(isset($_POST['idvidlike']) or isset($_POST['idviddisl'])){
	$idvidlike = $_POST['idvidlike'];
	$idviddislike = $_POST['idviddisl'];
	$nameusxsece = $_SESSION['name'];
	videolike($valuelike, $idvidlike);
	videolike($valuedislike, $idviddislike);
	addptsviduser($valuelike, $nameusxsece);
}
if(isset($_POST['idhistlik']) or isset($_POST['idhistdislik'])){
	$histlike = $_POST['idhistlik'];
	$histdislike = $_POST['idhistdislik'];
	$nameussece = $_SESSION['name'];
	storylike($valuelike, $histlike);
	storylike($valuedislike, $histdislike);
	addptshistoir($valuelike, $nameussece);
}

//function pour donner des points aux gens qui regarde
if (isset($_POST['pluspoint'])){
	addptsviduser($valuelike, $_SESSION['name']);
	$_POST["pluspoint"] = "" ;
};
//function pour donner des points aux gens qui joue
if (isset($_POST['pluspointjeu'])){
	addptsjeuxuser($valuelike, $_SESSION['name']);
	$_POST['pluspointjeu'] = "" ;
};
//function pour donner des points aux gens qui chat
if (isset($_POST['pluspointchat'])){
	addptschatuser($valuelike, $_SESSION['name']);
	$_POST['pluspointchat'] = "" ;
};