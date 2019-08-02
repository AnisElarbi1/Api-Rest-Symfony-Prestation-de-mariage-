<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 05/04/2018
 * Time: 11:52
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\GaleriePhotos;
use SW\PrestataireBundle\Entity\Photo;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class PhotoController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/photo",
     *     name="app_add_photo"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("photo", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Ajouter photo.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="url", "dataType"="string", "required"=true, "description"="l'url de photo"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de photo"},
     *      {"name"="galerie_photo", "dataType"="objet", "required"=true, "description"="objet galerie photo avec id"}
     *     }
     * )
     */
    public function addPhotoAction(Photo $photo)

    {
        $galerie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GaleriePhotos')->find($photo->getGaleriePhoto()->getId());

        $photo->setGaleriePhoto($galerie);

        $nb_max_photo = $photo->getGaleriePhoto()->getPrestataire()->getMaxPhoto();
        $nb_photo_existe=$photo->getGaleriePhoto()->getPrestataire()->getNbPhoto();

        if( $nb_max_photo > $nb_photo_existe )
        {
            $photo->getGaleriePhoto()->getPrestataire()->setNbPhoto($nb_photo_existe+1);

            $em=$this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return  ['success'=>'true','results'=>'photo ajouter avec succee'];
        }
        else{
            return  ['success'=>'false','results'=>'payement obligatoire'];
        }
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/photo/{id}",
     *     name = "app_update_photo",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newPhoto", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une photo."
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
     *      {"name"="url", "dataType"="string", "required"=true, "description"="l'url de photo"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de photo"},
     *      {"name"="galerie_photo", "dataType"="objet", "required"=true, "description"="objet galerie photo avec id"}
     *     }
     * )
     */
    public function updatePhotoAction(Photo $photo, Photo $newPhoto)
    {
        $photo->setUrl($newPhoto->getUrl());
        $photo->setDescription($newPhoto->getDescription());

        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'photo modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/photo/{id}",
     *     name="app_delete_photo",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une photo."
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
    public function deletePhotoAction(Photo $photo)
    {
        $nb_photo_existe=$photo->getGaleriePhoto()->getPrestataire()->getNbPhoto();
        $photo->getGaleriePhoto()->getPrestataire()->setNbPhoto($nb_photo_existe-1);

        $em=$this->getDoctrine()->getManager();
        $em->remove($photo);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/photo/{id}",
     *     name="app_photo_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une photo."
     *        }
     *     },
     *     statusCodes={
     *         200="photo est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPhotoAction(Photo $photo)
    {
        return  ['success'=>'true','results'=>$photo];
    }

 //id photo passee en parametre
    /**
     * @rest\Get(
     *     path="/photo/id/{id}",
     *     name="app_galeriePhoto_photo_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher photo sauf les champs necessaire).",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une photo."
     *        }
     *     },
     *     statusCodes={
     *         200="photo est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPhoto_By_IdPhotoAction($id)
    {
        $photo=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Photo')->showPhoto_By_IdPhoto($id);
        return  ['success'=>'true','results'=>$photo];
    }

 //id  galerie passe en parametre
    /**
     * @rest\Get(
     *     path="/galeriePhoto/photos/{id}",
     *     name="app_Videos_galeriePhoto_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des photos d'une galerie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie de photo."
     *        }
     *     },
     *     statusCodes={
     *         200="list photo d'un galerie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPhotos_By_GaleriePhotoAction($id)
    {
        $list_photos=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Photo')->listPhotos_By_GaleriePhoto($id);
        return  ['success'=>'true','results'=>$list_photos];
    }
    /**
     * @rest\Get(
     *     path="/galeriePhoto/nombre_photo/{id}",
     *     name="app_nombrePhoto_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="nombre des photos d'une galerie de photo.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie photo."
     *        }
     *       },
     *     statusCodes={
     *         200="nombre des photos d'un galerie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nombrePhoto_By_GaleriePhotoAction($id)
    {
        $nb_photo=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Photo')-> nombrePhoto_By_GaleriePhoto($id);
        return  ['success'=>'true','results'=>$nb_photo];

    }

}