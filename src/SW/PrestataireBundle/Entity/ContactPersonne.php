<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactPersonne
 *
 * @ORM\Table(name="contact_personne")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\ContactPersonneRepository")
 */
class ContactPersonne
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="telephonePortable", type="string", length=255)
     */
    private $telephonePortable;

    /**
     * @var string
     *
     * @ORM\Column(name="telephoneFax", type="string", length=255)
     */
    private $telephoneFax;

    /**
     * @var string
     *
     * @ORM\Column(name="siteInternet", type="string", length=255)
     */
    private $siteInternet;


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
     * @return ContactPersonne
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
     * Set email
     *
     * @param string $email
     *
     * @return ContactPersonne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return ContactPersonne
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set telephoneFax
     *
     * @param string $telephoneFax
     *
     * @return ContactPersonne
     */
    public function setTelephoneFax($telephoneFax)
    {
        $this->telephoneFax = $telephoneFax;

        return $this;
    }

    /**
     * Get telephoneFax
     *
     * @return string
     */
    public function getTelephoneFax()
    {
        return $this->telephoneFax;
    }

    /**
     * Set siteInternet
     *
     * @param string $siteInternet
     *
     * @return ContactPersonne
     */
    public function setSiteInternet($siteInternet)
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    /**
     * Get siteInternet
     *
     * @return string
     */
    public function getSiteInternet()
    {
        return $this->siteInternet;
    }

    /**
     * Set telephonePortable
     *
     * @param string $telephonePortable
     *
     * @return ContactPersonne
     */
    public function setTelephonePortable($telephonePortable)
    {
        $this->telephonePortable = $telephonePortable;

        return $this;
    }

    /**
     * Get telephonePortable
     *
     * @return string
     */
    public function getTelephonePortable()
    {
        return $this->telephonePortable;
    }
}
