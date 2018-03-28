<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $price;
    
    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $oldprice;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
          
    /**
     * @ORM\Column(type="string", length=128)
     */
    private $color;
    
    /**
     * @ORM\Column(type="string", length=16)
     */
    private $size;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $availability;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\OneToOne (targetEntity="App\Entity\Image", cascade={"persist"})
     */
    private $image;
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $reduction;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $new;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $collection;
    
    /**
     * @ORM\Column(type="string", length=32)
     */
    private $genre;
    
    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Review", mappedBy="product", cascade={"persist"})
     */
    private $reviews;
    
    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Caddie", mappedBy="product", cascade={"persist"})
     */
    private $caddies;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;
    
    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->caddies = new ArrayCollection();
    }
        
    use TechnicalFields;
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCaddies()
    {
        return $this->caddies;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $caddies
     */
    public function setCaddies($caddies)
    {
        $this->caddies = $caddies;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getOldprice()
    {
        return $this->oldprice;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * @return mixed
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $oldprice
     */
    public function setOldprice($oldprice)
    {
        $this->oldprice = $oldprice;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param mixed $availability
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $reduction
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }

    /**
     * @param mixed $new
     */
    public function setNew($new)
    {
        $this->new = $new;
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
   
}
