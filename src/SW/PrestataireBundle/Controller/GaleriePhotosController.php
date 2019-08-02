<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 04/04/2018
 * Time: 15:36
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\GaleriePhotos;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class GaleriePhotosController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/galeriePhoto",
     *     name="app_galeriePhoto_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("galeriePhoto", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Creer galerie photo.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre de galerie photo"},
     *      {"name"="logo", "dataType"="string", "required"=true, "description"="logo de galerie photo"},
     *      {"name"="photo_principale", "dataType"="integer", "required"=true, "description"="identifiant de photo principale de galerie photo"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createGaleriePhotoAction(GaleriePhotos $galeriePhoto)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($galeriePhoto->getPrestataire()->getId());

        $galeriePhoto->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($galeriePhoto);
        $em->flush();
        return  ['success'=>'true','results'=>'galerie des photos creer avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/galeriePhoto/{id}",
     *     name = "app_galeriePhoto_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newGaleriePhoto", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier galerie photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie photo."
     *        }
     *     },
     *     statusCodes={
     *         200="objet modifier avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre de galerie photo"},
     *      {"name"="logo", "dataType"="string", "required"=true, "description"="logo de galerie photo"},
     *      {"name"="photo_principale", "dataType"="integer", "required"=true, "description"="identifiant de photo principale de galerie photo"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateGaleriePhotoAction(GaleriePhotos $galeriePhotos, GaleriePhotos $newGaleriePhoto)
    {
        $galeriePhotos->setTitre($newGaleriePhoto->getTitre());
        $galeriePhotos->setLogo($newGaleriePhoto->getLogo());
        $galeriePhotos->setPhotoPrincipale($newGaleriePhoto->getPhotoPrincipale());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'galerie des photos modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/galeriePhoto/{id}",
     *     name="app_galeriePhoto_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer galerie photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie photo."
     *        }
     *     },
     *     statusCodes={
     *         204="objet supprimer avec succee",
     *         404="objet n'existe pas",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function deleteGaleriePhotoAction(GaleriePhotos $galeriePhotos)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($galeriePhotos);
        $em->flush();
    }

  //id  prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/galeriePhoto/liste/{id}",
     *     name="app_galeriePhotosPrestataire_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des galeries photos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list des galeries photos d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     *
     */
    public function listGaleriePhoto_By_PrestataireAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GaleriePhotos')->listGaleriePhoto_By_Prestataire($id);
        return  ['success'=>'true','results'=>$list];
    }

    /**
     * @rest\Get(
     *     path="/galeriePhoto/{id}",
     *     name="app_galeriePhoto_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher galerie photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie photo."
     *        }
     *     },
     *     statusCodes={
     *         200="galerie photo est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showGaleriePhotoAction(GaleriePhotos $galeriePhotos)
    {
        return  ['success'=>'true','results'=>$galeriePhotos];
    }

 //titre passe en parametre
    /**
     * @rest\Get(
     *     path="/galeriePhoto/titre/{prestataire}/{titre}",
     *     name="app_galeriePhotosByTitre_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="recherche d'une galerie photo d'un prestataire par  titre de galerie.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."},
     *        {
     *          "name"="titre",
     *          "dataType"="string",
     *          "description"="titre de galerie."
     *         }
     *       },
     *     statusCodes={
     *         200="galerie photo d'un prestataire p qui a la titre t est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function GaleriePhoto_By_Prestataire_TitreAction($prestataire,$titre)
    {
        $galerie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GaleriePhotos')->GaleriePhoto_By_Prestataire_Titre($prestataire,$titre);
        return  ['success'=>'true','results'=>$galerie];
    }

//id prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/galeriePhoto/listeID/{id}",
     *     name="app_listIdGaleriePhoto_By_Prestataire",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des identifiants unique du galeries photos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list des identifiant des galeries d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listIdGaleriePhoto_By_PrestataireAction($id)
    {
        $listId=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GaleriePhotos')->listIdGaleriePhoto_By_Prestataire($id);
        return  ['success'=>'true','results'=>$listId];
    }

}