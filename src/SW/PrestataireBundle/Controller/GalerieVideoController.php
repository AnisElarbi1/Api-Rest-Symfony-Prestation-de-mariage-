<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 04/04/2018
 * Time: 00:44
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\GalerieVideo;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class GalerieVideoController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/galerieVideo",
     *     name="app_galerieVideo_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("galerieVideo", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Creer galerie video.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre de galerie video"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createGalerieVideoAction(GalerieVideo $galerieVideo)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($galerieVideo->getPrestataire()->getId());

        $galerieVideo->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($galerieVideo);
        $em->flush();
        return  ['success'=>'true','results'=>'galerie des videos creer avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/galerieVideo/{id}",
     *     name = "app_titreGalerie_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newGalerie", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier galerie video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie video."
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
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre de galerie video"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateTitreGalerieVideoAction(GalerieVideo $galerieVideo, GalerieVideo $newGalerie)
    {
        $galerieVideo->setTitre($newGalerie->getTitre());
        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'galerie des videos modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/galerieVideo/{id}",
     *     name="app_galerieVideo_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer galerie video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie video."
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
    public function deleteGalerieVideoAction(GalerieVideo $galerieVideo)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($galerieVideo);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/galerieVideo/{id}",
     *     name="app_galerieVideo_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher galerie video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie video."
     *        }
     *     },
     *     statusCodes={
     *         200="galerie video est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showGalerieVideoAction(GalerieVideo $galerieVideo)
    {
        return  ['success'=>'true','results'=>$galerieVideo];
    }

 //id  prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/galerieVideo/liste/{id}",
     *     name="app_galerieVideosPrestataire_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des galeries videos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list galerie video d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listGalerieVideo_By_PrestataireAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GalerieVideo')->listGalerieVideo_By_Prestataire($id);
        return  ['success'=>'true','results'=>$list];
    }

 //titre passe en parametre
    /**
     * @rest\Get(
     *     path="/galerieVideo/titre/{prestataire}/{titre}",
     *     name="app_galerieVideosByTitre_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="recherche d'une galerie video d'un prestataire par  titre de galerie.",
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
     *         200="galerie video d'un prestataire p qui a le titre t est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function GalerieVideo_By_Prestataire_TitreAction($prestataire,$titre)
    {
        $galerie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GalerieVideo')->GalerieVideo_By_Prestataire_Titre($prestataire,$titre);
        return  ['success'=>'true','results'=>$galerie];

    }

//id prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/galerieVideo/listeID/{id}",
     *     name="app_listIdGalerieVideo_By_Prestataire",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des identifiants unique du galeries videos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list des identifiants de galerie video d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listIdGalerieVideo_By_PrestataireAction($id)
    {
        $listId=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GalerieVideo')->listIdGalerieVideo_By_Prestataire($id);
        return  ['success'=>'true','results'=>$listId];
    }

}