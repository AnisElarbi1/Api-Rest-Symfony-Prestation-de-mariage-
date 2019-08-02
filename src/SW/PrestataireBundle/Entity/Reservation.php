<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tempsDebut", type="datetime")
     */
    private $tempsDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tempsFin", type="datetime")
     */
    private $tempsFin;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Couple")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couple;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Reservation
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set tempsDebut
     *
     * @param \DateTime $tempsDebut
     *
     * @return Reservation
     */
    public function setTempsDebut($tempsDebut)
    {
        $this->tempsDebut = $tempsDebut;

        return $this;
    }

    /**
     * Get tempsDebut
     *
     * @return \DateTime
     */
    public function getTempsDebut()
    {
        return $this->tempsDebut;
    }

    /**
     * Set tempsFin
     *
     * @param \DateTime $tempsFin
     *
     * @return Reservation
     */
    public function setTempsFin($tempsFin)
    {
        $this->tempsFin = $tempsFin;

        return $this;
    }

    /**
     * Get tempsFin
     *
     * @return \DateTime
     */
    public function getTempsFin()
    {
        return $this->tempsFin;
    }

    /**
     * Set couple
     *
     * @param \SW\PrestataireBundle\Entity\Couple $couple
     *
     * @return Reservation
     */
    public function setCouple(\SW\PrestataireBundle\Entity\Couple $couple)
    {
        $this->couple = $couple;

        return $this;
    }

    /**
     * Get couple
     *
     * @return \SW\PrestataireBundle\Entity\Couple
     */
    public function getCouple()
    {
        return $this->couple;
    }

    /**
     * Set prestataire
     *
     * @param \SW\PrestataireBundle\Entity\Prestataire $prestataire
     *
     * @return Reservation
     */
    public function setPrestataire(\SW\PrestataireBundle\Entity\Prestataire $prestataire)
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * Get prestataire
     *
     * @return \SW\PrestataireBundle\Entity\Prestataire
     */
    public function getPrestataire()
    {
        return $this->prestataire;
    }
}
