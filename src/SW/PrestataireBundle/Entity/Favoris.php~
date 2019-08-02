<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\FavorisRepository")
 */
class Favoris
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
     * Set couple
     *
     * @param \SW\PrestataireBundle\Entity\Couple $couple
     *
     * @return Favoris
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
     * @return Favoris
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
