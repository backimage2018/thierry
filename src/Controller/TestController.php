<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class TestController extends Controller
{
    /**
     * @Route("/test/lazy", name="test")
     */
    public function testLazy(Request $request)
    {
        $rep = $this->getDoctrine()->getRepository(Product::class);
        $deal= $rep->find(1);
        return new Response('done');
    }
}
