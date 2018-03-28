<?php
namespace App\Controller;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class NewsletterController extends Controller
{
    
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function newsletter(Request $request)
    {
        $email = $request->request->get('email'); // Or $email = $request->get('email');
        $newsletter = new Newsletter();
        $newsletter->setEmail($email);
       
        $em = $this->getDoctrine()->getManager();
        $em->persist($newsletter);
        $em->flush();
        
        $result = array (
            'message' => 'Vous êtes bien inscrit à la newsletter',
            'email'   => $newsletter->getEmail()
            
        );
        
        return $this->json($result);
    }
    
}