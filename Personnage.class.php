<?php 


class Personnage {
    
    private $id;
    private $nickname;
    
    /**
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /*public function __construct() {
        
    }*/
    
     
    /* public function __construct($nickname)
    {
        $this->nickname = $nickname;
    } */
    
    
    private $power = 50;
    private $exp = 0;
    private $location = "";
    private $degat = 0;
    
    
    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return number
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * @param number $exp
     */
    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    /**
     * @return number
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return number
     */
    public function getDegat()
    {
        return $this->degat;
    }

    /**
     * @param number $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param number $degat
     */
    public function setDegat($degat)
    {
        $this->degat = $degat;
    }

    public function frapper($persoAFrapper)
    {
        $persoAFrapper->degat = $this->power + $persoAFrapper->degat;
        $this->experience();
    }
    
    public function experience()
    {
        $this->exp = $this->exp + 1;
    }
    
    public function parler()
    {
        echo 'Voici mon nom : ' . $this->getnickname() . "<br>";
        echo 'Voici ma force : ' . $this->getPower() . '<br>';
        echo 'Voici mon expérience : ' . $this->getExp() . '<br>';
        echo 'Voici ma localisation : ' . $this->getLocation() . '<br>';
        echo 'Dégats subit : ' . $this->getDegat() . '<br>';
        
        echo '________________________________<br><br>';
    }
    
    public function hydrate($ligneFetch)
    {
        foreach ($ligneFetch as $key=>$value) {
            $methodname = 'set'.ucfirst($key);
            
            //var_dump($methodname);
            if (method_exists($this, $methodname)) {
                $this->$methodname($value);
 
            }
            
        }
        
    }
    
   
}



?>


