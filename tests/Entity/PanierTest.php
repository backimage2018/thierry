<?php
namespace App\Tests\Entity;

use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class PanierTest extends TestCase
{
    
    public function testAdd()
    {
        $panier = new Panier();
        $result = $panier->add(30, 12);
        
        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
    
}