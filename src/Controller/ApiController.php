<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hackathon;
use App\Entity\Participant;
use App\Entity\Evenement;
use App\Entity\Inscriptionmobile;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', ['controller_name' => 'ApiController']);
    }

    /**
     * @Route("/api/hackathons", name="hackathonAPI", methods="GET")
     */
    public function hackathonApi(): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $lesHackathons = $repository->findAll();
        $TabJSON = [];
        foreach ($lesHackathons as $unHackathon) {
            $TabJSON[] =
                [
                    'Id' =>  $unHackathon->getIdhackathon(),
                    'dateDebut' =>  $unHackathon->getDatedebut(),
                    'heureDebut' =>  $unHackathon->getHeuredebut(),
                    'dateFin' =>  $unHackathon->getDatefin(),
                    'heureFin' =>  $unHackathon->getHeurefin(),
                    'lieu' =>  $unHackathon->getLieu(),
                    'rue' =>  $unHackathon->getRue(),
                    'ville' =>  $unHackathon->getVille(),
                    'CP' =>  $unHackathon->getCodepostal(),
                    'theme' =>  $unHackathon->getTheme(),
                    'dateLimite' =>  $unHackathon->getDatelimite(),
                    'nbPlaces' =>  $unHackathon->getNbplaces(),
                    'image' =>  $unHackathon->getImage(),
                ];
        }
        return new JsonResponse($TabJSON);
    }

    /**
     * @Route("/api/hackathons/{id}", name="unHackathon", methods="GET")
     */

    public function unHackathon($id): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Hackathon::class);
        $leHackathon = $repository->find($id);
        if (empty($leHackathon)) {
            return new JsonResponse(['message' => 'Hackathon not found'], Response::HTTP_NOT_FOUND);
        }
        $TabJSON[] = [
            'id' =>  $leHackathon->getIdhackathon(),
            'dateDebut' =>  $leHackathon->getDatedebut(),
            'heureDebut' =>  $leHackathon->getHeuredebut(),
            'dateFin' =>  $leHackathon->getDatefin(),
            'heureFin' =>  $leHackathon->getHeurefin(),
            'lieu' =>  $leHackathon->getLieu(),
            'rue' =>  $leHackathon->getRue(),
            'ville' =>  $leHackathon->getVille(),
            'CP' =>  $leHackathon->getCodepostal(),
            'theme' =>  $leHackathon->getTheme(),
            'dateLimite' =>  $leHackathon->getDatelimite(),
            'nbPlaces' =>  $leHackathon->getNbplaces(),
            'image' =>  $leHackathon->getImage(),
        ];
        return new JsonResponse($TabJSON);
    }

    /**
     * @Route("/api/participants/{email}/{pwd}", name="unParticipant", methods="GET")
     */

    public function lesParticipants($email, $pwd): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(Participant::class);
        $lesParticipants = $repository->findBy(
            array('mail' => $email, 'password' => $pwd)
        );
        foreach ($lesParticipants as $unParticipant) {
            $TabJSON[] = [
                'id' => $unParticipant->getIdparticipant(),
                'nom' => $unParticipant->getNom(),
                'prenom' => $unParticipant->getPrenom(),
                'dateNaissance' => $unParticipant->getDatenaissance(),
                'rue' => $unParticipant->getRue(),
                'ville' => $unParticipant->getVille(),
                'mail' => $unParticipant->getMail(),
                'tel' => $unParticipant->getTel(),
                'login' => $unParticipant->getLogin(),
                'password' => $unParticipant->getPassword(),
                'portfolio' => $unParticipant->getPortfolio(),

            ];
        }
        return new JsonResponse($TabJSON);
    }

    /**
     * @Route("/api/hackathons/{id}/evenements", name="evenements", methods="GET")
     */

    public function lesEvenements($id)
    {
        $repo = $this->getDoctrine()->getRepository(Evenement::class);
        $lesEvenements = $repo->findBy(['idhackathon' => $id]);
        $TabEvenement = [];
        foreach ($lesEvenements as $unEvenement) {
            $TabEvenement[] =
                [
                    'id' => $unEvenement->getId(),
                    'libelle' => $unEvenement->getLibelle(),
                    'date' => $unEvenement->getDate(),
                    'heureDebut' => $unEvenement->getHeuredebut(),
                    'duree' => $unEvenement->getDuree(),
                    'salle' => $unEvenement->getSalle(),
                    'nbParticipants' => $unEvenement->getNbparticipants(),
                    'intervenant' => $unEvenement->getIntervenant(),
                    'image' => $unEvenement->getImage(),
                    'type' => $unEvenement->getType(),
                ];
        }
        return new JsonResponse($TabEvenement);
    }

    /**
     * @Route("/api/hackathons/evenements/{id}/inscriptionAtelier", name="inscriptionAtelier", methods="POST")
     */

    public function inscriptionAtelier(Request $request, $id)
    {
        $donnees = $request->getContent();
        $user = json_decode($donnees, true);

        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $email = $user['email'];

        $uneInscription = new Inscriptionmobile();
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $unEvenement = $repository->find($id);
        
        $uneInscription->setIdevenement($unEvenement);
        $uneInscription->setNom($nom);
        $uneInscription->setPrenom($prenom);
        $uneInscription->setEmail($email);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($uneInscription);
        $em->flush();

        return new JsonResponse($user);
    }
}
