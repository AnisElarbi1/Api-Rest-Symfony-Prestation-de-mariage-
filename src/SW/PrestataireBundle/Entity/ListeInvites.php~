<?php

namespace SW\PrestataireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeInvites
 *
 * @ORM\Table(name="liste_invites")
 * @ORM\Entity(repositoryClass="SW\PrestataireBundle\Repository\ListeInvitesRepository")
 */
class ListeInvites
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="SW\PrestataireBundle\Entity\Couple")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couple;


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
     * @return ListeInvites
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return ListeInvites
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ListeInvites
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
     * Set couple
     *
     * @param \SW\PrestataireBundle\Entity\Couple $couple
     *
     * @return ListeInvites
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
}
