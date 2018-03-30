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
        
                
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id_product ]);
        
        
        /* On test si la quantité demandé est > à la quantité restante en magasin*/
        
        if ($quantity > $product->getStock()->getEshopquantity()) {
            
            $result = 'plus de produit';
            
            return $this->json($result);
            
        } else {
            
            /* On soustrait la quantité demandé au stock du magasin */
            
            $product->getStock()->setEshopquantity($product->getStock()->getEshopquantity() - $quantity);
            
      /*      $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush(); */
            
        }
        
        /* Mettre à jour la table stock du magasin*/
        
        
        
        /*   test si le produit pour l'user est déjà présent dans le panier  */
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findOneBy([
            'product' => $id_product,
            'user' => $id_user,
        ]);
        

                if (!$caddie) {
                    
                    $caddie = new Caddie();
                    $caddie->setProduct($product);
                    $caddie->setUser($user);
                    
                 } else {
                    
                    $quantity = ($caddie->getQuantity() + $quantity);
                    
                 }
                    
                $caddie->setQuantity($quantity);
                $caddie->setTotal($product->getPrice() * $caddie->getQuantity());
        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($caddie);
        $em->flush();
        
     
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        

        $caddie = array (
            'items' => $caddie,
            'total-caddie' => $totalcaddie
        );
     
     
        return $this->json($caddie);
    }
    
    
    /**
    * @Route("/order-review/caddie")
    */
    public function updateProductInCaddie(Request $request, CaddieService $CaddieService)
    {
        
        $quantity = intval($request->request->get('quantity'));
        $id_product = $request->request->get('id');
        $id_user = $this->getUser()->getId();
        $user = $this->getUser();
        
        /* Récupère le produit à mettre à jour */
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findOneBy([
            'product' => $id_product,
            'user' => $id_user,
        ]);
        
                
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id_product ]);
        
        $caddie->setQuantity($quantity);
        $caddie->setTotal($product->getPrice() * $caddie->getQuantity());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($caddie);
        $em->flush();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
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
  
 
}


