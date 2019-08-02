<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GaleriePhotos
 *
 * @ORM\Table(name="galerie_photos")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\GaleriePhotosRepository")
 */
class GaleriePhotos
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var int
     *
     * @ORM\Column(name="photo_pricipale", type="integer")
     */
    private $photoPrincipale;
    

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;

    /**
     * @ORM\OneToMany(targetEntity="SW\PrestataireBundle\Entity\Photo", mappedBy="galeriePhoto", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $photos;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return GaleriePhotos
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return GaleriePhotos
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set prestataire
     *
     * @param \SW\PrestataireBundle\Entity\Prestataire $prestataire
     *
     * @return GaleriePhotos
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

    /**
     * Set photoPrincipale
     *
     * @param integer $photoPrincipale
     *
     * @return GaleriePhotos
     */
    public function setPhotoPrincipale($photoPrincipale)
    {
        $this->photoPrincipale = $photoPrincipale;

        return $this;
    }

    /**
     * Get photoPrincipale
     *
     * @return integer
     */
    public function getPhotoPrincipale()
    {
        return $this->photoPrincipale;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add photo
     *
     * @param \SW\PrestataireBundle\Entity\Photo $photo
     *
     * @return GaleriePhotos
     */
    public function addPhoto(\SW\PrestataireBundle\Entity\Photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \SW\PrestataireBundle\Entity\Photo $photo
     */
    public function removePhoto(\SW\PrestataireBundle\Entity\Photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
