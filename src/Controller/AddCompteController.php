<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CompteType;
use App\Entity\Participant;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AddCompteController extends AbstractController
{
    /**
     * @Route("/addCompte", name="addCompte")
     */
    public function addCompte(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $unParticipant=new Participant();
        $form = $this->createForm(CompteType::class, $unParticipant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $unParticipant->setPassword( 
                password_hash($unParticipant->getPassword(),PASSWORD_BCRYPT)
            );
            $em->persist($unParticipant);
            $em->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render('addCompte/index.html.twig', ['monForm' => $form->createView()]);
    }
}
