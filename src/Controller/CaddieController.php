<?php
namespace App\Controller;

use App\Entity\Caddie;
use App\Entity\User;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\CaddieService;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class CaddieController extends Controller
{
    
    /**
     * @Route("/caddie", name="caddie")
     */
    public function addProductInCaddie(Request $request, CaddieService $CaddieService)
    {
               
        $quantity = intval($request->request->get('quantity'));
        $id_product = $request->request->get('id');
        $id_user = $this->getUser()->getId();
        $user = $this->getUser();
        
   /*   test si le produit pour l'user est déjà présent dans le panier  */
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findOneBy([
            'product' => $id_product,
            'user' => $id_user,
        ]);
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id_product ]);
        
        if (!$caddie) {
            
            $caddie = new Caddie();
            
         } else {
            
            $quantity = ($caddie->getQuantity() + $quantity);
            
         }
            
        $caddie->setQuantity($quantity);
        $caddie->setTotal($product->getPrice() * $caddie->getQuantity());
        $caddie->setProduct($product);
        $caddie->setUser($user);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($caddie);
        $em->flush();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
      //  $totalCaddie = $CaddieService->totalCaddie($caddie);
        
      //  $caddie['totalcaddie'] = $totalCaddie;
        
        $caddie['totalcaddie'] = $CaddieService->totalCaddie($caddie);
        
        
        $encoders = new JsonEncoder();
        $normalizers = new ObjectNormalizer();
        $normalizers->setCircularReferenceHandler(function($object) {
            return $object;
        });
        $serializer = new Serializer(array($normalizers), array($encoders));
        
        $caddie = $serializer->serialize($caddie, 'json');
        
        return new Response($caddie);
}
    
    /**
     * @Route("/get/caddie", name="get_caddie")
     */
    public function getCaddieByUser()
    {
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $encoders = new JsonEncoder();
        $normalizers = new ObjectNormalizer();
        $normalizers->setCircularReferenceHandler(function($object) {
            return $object;
        });
            $serializer = new Serializer(array($normalizers), array($encoders));
            
            $caddie = $serializer->serialize($caddie, 'json');
        
        return new Response(dump($caddie));
        
    }
   
   
    /**
     * @Route("/userlog", name="isUserLoggedIn")
     */
    public function isUserLoggedIn()
    {
        
        if (!$this->getUser()) {
            
            $message = 'Merci de vous logger';
            
        } else {
            
            $message = 'Ok';
            
        }
        
        
        return $this->json([
            'message' => $message
        ]);
        
    }
    
  
}


