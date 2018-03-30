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
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadAllProducts();
        
        return $this->render('admin/index.html.twig', array(
            'stock' => $stock));
        
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
    
    /**
     * @Route("/dashboard/stock/add", name="stock-add")
     */
    public function updateStoreStock(Request $request)
    {
        
        $id_stock = $request->request->get('id');
        $quantityStore = $request->request->get('quantityStore');
        
        /* Récupère la ligne du stock à modifier */
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->findOneBy([
            'id' => $id_stock,
        ]);
        
        /* Addition avec la nouvelle quantité dans l'instance récupéré */
        
        $stock->setStorequantity(($stock->getStorequantity() + $quantityStore));
        
        /* On persiste le nouvelle objet dans la base */        
        $em = $this->getDoctrine()->getManager();
        $em->persist($stock);
        $em->flush();
        
        /* On récupére le stock en alerte */
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadProductsInAlert();
        
        return $this->json($stock);
        
    }
    
    
    /**
     * @Route("/dashboard/shop/add", name="shop-add")
     */
    public function updateShopStock(Request $request)
    {
        
        $id_stock = $request->request->get('id');
        $quantityShop = $request->request->get('quantityShop');
        
        /* Récupère la ligne du stock à modifier */
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->findOneBy([
            'id' => $id_stock,
        ]);
        
        // $test = $stock->getStorequantity();
        
        /* Vérifier si quantity Store n'est < à quantityShop */
        
        if ($quantityShop <= $stock->getStorequantity()) {
            
            $stock->setStorequantity($stock->getStorequantity() - $quantityShop);
            $stock->setEshopquantity($stock->getEshopquantity() + $quantityShop);
            
        } else {
            
            
            $stock = 'Stock insuffisant';
            
            return $this->json($stock);
            
        }
        
        /* On persiste le nouvelle objet dans la base */
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($stock);
        $em->flush();
        
        /* On récupére le stock en alerte */
        
        $stock = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->loadProductsInAlert();
        
        return $this->json($stock);
        
    }
    
}