<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hackathon
 *
 * @ORM\Table(name="hackathon")
 * @ORM\Entity
 */
class Hackathon
{
    /**
     * @var int
     *
     * @ORM\Column(name="idHackathon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhackathon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heureDebut", type="time", nullable=true)
     */
    private $heuredebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $datefin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heureFin", type="time", nullable=true)
     */
    private $heurefin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rue", type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codePostal", type="string", length=5, nullable=true, options={"fixed"=true})
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255, nullable=false)
     */
    private $theme;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateLimite", type="date", nullable=true)
     */
    private $datelimite;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbPlaces", type="integer", nullable=true)
     */
    private $nbplaces;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;


}
