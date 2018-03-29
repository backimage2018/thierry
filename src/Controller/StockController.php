<?php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Image;
use App\Form\ProductType;
use App\Entity\Stock;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


class StockController extends Controller
{
    
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function homeDashboard()
    {
        
        return $this->render('admin/dashboard.html.twig');
        
    }
    
    /**
     * @Route("/dashboard/eshop", name="dashboard-eshop")
     */
    public function eshopDashboard()
    {
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadProductsEshop();
        
        return $this->render('admin/stock-eshop.html.twig', array(
            'stock' => $stock));
        
    }
    
    /**
     * @Route("/dashboard/store", name="dashboard-store")
     */
    public function storeDashboard()
    {
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadProductsStore();
        
        return $this->render('admin/stock-store.html.twig', array(
            'stock' => $stock));
        
    }
    
    /**
     * @Route("/dashboard/product/add", name="product-add")
     */
    
    public function createProduct(Request $request, FileUploader $fileUploader) {
        
        $product = new Product();
        $image = new Image();
        
        
        $form = $this->createForm(ProductType::class, $product);
        
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            /* Upload du fichier sur le disque */
            
            $file = $product->getImage()->getUrl(); // Fichier physique
            $fileName = $fileUploader->upload($file); // Url du nom du fichier
            
            $image->setUrl($fileName); // On passe l'url (string) dans le l'objet Image
            $product->setImage($image); // On passe l'objet Image dans l'objet Product
            //   $image->setProduct($product); // On passe l'objet Product dans l'objet Image - Bi directional
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute('product-add');
            
        }
        
        return $this->render(
            'admin/create-product.html.twig',
            array('form_product' => $form->createView()));
    }
    
    
    /**
     * @Route("/dashboard/stock-alert", name="stock-alert")
     */
    public function alertStock()
    {
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadProductsInAlert();
        
             
        
        return $this->render('admin/stock-alert.html.twig', array('stock' => $stock));
        
    }
    
}