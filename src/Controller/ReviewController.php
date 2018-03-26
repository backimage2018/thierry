<?php

namespace App\Controller;

use App\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\PDOException;

class ReviewController extends Controller
{
    /**
     * @Route("/review", name="review")
     */
    public function review(Request $request)
    {   
        
        $id = $request->request->get('id');
        $username = $request->request->get('username');
        $email = $request->request->get('email');
        $comment = $request->request->get('comment');
        $rating = $request->request->get('rating');
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->find($id);
        
        $review = new Review();
        $review->setUsername($username);
        $review->setEmail($email);
        $review->setComment($comment);
        $review->setNote($rating);
        $review->setDate(new \DateTime("now"));
        
        $product->getReviews()[] = $review;
        $review->setProduct($product);
       
        try {
            
            $entityManager = $this->getDoctrine()->getManagerForClass(Product::class);
            $entityManager->flush();
            $entityManager->persist($product);
            
            $result = "Votre commentaire a bien été pris en compte";
        
            } catch (PDOException $Exception) {
                
                $result = $Exception->getMessage();
                
            };
        
        return new Response($result);
        
    }
}
