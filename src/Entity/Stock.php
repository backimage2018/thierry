<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $eshopquantity;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $storequantity;
    
    /**
     * @ORM\OneToOne (targetEntity="App\Entity\Product", mappedBy="stock", cascade={"persist"})
     */
    private $product;
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEshopquantity()
    {
        return $this->eshopquantity;
    }

    /**
     * @return mixed
     */
    public function getStorequantity()
    {
        return $this->storequantity;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $eshopquantity
     */
    public function setEshopquantity($eshopquantity)
    {
        $this->eshopquantity = $eshopquantity;
    }

    /**
     * @param mixed $storequantity
     */
    public function setStorequantity($storequantity)
    {
        $this->storequantity = $storequantity;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    
}
