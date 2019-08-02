<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valeur
 *
 * @ORM\Table(name="valeur")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\ValeurRepository")
 */
class Valeur
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
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;

    /**
     * @var bool
     *
     * @ORM\Column(name="pardefaut", type="boolean")
     */
    private $pardefaut;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\InformationSpecifique", inversedBy="valeurs", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $informationSpecifiques;


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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set pardefaut
     *
     * @param boolean $pardefaut
     *
     * @return Valeur
     */
    public function setPardefaut($pardefaut)
    {
        $this->pardefaut = $pardefaut;

        return $this;
    }

    /**
     * Get pardefaut
     *
     * @return bool
     */
    public function getPardefaut()
    {
        return $this->pardefaut;
    }

    /**
     * Set informationSpecifiques
     *
     * @param \SW\PrestataireBundle\Entity\InformationSpecifique $informationSpecifiques
     *
     * @return Valeur
     */
    public function setInformationSpecifiques(\SW\PrestataireBundle\Entity\InformationSpecifique $informationSpecifiques)
    {
        $this->informationSpecifiques = $informationSpecifiques;

        return $this;
    }

    /**
     * Get informationSpecifiques
     *
     * @return \SW\PrestataireBundle\Entity\InformationSpecifique
     */
    public function getInformationSpecifiques()
    {
        return $this->informationSpecifiques;
    }
}
