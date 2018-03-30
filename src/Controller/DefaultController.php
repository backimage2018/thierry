<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Service\CaddieService;
use App\Entity\Caddie;


class DefaultController extends Controller {
    
    /**
     * @Route("/bootstrap")
     */
    
    public function bootstrap() {
        
        return $this->render("bootstrap_base_layout.html.twig");
        
    }
    
        
    /**
     * @Route("/products", name="products")
     */
    
    public function products() {
            
        $products = '[{
            "id" : "1",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "reduct" : "-20%",
            "new" : "New",
            "url" : "./img/product01.jpg"
        },
            
        {
            "id" : "2",
            "name" :"Montre Homme",
            "price" : "55.50",
            "url" : "./img/product02.jpg"
        },
            
        {
            "id" : "3",
            "name" : "Portefeuille",
            "price" : "25.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" :"./img/product03.jpg"
        },
            
        {
            "id" : "4",
            "name" : "Chaussure Bleu",
            "price" : "85.50",
            "new" : "New",
            "url" : "./img/product04.jpg"
        },
            
        {
            "id" : "5",
            "name" : "Botte Femme",
            "price" : "115.50",
            "new" : "New",
            "url" : "./img/product05.jpg"
        },
            
        {
            "id" : "6",
            "name" : "Sac Cuir Femme",
            "price" : "165.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product06.jpg"
        },
            
        {
            "id" : "7",
            "name" : "Sac Cuir Marron",
            "price" : "125.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product07.jpg"
        },
            
        {
            "id" : "8",
            "name" : "Ceinture Marron",
            "price" : "65.50",
            "url" : "./img/product08.jpg"
        },
            
        {
            "id" : "9",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "reduct" : "-20%",
            "url" :"./img/product01.jpg"
        }]';
        
        $products = json_decode($products);
        
        return $this->render("products.html.twig", array ('products' => $products,
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
     * @Route("/blank")
     */
    
    public function blank(CaddieService $CaddieService) {
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->findBy(['user' => $id_user]);
        
        $totalCaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("blank.html.twig", array ('categories' => Data::CATEGORIES,
            'total_caddie' => $totalCaddie,
            'caddie' => $caddie,
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
     * @Route("/account")
     */
    
    public function account(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("account.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/store", name="store")
     */
    
    public function store(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("store.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/faq")
     */
    
    public function faq(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("faq.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/whishlist")
     */
    
    public function whishlist(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("whishlist.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/about-us")
     */
    
    public function aboutUs(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("about-us.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/shiping-return")
     */
    
    public function shipingReturn(CaddieService $CaddieService) {
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("shiping-return.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/shiping-guide")
     */
    
        public function shipingGuide(CaddieService $CaddieService) {
        
            /* Chargement du caddie en db */
            
            $id_user = $this->getUser();
            
            $caddie = $this->getDoctrine()
            ->getRepository(Caddie::class)
            ->loadProductInCaddie($id_user);
            
            $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        
        return $this->render("shiping-guide.html.twig", array ('categories' => Data::CATEGORIES,
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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
     * @Route("/test-twig")
     */
  
    public function testTwig() {
        
        $user = new \stdClass();
        $user->nickname = "John";
        $user->mail = "johntest@gmail.com";
        $user->phone = "061223455678";
        
        $notes = array (array("nom"  => "Paul",
                              "note" => 15,
                              "classe" => "CE1"),
                        array("nom"  => "Tom",
                              "note" => 18,
                              "classe" => "CM2"),
                         array("nom"  => "Maël",
                               "note" => 19,
                                "classe" => "CE2"),
           
        );
        
        $products = '[{
            "id" : "1",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "url" : "./img/product01.jpg"
        },
        
        {
            "id" : "2",
            "name" :"Montre Homme",
            "price" : "55.50",
            "url" : "./img/product02.jpg"
        },
        
        {
            "id" : "3",
            "name" : "Portefeuille",
            "price" : "25.50",
            "url" :"./img/product03.jpg"
        },
        
        {
            "id" : "4",
            "name" : "Chaussure Bleu",
            "price" : "85.50",
            "url" : "./img/product04.jpg"
        },
        
        {
            "id" : "5",
            "name" : "Botte Femme",
            "price" : "115.50",
            "url" : "./img/product05.jpg"
        },
        
        {
            "id" : "6",
            "name" : "Sac Cuir Femme",
            "price" : "165.50",
            "url" : "./img/product06.jpg"
        },
        
        {
            "id" : "7",
            "name" : "Sac Cuir Marron",
            "price" : "125.50",
            "url" : "./img/product07.jpg"
        },
        
        {
            "id" : "8",
            "name" : "Ceinture Marron",
            "price" : "65.50",
            "url" : "./img/product08.jpg"
        },
        
        {
            "id" : "9",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "url" :"./img/product01.jpg"
        }]';
       
        $products = json_decode($products, true);
        
        return $this->render("testwig.html.twig", array ('links_footer_my_account' => self::LINKS_FOOTER_MY_ACCOUNT) );
        
    }
}

