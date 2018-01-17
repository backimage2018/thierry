<?php 

class Magicien extends Personnage {
    
    private $magie;  // puissance du magicien
    
    /**
     * @return mixed
     */
    public function getMagie()
    {
        return $this->magie;
    }
    
    /**
     * @param mixed $magie
     */
    public function setMagie($magie)
    {
        $this->magie = $magie;
    }
    
    
    public function lancerUnSort(Personnage $perso) {
        
        $perso->recevoirDegats($this->magie);
        $this->gagnerExperience();
        
    }
    
    public function gagnerExperience() {
        
        parent::gagnerExperience();
        
        if ($this->magie < 100) {
            
            $this->magie += 10;
        }
    }
    
    
    
    
    
}





?>