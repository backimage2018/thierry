<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Entity\Caddie;


class SecurityController extends Controller

{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
                
        $error = $authUtils->getLastAuthenticationError();
        
        $lastUsername = $authUtils->getLastUsername();
        
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->loadUserByUsername($lastUsername);
        
        $caddie = [];
        $totalcaddie = NULL;
        
        return $this->render('security/login.html.twig', array(
            'totalcaddie' => $totalcaddie,
            'caddie' => $caddie,
            'last_username' => $lastUsername,
            'error'         => $error,
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