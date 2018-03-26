<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUsername('Merlin');
        $user->setPassword('Thierry13127');
        $user->setIsActive(true);
        $user->setEmail('f.thierry@gmail.com');
        $user->setSalt('');
        $user->setRoles('ROLE_USER');
        $em->persist($user);
        
        $em->flush();
        
        return new Response('Saved new product with id '.$user->getId());
    }
}
