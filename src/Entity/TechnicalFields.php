<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


trait TechnicalFields {
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userCreation;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userDeleted;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeleted;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $deleted;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $useModif;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModif;
    
    /**
     * @param mixed $userCreation
     */
    public function setUserCreation($userCreation)
    {
        $this->userCreation = $userCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @param mixed $userDeleted
     */
    public function setUserDeleted($userDeleted)
    {
        $this->userDeleted = $userDeleted;
    }

    /**
     * @param mixed $dateDeleted
     */
    public function setDateDeleted($dateDeleted)
    {
        $this->dateDeleted = $dateDeleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setdeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @param mixed $useModif
     */
    public function setUseModif($useModif)
    {
        $this->useModif = $useModif;
    }

    /**
     * @param mixed $dateModif
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->deleted = 0;
        $this->dateCreation = new \DateTime("now");
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->dateModif = new \DateTime("now");
    }
    
    /**
     * @ORM\PreRemove
     */
    public function onPreRemove()
    {
       // $this->dateDeleted = new \DateTime("now");
    }
      
    
    
}