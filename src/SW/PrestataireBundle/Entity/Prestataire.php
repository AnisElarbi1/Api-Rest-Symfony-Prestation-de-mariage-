<?php

namespace SW\PrestataireBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Prestataire
 *
 * @ORM\Table(name="prestataire")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\PrestataireRepository")
 */
class Prestataire
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
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_min", type="integer")
     */
    private $prixMin;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_photo", type="integer")
     */
    private $nb_photo;

    /**
     * @var int
     *
     * @ORM\Column(name="max_photo", type="integer")
     */
    private $max_photo;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_video", type="integer")
     */
    private $nb_video;

    /**
     * @var int
     *
     * @ORM\Column(name="max_video", type="integer")
     */
    private $max_video;

    /**
     * @ORM\OneToOne(targetEntity="SW\PrestataireBundle\Entity\ContactPersonne", cascade={"all"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $contactPersonne;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\SousCategorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousCategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $id_user;

    /**
     * @var bool
     *
     * @ORM\Column(name="activer", type="boolean")
     */
    private $activer;

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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Prestataire
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Prestataire
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Prestataire
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
     * Set description
     *
     * @param string $description
     *
     * @return Prestataire
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
     * Set prixMin
     *
     * @param integer $prixMin
     *
     * @return Prestataire
     */
    public function setPrixMin($prixMin)
    {
        $this->prixMin = $prixMin;

        return $this;
    }

    /**
     * Get prixMin
     *
     * @return int
     */
    public function getPrixMin()
    {
        return $this->prixMin;
    }

    /**
     * Set contactPersonne
     *
     * @param \SW\PrestataireBundle\Entity\ContactPersonne $contactPersonne
     *
     * @return Prestataire
     */
    public function setContactPersonne(\SW\PrestataireBundle\Entity\ContactPersonne $contactPersonne)
    {
        $this->contactPersonne = $contactPersonne;

        return $this;
    }

    /**
     * Get contactPersonne
     *
     * @return \SW\PrestataireBundle\Entity\ContactPersonne
     */
    public function getContactPersonne()
    {
        return $this->contactPersonne;
    }

    /**
     * Set ville
     *
     * @param \SW\PrestataireBundle\Entity\Ville $ville
     *
     * @return Prestataire
     */
    public function setVille(\SW\PrestataireBundle\Entity\Ville $ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \SW\PrestataireBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set sousCategorie
     *
     * @param \SW\PrestataireBundle\Entity\SousCategorie $sousCategorie
     *
     * @return Prestataire
     */
    public function setSousCategorie(\SW\PrestataireBundle\Entity\SousCategorie $sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return \SW\PrestataireBundle\Entity\SousCategorie
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * Set nbPhoto
     *
     * @param integer $nbPhoto
     *
     * @return Prestataire
     */
    public function setNbPhoto($nbPhoto)
    {
        $this->nb_photo = $nbPhoto;

        return $this;
    }

    /**
     * Get nbPhoto
     *
     * @return integer
     */
    public function getNbPhoto()
    {
        return $this->nb_photo;
    }

    /**
     * Set maxPhoto
     *
     * @param integer $maxPhoto
     *
     * @return Prestataire
     */
    public function setMaxPhoto($maxPhoto)
    {
        $this->max_photo = $maxPhoto;

        return $this;
    }

    /**
     * Get maxPhoto
     *
     * @return integer
     */
    public function getMaxPhoto()
    {
        return $this->max_photo;
    }

    /**
     * Set nbVideo
     *
     * @param integer $nbVideo
     *
     * @return Prestataire
     */
    public function setNbVideo($nbVideo)
    {
        $this->nb_video = $nbVideo;

        return $this;
    }

    /**
     * Get nbVideo
     *
     * @return integer
     */
    public function getNbVideo()
    {
        return $this->nb_video;
    }

    /**
     * Set maxVideo
     *
     * @param integer $maxVideo
     *
     * @return Prestataire
     */
    public function setMaxVideo($maxVideo)
    {
        $this->max_video = $maxVideo;

        return $this;
    }

    /**
     * Get maxVideo
     *
     * @return integer
     */
    public function getMaxVideo()
    {
        return $this->max_video;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Prestataire
     */
    public function setIdUser($idUser)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set activer
     *
     * @param boolean $activer
     *
     * @return Prestataire
     */
    public function setActiver($activer)
    {
        $this->activer = $activer;

        return $this;
    }

    /**
     * Get activer
     *
     * @return boolean
     */
    public function getActiver()
    {
        return $this->activer;
    }
}
