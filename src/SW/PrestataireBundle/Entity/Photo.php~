<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\GaleriePhotos", inversedBy="photos", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $galeriePhoto;


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
     * Set url
     *
     * @param string $url
     *
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Photo
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
     * Set galeriePhoto
     *
     * @param \SW\PrestataireBundle\Entity\GaleriePhotos $galeriePhoto
     *
     * @return Photo
     */
    public function setGaleriePhoto(\SW\PrestataireBundle\Entity\GaleriePhotos $galeriePhoto)
    {
        $this->galeriePhoto = $galeriePhoto;

        return $this;
    }

    /**
     * Get galeriePhoto
     *
     * @return \SW\PrestataireBundle\Entity\GaleriePhotos
     */
    public function getGaleriePhoto()
    {
        return $this->galeriePhoto;
    }
}
