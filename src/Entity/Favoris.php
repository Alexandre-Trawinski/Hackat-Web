<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris", indexes={@ORM\Index(name="idHackathon", columns={"idHackathon"}), @ORM\Index(name="idParticipant", columns={"idParticipant"})})
 * @ORM\Entity
 */
class Favoris
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFavoris", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfavoris;

    /**
     * @var Hackathon
     *
     * @ORM\ManyToOne(targetEntity="Hackathon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idHackathon", referencedColumnName="idHackathon")
     * })
     */
    private $idhackathon;

    /**
     * @var Participant
     *
     * @ORM\ManyToOne(targetEntity="Participant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idParticipant", referencedColumnName="idParticipant")
     * })
     */
    private $idparticipant;

    public function getIdfavoris(): ?int
    {
        return $this->idfavoris;
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

    public function getIdparticipant(): ?Participant
    {
        return $this->idparticipant;
    }

    public function setIdparticipant(?Participant $idparticipant): self
    {
        $this->idparticipant = $idparticipant;

        return $this;
    }
}
