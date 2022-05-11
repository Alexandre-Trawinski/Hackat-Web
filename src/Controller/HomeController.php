<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Entity\Hackathon;
use App\Form\CompteType;
use App\Entity\Participant;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Inscriptionhackathon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HackathonRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\isNull;

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
        $dateNow = new DateTime('now');

        return $this->render('home/liste.html.twig', [
            'listeHackathons' => $lesHackathons, 'listeVilles' => $lesVilles, 'dateNow' => $dateNow
        ]);
    }

    /**
     * @Route("/liste/details/{id}", name="hackathon", requirements={"id"="\d+"})
     */

    public function afficherDetails($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $repo = $this->getDoctrine()->getRepository(Inscriptionhackathon::class);
        $unHackathon = $repository->find($id);
        $lesInscriptions = $repo->findBy(['idhackathon' => $id]);
        $img64 = $unHackathon->getImage();
        $nbInscriptions = count($lesInscriptions);
        return $this->render('home/hackathon.html.twig', [
            'unHackathon' => $unHackathon, 'nbInscriptions' => $nbInscriptions, 'img' => $img64
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
    public function Login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $errors = $authenticationUtils->getLastAuthenticationError();
        dump($authenticationUtils);
        return $this->render('home/login.html.twig', ['lastUsername' => $lastUsername, 'errors' =>
        $errors]);
        return $this->render('base.html.twig', ['lastUsername' => $lastUsername]);
    }

    /**
     *  @Route("/logout", name="logout")
     */
    public function logout($login): Response
    {
        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/liste/{id}/inscription", name="inscription")
     */
    public function inscription($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Inscriptionhackathon::class);
        $repo = $this->getDoctrine()->getRepository(Hackathon::class);
        $unHackathon = $repo->findOneBy(['idhackathon' => $id]);
        //$leHackathon = new Hackathon($unHackathon);
        $date = date('Y-m-d');
        $laDate = new DateTime($date);
        $unParticipant = $this->getUser();
        $competence = "full stack";
        $uneInscription = new Inscriptionhackathon();
        $uneInscription->setIdhackathon($unHackathon);
        $uneInscription->setIdparticipant($unParticipant);
        $uneInscription->setDateinscription($laDate);
        $uneInscription->setCompetence($competence);

        $em = $this->getDoctrine()->getManager();
        $em->persist($uneInscription);
        $em->flush();
        return $this->render('home/index.html.twig');
    }
}
