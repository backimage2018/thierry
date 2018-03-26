<?php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Image;
use App\Entity\Caddie;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use App\Service\CaddieService;

class ProductController extends Controller
{
    
    /**
     * @Route("/product/deleted/{id}", requirements={"id" = "\d+"}, name="deleted")
     */
    
    public function deletedProduct(Request $request, $id) {
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->find($id);
        
        $entityManager = $this->getDoctrine()->getManagerForClass(Product::class);
        $entityManager->remove($product);
        $entityManager->flush();
        
        return $this->render("testwig.html.twig", array('product' => $product));
        
    }
    
    /**
     * @Route("/", name="index")
     */
    
    public function index(CaddieService $CaddieService) {
        
        $lastproducts = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findBy(['new' => 'New']);
        
        $pickedproducts = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findRandomProducts();
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("index.html.twig", array ('dealproducts' => json_decode(Data::DEALPRODUCTS),
            'total_caddie' => $totalCaddie,
            'caddie' => $caddie,
            'pickedproducts' => $pickedproducts,
            'lastproducts' => $lastproducts,
            'categories' => Data::CATEGORIES,
            'nav_categories' => Data::NAV_CATEGORIES,
            'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
            'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
            'links_top_nav' => Data::LINKS_TOP_NAV,
            'languages' => Data::LANGUAGES,
            'changes' => Data::CHANGES,
            'socials_networks' => Data::SOCIALS_NETWORKS
            
        ));
        
    }
    
    /**
     * @Route("/admin/add", name="admin")
     */
    
    public function registerAction(Request $request, FileUploader $fileUploader, CaddieService $CaddieService) {
        
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
       
            return $this->redirectToRoute('admin');
        
        }
        
        return $this->render(
            'admin.html.twig',  array('form_product' => $form->createView(),
            'categories' => Data::CATEGORIES,
            'nav_categories' => Data::NAV_CATEGORIES,
            'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
            'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
            'links_top_nav' => Data::LINKS_TOP_NAV,
            'languages' => Data::LANGUAGES,
            'changes' => Data::CHANGES,
            'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
    }
    
        
    /**
     * @Route("/admin/{id}", requirements={"id" = "\d+"}, name="update" )
     */
    
    public function updateProduct(Request $request, $id, FileUploader $fileUploader, CaddieService $CaddieService) {
        
        $param = [];
   
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->find($id);
        
        $fileName = $product->getImage()->getUrl(); // On récupère l'url (string) de la DB, exemple : product04.jpg
        
        $file = new File($this->getParameter('img_directory').'/'.$fileName); // On crée le fichier 'physique'
        $product->getImage()->setUrl($file); // Objet image dans l'objet Product
        
        $param["product"] = $product;
        // $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
               
        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $product->getImage()->getUrl(); // Fichier physique
            $fileName = $fileUploader->upload($file); // Url du nom du fichier
            
            $product->getImage()->setUrl($fileName);
                       
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute('update', array('id' => $id));
            
        }
        
        return $this->render(
            'admin.html.twig',  array('form_product' => $form->createView(),
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
    }
    
    /**
     * @Route("/product/{id}", requirements={"id" = "\d+"} )
     */
    
    public function productPage($id, CaddieService $CaddieService) {
        
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findOneBy(['id' => $id ]);
        
        $product->getReviews()->toArray();
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("product-page.html.twig", array (
            'total_caddie' => $totalCaddie,
            'caddie' => $caddie,
            'product' => $product,
            'reviews' => Data::REVIEWS,
            'categories' => Data::CATEGORIES,
            'nav_categories' => Data::NAV_CATEGORIES,
            'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
            'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
            'links_top_nav' => Data::LINKS_TOP_NAV,
            'languages' => Data::LANGUAGES,
            'changes' => Data::CHANGES,
            'socials_networks' => Data::SOCIALS_NETWORKS
        ));
        
    }
    
    /**
     * @Route("/products/all", name="productsall")
     */
    
    public function getAllProduct(CaddieService $CaddieService)
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();
        
        if (!$products) {
            throw $this->createNotFoundException(
                'No product found'
                );
        }
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
                'products.html.twig',  array(
                'total_caddie' => $totalCaddie,
                'caddie' => $caddie,
                'products' => $products,
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
    }
    
    /**
     * @Route("/products/genre/{genre}")
     */
    public function getGenreProduct($genre, CaddieService $CaddieService)
    {
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->loadProductsByGenre($genre);
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
                'products.html.twig',  array(
                'total_caddie' => $totalCaddie,
                'caddie' => $caddie,
                'products' => $products,
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
        
    }
    
    /**
     * @Route("/products/{category}")
     */
    public function getProductsByCategory($category, CaddieService $CaddieService)
    {
        $category = (explode('-', $category));
        
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->loadProductsByCategory($category[0], $category[1]);
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
            'products.html.twig',  array(
                'total_caddie' => $totalCaddie,
                'caddie' => $caddie,
                'products' => $products,
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
    }
    
    /**
     * @Route("/Consumer-Electronics")
     */
    public function getProductsConsumer(CaddieService $CaddieService)
    {
                
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findBy(['category' => 'Consumer Electronics']);
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
                'products.html.twig',  array(
                'total_caddie' => $totalCaddie,
                'caddie' => $caddie,
                'products' => $products,
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
    }
    
    /**
     * @Route("/products/clothing/{genre}")
     */
    public function getClothingByGenre($genre, CaddieService $CaddieService)
    {
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->loadClothingByGenre($genre);
        
        $id_user = $this->getUser();
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
            'products.html.twig',  array(
                'total_caddie' => $totalCaddie,
                'caddie' => $caddie,
                'products' => $products,
                'categories' => Data::CATEGORIES,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            ));
        
    }
}