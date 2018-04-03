<?php

namespace App\Controller;

use App\Entity\Caddie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CaddieService;


class ViewcartController extends Controller
{
    /**
     * @Route("/viewcart")
     */
    
    public function viewcart(CaddieService $CaddieService) {
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render("viewcart.html.twig", array (
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
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