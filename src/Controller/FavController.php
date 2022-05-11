<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Entity\Hackathon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\assertEquals;

class FavController extends AbstractController
{
    /**
     * @Route("/participants/{idparticipant}/favoris", name="favoris")
     */
    public function index($idparticipant): Response
    {
        $repository = $this->getDoctrine()->getRepository(Favoris::class);
        $lesFavs = $repository->findBy(array('idparticipant' => $idparticipant));

        return $this->render('home/favoris.html.twig', [
            'lesFavoris' => $lesFavs,
        ]);
    }


    /** 
     * @Route("/liste/{idhackathon}", name="addFavoris") 
     */ 
    public function addFavoris($idhackathon)
    { 
        $entityManager = $this->getDoctrine()->getManager();

        $favoris = new Favoris();
        $repo = $this->getDoctrine()->getRepository(Hackathon::class);
        $unHackathon = $repo->find($idhackathon);

        $favoris->setIdhackathon($unHackathon);
        $favoris->setIdparticipant($this->getUser());
        $repository = $this->getDoctrine()->getRepository(Favoris::class);
        $favs = $repository->findBy(array('idparticipant' => $this->getUser(), 'idhackathon' => $idhackathon));
            if(empty($favs)){
                $entityManager->persist($favoris);
                $entityManager->persist($unHackathon);
                $entityManager->flush();  
            }
            else{
                
            }

        
         // persist de l'objet hackathon 
        
        return $this->redirectToRoute('liste');
    }  


    /**
     * @Route("/participants/{idparticipant}/favoris/delete/{idfavoris}", name="deleteFavoris", requirements={"id"="\d+"}, methods="DELETE")
     */
    public function deleteUnFav(Request $request, $idparticipant, $idfavoris): Response
    {
        $idparticipant = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Favoris::class);
        $lesFavoris = $repository->findAll();
        $leFav=$repository->find($idfavoris);
        $em=$this->getDoctrine()->getManager();
        $em->remove($leFav);
        $em->flush();
        $lesFavorism1 = $repository->findAll();
        
        //On test si le favoris s'est bien supprimé 
        assertEquals(count($lesFavoris) - 1, count($lesFavorism1), "true");

        return $this->redirectToRoute("home");
    }
}
