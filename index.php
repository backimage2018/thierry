<?php 

require 'autoload.php';
$config = parse_ini_file('config.ini');

$username = $config['username'];
$password = $config['password'];
$host = $config['host'];
$port = $config['port'];
$charset = $config['charset'];
$dbname = $config['dbname'];
$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset";

$db = new PDO($dsn, $username, $password);
$dao = new personnageDao($db);
$personnages = $dao->getAllPersonnage();

if (!isset($_POST['nickname'])) {

$name = null;
$power = null;
$location = null;

}

            /*  Fonction recherche  */


if ( isset($_POST['nickname'] )) {


    if ( isset($_POST['search']) ) {
       $existPerso = $dao->getPersonnageExistByName($_POST['nickname']);
       if( $existPerso ) {
           $displayPerso = $dao->getPersonnageByName($_POST['nickname']);
                  
           $name = $displayPerso->getNickname();
           $power = $displayPerso->getPower();
           $location = $displayPerso->getLocation();
           
       } else {
           
           echo 'Ce personnage n\'existe pas dans la base';
           $name = $_POST['nickname'];
           $power = null;
           $location = null;
           
       }
          
    }
    
        /*  Fonction création  */
    
if( isset($_POST['save']) ){
  
      
      
      if(!$dao->getPersonnageExistByName($_POST['nickname'])) {
          
           $insertPerso = new Personnage();
           $insertPerso->setNickname($_POST['nickname']);
           $insertPerso->setPower($_POST['power']);
           $insertPerso->setLocation($_POST['location']);
           $dao->addPersonnage($insertPerso);
           header('Location: index.php');
      
      } else {
          
            echo 'Ce personnage existe déjà dans la base';
            $name = $_POST['nickname'];
            $power = $_POST['power'];
            $location = $_POST['location'];
            
             }
     }
     
         /*  Fonction delete  */
     
if( isset($_POST['delete']) ){
       if( $dao->getPersonnageExistByName($_POST['nickname']) )
        
            {
                $dao->deletePersonnageByNickname($_POST['nickname']);
                header('Location: index.php');  
                
            } else {
                
                echo 'Ce personnage n\'existe pas dans la base';
                $name = null;
                $power = null;
                $location = null;
                
            }
     }
     
        /*  Fonction update  */
     
if( isset($_POST['update']) ){
         
        if ($dao->getPersonnageExistByName($_POST['nickname']))
        
        {
            
            $updatePerso = $dao->getPersonnageByName($_POST['nickname']);
            
            $updatePerso->setNickname($_POST['nickname']);
            $updatePerso->setPower($_POST['power']);
            $updatePerso->setLocation($_POST['location']);
            $dao->updatePersonnagebyObj($updatePerso);
            header('Location: index.php');
             
         } else { 
             echo 'Ce personnage n\'existe pas dans la base';
             $name = $_POST['nickname'];
             $power = $_POST['power'];
             $location = $_POST['location'];
             
         }
     }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Personnages</title>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
</head>
  
<body>


   
   <div class="container">
   
   <h2>Liste des personnages</h2>
       
       <table class="table table-striped">
    <thead>
      <tr>
        <th>Identifiant</th>
        <th>Surnom</th>
        <th>Force</th>
        <th>Expérience</th>
        <th>Dégat</th>
        <th>Localisation</th>
        
 
      </tr>
    </thead>
    <tbody>
        
        <?php
       foreach ($personnages as $personnage) {?>
        
        <tr><td><?php echo $personnage->getId();?></td>
        <td><?php echo $personnage->getNickname();?></td>    
        <td><?php echo $personnage->getPower();?></td>
        <td><?php echo $personnage->getExp();?></td>
        <td><?php echo $personnage->getdegat();?></td>
        <td><?php echo $personnage->getLocation();?></td></tr>
  
     <?php }
        
        ?>
     
    </tbody>
  </table>
       
       
   </div>
   
 <div class="container">

<form class="form-horizontal" method="POST" action="">
  <div class="form-group">
    <label class="control-label col-sm-2">Nom :</label>
    <div class="col-sm-4">
      <input type="text" value="<?php echo $name ?>" name="nickname" class="form-control" id="nickname">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2">Force :</label>
    <div class="col-sm-4">
      <input type="text" value="<?php echo $power ?>" name="power" class="form-control" id="power">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2">Localisation :</label>
    <div class="col-sm-4">
      <input type="text" value="<?php echo $location ?>" name="location" class="form-control" id="location">
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="save" value="Save" class="btn btn-primary">
      <input type="submit" name="search" value="Search" class="btn btn-success">
      <input type="submit" name="update" value="Update" class="btn btn-warning">
      <input type="submit" name="delete" value="Delete" class="btn btn-danger">
    </div>
  </div>
</form>
  </div> 
</body>
</html>