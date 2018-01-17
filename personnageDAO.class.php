<?php 


class personnageDAO {
    
    private $pdo;
    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function deletePersonnageById($persoId)
    {
        $sql = 'DELETE FROM personnage WHERE id = :id';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->bindValue(':id', $persoId, PDO::PARAM_INT);
        $prepareStatement->execute();
    }
    
    public function deletePersonnageByNickname($nickname)
    {
        $sql = 'DELETE FROM personnage WHERE nickname = :nickname';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $prepareStatement->execute();
    }
    
    public function addPersonnage(Personnage $personnage)
    {
        
        var_dump($personnage);
        $sql = 'INSERT INTO personnage (nickname, power, degat, exp, location) VALUES (:nkname, :fp, :dgt, :xp, :loc)';
        $prepareStatement = $this->getPdo()->prepare($sql);
        
     
        $prepareStatement->bindValue(':nkname', $personnage->getNickname());
        $prepareStatement->bindValue(':fp', $personnage->getPower());
        $prepareStatement->bindValue(':dgt', $personnage->getDegat());
        $prepareStatement->bindValue(':xp', $personnage->getExp());
        $prepareStatement->bindValue(':loc', $personnage->getLocation());
        $prepareStatement->execute();
        
        $lastId = $this->getPdo()->lastInsertId();
        $personnage->setId($lastId);
        
    }
    
    public function getPersonnageById($persoId)
    {
        $sql = 'SELECT * FROM personnage WHERE id = :id';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->bindValue(':id', $persoId, PDO::PARAM_INT);
        $prepareStatement->execute();
        $result = $prepareStatement->fetch (PDO::FETCH_ASSOC);
        
        $loadPerso = new Personnage();
        var_dump($result);
        $loadPerso->hydrate($result);
        
        return $loadPerso;
    }
    
    public function getPersonnageByName($nickname)
    
    {
        $sql = 'SELECT * FROM personnage WHERE nickname = :nickname';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $prepareStatement->execute();
        $result = $prepareStatement->fetch (PDO::FETCH_ASSOC);
        
        $loadPerso = new Personnage();
        $loadPerso->hydrate($result);
        
        return $loadPerso;
        
    }
    
    public function getAllPersonnage()
    {
        $sql = 'SELECT * FROM personnage';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->execute();
        $result = $prepareStatement->fetchall (PDO::FETCH_ASSOC);
           
        $loadPersonnages = [];
        foreach($result as $row) {
            $loadPerso = new Personnage();
            $loadPerso->hydrate($row);
            $loadPersonnages[] = $loadPerso;
            
        }
 
        return $loadPersonnages;
    }
    
    public function getPersonnageExistByName($nickname)
    
    {
        $sql = 'SELECT * FROM personnage WHERE nickname = :nickname';
        $prepareStatement = $this->getPdo()->prepare($sql);
        $prepareStatement->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $prepareStatement->execute();
        
        $result = $prepareStatement->fetch (PDO::FETCH_ASSOC);
        
        if ($result) {
            
            return TRUE;
            
        } else {
            
            return FALSE;
        }
        
       
    }
         
    public function updatePersonnagebyObj(Personnage $personnage)
    {
       
            $sql = 'UPDATE personnage SET nickname=:nkname, power=:fp, degat=:dgt, exp=:xp, location=:loc WHERE id = :id';
            $prepareStatement = $this->getPdo()->prepare($sql);
            $prepareStatement->bindValue(':id', $personnage->getId(), PDO::PARAM_INT);
            $prepareStatement->bindValue(':nkname', $personnage->getNickname(), PDO::PARAM_STR);
            $prepareStatement->bindValue(':fp', $personnage->getPower(), PDO::PARAM_INT);
            $prepareStatement->bindValue(':dgt', $personnage->getDegat(), PDO::PARAM_INT);
            $prepareStatement->bindValue(':xp', $personnage->getExp(), PDO::PARAM_INT);
            $prepareStatement->bindValue(':loc', $personnage->getLocation(), PDO::PARAM_STR);
            $prepareStatement->execute();
                   
    }
    
}


?>