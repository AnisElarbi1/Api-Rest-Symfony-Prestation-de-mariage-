<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use SW\PrestataireBundle\Entity\Pays;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\VilleRepository")
 */
class Ville
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
     * @ORM\Column(name="nom", type="string", length=255, unique = true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Pays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Ville
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pays
     *
     * @param \SW\PrestataireBundle\Entity\Pays $pays
     *
     * @return Ville
     */
    public function setPays(\SW\PrestataireBundle\Entity\Pays $pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \SW\PrestataireBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }
}
