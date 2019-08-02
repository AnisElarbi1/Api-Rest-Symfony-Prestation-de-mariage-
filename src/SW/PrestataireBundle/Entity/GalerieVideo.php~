<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalerieVideo
 *
 * @ORM\Table(name="galerie_video")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\GalerieVideoRepository")
 */
class GalerieVideo
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
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Prestataire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;

    /**
     * @ORM\OneToMany(targetEntity="SW\PrestataireBundle\Entity\Video", mappedBy="galerieVideo", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $videos;

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
     * @return GalerieVideo
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
     * Set prestataire
     *
     * @param \SW\PrestataireBundle\Entity\Prestataire $prestataire
     *
     * @return GalerieVideo
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
     * Constructor
     */
    public function __construct()
    {
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add video
     *
     * @param \SW\PrestataireBundle\Entity\Video $video
     *
     * @return GalerieVideo
     */
    public function addVideo(\SW\PrestataireBundle\Entity\Video $video)
    {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \SW\PrestataireBundle\Entity\Video $video
     */
    public function removeVideo(\SW\PrestataireBundle\Entity\Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }
}
