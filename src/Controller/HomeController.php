<?php

namespace App\Controller;

use App\Entity\Hackathon;
use App\Entity\Inscriptionhackathon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $lesHackathons = $repository->findAll();
        return $this->render('home/liste.html.twig', [
            'listeHackathons' => $lesHackathons,
        ]);
    }

    /**
     * @Route("/liste/{id}", name="hackathon")
     */

    public function afficherDetails($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $repo=$this->getDoctrine()->getRepository(Inscriptionhackathon::class);
        $unHackathon = $repository->find($id);
        return $this->render('home/hackathon.html.twig', [
            'unHackathon' => $unHackathon,
        ]);
    }
}
