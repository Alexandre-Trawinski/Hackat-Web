<?php

namespace App\Controller;

use App\Entity\Hackathon;
use App\Form\CompteType;
use App\Entity\Participant;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Inscriptionhackathon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HackathonRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/liste", name="liste")
     */

    public function AccesListe(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $lesHackathons = $repository->trierParDate();
        $lesVilles = $repository->getVilleHackathon();
        return $this->render('home/liste.html.twig', [
            'listeHackathons' => $lesHackathons, 'listeVilles' => $lesVilles
        ]);
    }

    /**
     * @Route("/liste/{id}", name="hackathon", requirements={"id"="\d+"})
     */

    public function afficherDetails($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $repo = $this->getDoctrine()->getRepository(Inscriptionhackathon::class);
        $unHackathon = $repository->find($id);
        $lesInscriptions = $repo->findBy(['idhackathon' => $id]);
        $nbInscriptions = count($lesInscriptions);
        return $this->render('home/hackathon.html.twig', [
            'unHackathon' => $unHackathon, 'nbInscriptions' => $nbInscriptions
        ]);
    }

    /**
     * @Route("/liste/{ville}", name="ListeHackathonsByVille")
     */
    public function ListeHackathonsByVille($ville): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $listeVilles = $repository->getVilleHackathon();
        $listeHackathons = $repository->findBy(['ville' => $ville]);
        return $this->render('home/liste.html.twig', ['listeHackathons' => $listeHackathons, 'listeVilles' => $listeVilles]);
    }

    /**
     *  @Route("/login", name="login")
     */
    public function Connexion(): Response
    {
        return $this->render('home/login.html.twig');
    }

    /**
     * @Route("/addCompte", name="addCompte")
     */
    public function addCompte(Request $request): Response
    {
        $unParticipant=new Participant();
        $form = $this->createForm(CompteType::class, $unParticipant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unParticipant);
            $em->flush();
            return $this->redirectToRoute('login');
        }
        return $this->render('addCompte/index.html.twig', [
            'monForm' => $form->createView(),
        ]);
    }

}
