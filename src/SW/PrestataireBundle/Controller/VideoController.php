<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 04/04/2018
 * Time: 12:05
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\GalerieVideo;
use SW\PrestataireBundle\Entity\Video;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class VideoController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/video",
     *     name="app_add_video"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("video", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Ajouter video.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="url", "dataType"="string", "required"=true, "description"="l'url de video"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de video"},
     *      {"name"="galerie_video", "dataType"="objet", "required"=true, "description"="objet galerie video avec id"}
     *     }
     * )
     */
    public function addVideoAction(Video $video)

    {
        //$nombre_video=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Video')->nombreVideo($video->getGalerieVideo()->getPrestataire()->getId());
        //if (intval($nombre_video)<= 3)
        //{
        $galerie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:GalerieVideo')->find($video->getGalerieVideo()->getId());

        $video->setGalerieVideo($galerie);

        $nb_max_video = $video->getGalerieVideo()->getPrestataire()->getMaxVideo();
        $nb_video_existe=$video->getGalerieVideo()->getPrestataire()->getNbVideo();

        if( $nb_max_video > $nb_video_existe )
        {
            $video->getGalerieVideo()->getPrestataire()->setNbVideo($nb_video_existe+1);

            $em=$this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            return  ['success'=>'true','results'=>' video ajouter avec succee'];
        }
       else{
           return  ['success'=>'false','results'=>'payement obligatoire'];
           }
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/video/{id}",
     *     name = "app_update_video",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newVideo", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une video."
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
     *      {"name"="url", "dataType"="string", "required"=true, "description"="l'url de video"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de video"},
     *      {"name"="galerie_video", "dataType"="objet", "required"=true, "description"="objet galerie video avec id"}
     *     }
     * )
     */
    public function updateVideoAction(Video $video, Video $newVideo)
    {
        $video->setUrl($newVideo->getUrl());
        $video->setDescription($newVideo->getDescription());
        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'video modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/video/{id}",
     *     name="app_delete_video",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une video."
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
    public function deleteVideoAction(Video $video)
    {
        $nb_video_existe=$video->getGalerieVideo()->getPrestataire()->getNbVideo();

        $video->getGalerieVideo()->getPrestataire()->setNbVideo($nb_video_existe-1);

        $em=$this->getDoctrine()->getManager();
        $em->remove($video);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/video/{id}",
     *     name="app_video_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une video."
     *        }
     *     },
     *     statusCodes={
     *         200="video est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showVideoAction(Video $video)
    {
        return  ['success'=>'true','results'=>$video];
    }
//id video passee en parametre
    /**
     * @rest\Get(
     *     path="/video/id/{id}",
     *     name="app_galerieVideo_video_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher video sauf les champs necessaire).",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une video."
     *        }
     *     },
     *     statusCodes={
     *         200="video est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showVideo_By_IdVideoAction($id)
    {
        $video=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Video')->showVideo_By_IdVideo($id);
        return  ['success'=>'true','results'=>$video];
    }

 //id  galerie passe en parametre
    /**
     * @rest\Get(
     *     path="/galerieVideo/videos/{id}",
     *     name="app_Videos_galerieVideo_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des videos d'une galerie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie de video."
     *        }
     *     },
     *     statusCodes={
     *         200="list video d'un galerie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listVideos_By_GalerieVideoAction($id)
    {
        $list_viedos=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Video')->listVideos_By_GalerieVideo($id);
        return  ['success'=>'true','results'=>$list_viedos];
    }
    /**
     * @rest\Get(
     *     path="/galerieVideo/nombre_video/{id}",
     *     name="app_nombreVideo_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="nombre des videos d'une galerie de video.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une galerie video."
     *        }
     *       },
     *     statusCodes={
     *         200="nombre de video d'un galerie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nombreVideo_By_GalerieVideoAction($id)
    {
        $nb_video=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Video')-> nombreVideo_By_GalerieVideo($id);
        return  ['success'=>'true','results'=>$nb_video];

    }

}