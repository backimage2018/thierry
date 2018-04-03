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
     * @Route("/caddie/add", name="caddie")
     */
    public function addProductInCaddie(Request $request, CaddieService $CaddieService)
    {
        
        $quantity = intval($request->request->get('quantity'));
        $id_product = $request->request->get('id');
        $id_user = $this->getUser()->getId();
        $user = $this->getUser();
        
        
        /* On récupère en base de donné le product */
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id_product ]);
        
        
        /* Gestion du Stock : On test si la quantité demandé est > à la quantité restante en magasin*/
        
        if ($quantity > $product->getStock()->getEshopquantity()) {
            
            $result = 'plus de produit';
            
            return $this->json($result);
            
        } else {
            
            /* On soustrait la quantité demandé au stock du magasin */
            
            $product->getStock()->setEshopquantity($product->getStock()->getEshopquantity() - $quantity);
            
        }
        

        /*   Test si le produit pour l'user est déjà présent dans le panier (mise à jour ou nouvelle quantité)  */
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findOneBy([
            'product' => $id_product,
            'user' => $id_user,
        ]);
        
        
        /*   Si le produit n'est pas présent, on instancie un nouvel objet caddie
         *   sinon on mets à jour la quantité
         * */
        
        if (!$caddie) {
            
            $caddie = new Caddie();
            $caddie->setProduct($product);
            $caddie->setUser($user);
            
        } else {
            
            $quantity = ($caddie->getQuantity() + $quantity);
            
        }
        
        $caddie->setQuantity($quantity);
        $caddie->setTotal($product->getPrice() * $caddie->getQuantity()); // calcul du nouveau prix
        
        
        
        /* On persiste caddie et  */
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($caddie);
        $em->flush();
        
        
        /* On récupère le nouveau caddie mis à jour */
        
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
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id_product ]);
        
        /* Gestion du Stock : On test si la quantité demandé est > à la quantité restante en magasin*/
        
        if ($quantity > $product->getStock()->getEshopquantity()) {
            
            $this->addFlash(
                
                'warning',
                'Rupture de stock pour ce produit'
                );
            
           // return $this->json($result);
            
        } else {
            
            /* On soustrait la quantité demandé au stock du magasin */
            
            $product->getStock()->setEshopquantity($product->getStock()->getEshopquantity() - $quantity);
            
            $this->addFlash(
                
                'success',
                'Caddie mis à jour'
                );
            
            /* Récupère le produit à mettre à jour */
            
            $caddie = $this->getDoctrine()
            ->getRepository(Caddie::class)
            ->findOneBy([
                'product' => $id_product,
                'user' => $id_user,
            ]);
            
            $caddie->setQuantity($quantity);
            $caddie->setTotal($product->getPrice() * $caddie->getQuantity());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($caddie);
            $em->flush();
            
        }
        
       
        
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
     * @Route("/caddie/deleted", name="caddie-deleted")
     */
    public function deletedProductInCaddie(Request $request, CaddieService $CaddieService)
    {
        $id_product = $request->request->get('id');
        $id_user = $this->getUser()->getId();
        
        /* Récupère le produit à supprimer */
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findOneBy([
            'product' => $id_product,
            'user' => $id_user,
        ]);
        
        /* Mise à jour du stock */
        $quantityCaddie = $caddie->getQuantity();
        
        $caddie->getProduct()
        ->getStock()
        ->setEshopquantity($caddie->getProduct()->getStock()->getEshopquantity() + $quantityCaddie);
        
        /* Persist le nouveau caddie et relation */
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($caddie);
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
    
}


