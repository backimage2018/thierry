<?php
namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\CaddieService;
use App\Entity\Caddie;


class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, CaddieService $CaddieService)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles(array('ROLE_USER'));
            
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            
            return $this->redirectToRoute('index');
        }
        
        /* Chargement du caddie en db */
        
        $id_user = $this->getUser();
        
        $caddie = $this->getDoctrine()
        ->getRepository(Caddie::class)
        ->loadProductInCaddie($id_user);
        
        $totalcaddie = $CaddieService->totalCaddie($caddie);
        
        return $this->render(
            'account.html.twig',
            array('form' => $form->createView(),'categories' => Data::CATEGORIES,
                'totalcaddie' => $totalcaddie,
                'caddie' => $caddie,
                'nav_categories' => Data::NAV_CATEGORIES,
                'links_footer_my_account' => Data::LINKS_FOOTER_MY_ACCOUNT,
                'links_footer_customer_service' => Data::LINKS_FOOTER_CUSTOMER_SERVICE,
                'links_top_nav' => Data::LINKS_TOP_NAV,
                'languages' => Data::LANGUAGES,
                'changes' => Data::CHANGES,
                'socials_networks' => Data::SOCIALS_NETWORKS
                
            )
            );
    }
}