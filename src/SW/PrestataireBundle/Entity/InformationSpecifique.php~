<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InformationSpecifique
 *
 * @ORM\Table(name="information_specifique")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\InformationSpecifiqueRepository")
 */
class InformationSpecifique
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="obligatoire", type="boolean")
     */
    private $obligatoire;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\FicheInformations", inversedBy="informationSpecifiques", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ficheInformations;

    /**
     * @ORM\OneToMany(targetEntity="SW\PrestataireBundle\Entity\Valeur", mappedBy="informationSpecifiques", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $valeurs;

    


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
     * @return InformationSpecifique
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
     * Set type
     *
     * @param string $type
     *
     * @return InformationSpecifique
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set ficheInformations
     *
     * @param \SW\PrestataireBundle\Entity\FicheInformations $ficheInformations
     *
     * @return InformationSpecifique
     */
    public function setFicheInformations(\SW\PrestataireBundle\Entity\FicheInformations $ficheInformations)
    {
        $this->ficheInformations = $ficheInformations;

        return $this;
    }

    /**
     * Get ficheInformations
     *
     * @return \SW\PrestataireBundle\Entity\FicheInformations
     */
    public function getFicheInformations()
    {
        return $this->ficheInformations;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->valeurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add valeur
     *
     * @param \SW\PrestataireBundle\Entity\Valeur $valeur
     *
     * @return InformationSpecifique
     */
    public function addValeur(\SW\PrestataireBundle\Entity\Valeur $valeur)
    {
        $this->valeurs[] = $valeur;

        return $this;
    }

    /**
     * Remove valeur
     *
     * @param \SW\PrestataireBundle\Entity\Valeur $valeur
     */
    public function removeValeur(\SW\PrestataireBundle\Entity\Valeur $valeur)
    {
        $this->valeurs->removeElement($valeur);
    }

    /**
     * Get valeurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValeurs()
    {
        return $this->valeurs;
    }

    /**
     * Set obligatoire
     *
     * @param boolean $obligatoire
     *
     * @return InformationSpecifique
     */
    public function setObligatoire($obligatoire)
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return boolean
     */
    public function getObligatoire()
    {
        return $this->obligatoire;
    }
}
