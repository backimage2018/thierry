<?php 

require ('autoload.php');
$config = parse_ini_file('config.ini');

$username = $config['username'];
$password = $config['password'];
$host = $config['host'];
$port = $config['port'];
$charset = $config['charset'];
$dbname = $config['dbname'];


$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset";
$db = new PDO($dsn, $username, $password);

var_dump($db);


/*$perso1 = new Personnage();*/
/*$perso1->setNickname("Merlin");
$perso1->setLocation("Lyon");
$perso1->setPower(60);
$perso1->setExp(0);
$perso1->setDegat(50);*/

/*
$dao = new personnageDAO($db);
$perso = $dao->getPersonnageById(8);


$perso->setNickname('Léon');
$dao->updatePersonnagebyObj($perso);*/


/*$dao->updatePersonnagebyId(9);*/
/*$dao->addPersonnage($perso1);*/

/*var_dump($dao->getPersonnageById(7));*/


/*var_dump($dao->getAllPersonnage());*/

/*var_dump($dao->getPersonnageById(8));*/

/* var_dump($dao->getPersonnageExistByName('merlin'));

var_dump($dao->getPersonnageExistByName('toto'));

var_dump($dao->getPersonnageExistByName('gandalf')); */


/*$dao->deletePersonnageById(5);*/

/* $dao->deletePersonnageByNickname('Merlin');*/
/*
$sql = "SELECT * FROM personnage";
$result = $db->query($sql); // Exécute une requête SQL, retourne un jeu de résultats en tant qu'objet PDOStatement*/



?>