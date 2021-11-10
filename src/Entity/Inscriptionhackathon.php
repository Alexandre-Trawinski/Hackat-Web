<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscriptionhackathon
 *
 * @ORM\Table(name="InscriptionHackathon", indexes={@ORM\Index(name="idHackathon", columns={"idHackathon"}), @ORM\Index(name="idParticipant", columns={"idParticipant"})})
 * @ORM\Entity
 */
class Inscriptionhackathon
{
    /**
     * @var int
     *
     * @ORM\Column(name="idInscription", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idinscription;

    /**
     * @var string
     *
     * @ORM\Column(name="competence", type="string", length=255, nullable=false)
     */
    private $competence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInscription", type="date", nullable=false)
     */
    private $dateinscription;

    /**
     * @var \Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idParticipant", referencedColumnName="idParticipant")
     * })
     */
    private $idparticipant;

    /**
     * @var \Hackathon
     *
     * @ORM\ManyToOne(targetEntity="Hackathon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idHackathon", referencedColumnName="idHackathon")
     * })
     */
    private $idhackathon;


}
