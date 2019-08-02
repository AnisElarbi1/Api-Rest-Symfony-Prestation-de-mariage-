<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategorie
 *
 * @ORM\Table(name="sous_categorie")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\SousCategorieRepository")
 */
class SousCategorie
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="icone", type="string", length=255)
     */
    private $icone;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;


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
     * Set description
     *
     * @param string $description
     *
     * @return SousCategorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categorie
     *
     * @param \SW\PrestataireBundle\Entity\Categorie $categorie
     *
     * @return SousCategorie
     */
    public function setCategorie(\SW\PrestataireBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \SW\PrestataireBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return SousCategorie
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
     * Set total
     *
     * @param integer $total
     *
     * @return SousCategorie
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set icone
     *
     * @param string $icone
     *
     * @return SousCategorie
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }
}
