<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscriptionhackathon
 *
 * @ORM\Table(name="InscriptionHackathon", indexes={@ORM\Index(name="idParticipant", columns={"idParticipant"}), @ORM\Index(name="idHackathon", columns={"idHackathon"})})
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
     * @var Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idParticipant", referencedColumnName="idParticipant")
     * })
     */
    private $idparticipant;

    /**
     * @var Hackathon
     *
     * @ORM\ManyToOne(targetEntity="Hackathon", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idHackathon", referencedColumnName="idHackathon")
     * })
     */
    private $idhackathon;

    public function getIdinscription(): ?int
    {
        return $this->idinscription;
    }

    public function getCompetence(): ?string
    {
        return $this->competence;
    }

    public function setCompetence(string $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getDateinscription(): ?\DateTimeInterface
    {
        return $this->dateinscription;
    }

    public function setDateinscription(\DateTimeInterface $dateinscription): self
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    public function getIdparticipant(): ?Participant
    {
        return $this->idparticipant;
    }

    public function setIdparticipant(?Participant $idparticipant): self
    {
        $this->idparticipant = $idparticipant;

        return $this;
    }

    public function getIdhackathon(): ?Hackathon
    {
        return $this->idhackathon;
    }

    public function setIdhackathon(?Hackathon $idhackathon): self
    {
        $this->idhackathon = $idhackathon;

        return $this;
    }
}
