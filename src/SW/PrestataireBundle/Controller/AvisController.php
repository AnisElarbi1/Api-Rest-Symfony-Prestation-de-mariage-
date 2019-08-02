<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 02/04/2018
 * Time: 10:43
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Avis;
use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class AvisController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/couple/avis",
     *     name="app_avis_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("avis", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Ajouter avis.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="avis", "dataType"="integer", "required"=true, "description"="valeur d'un avis"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description d'un avis"},
     *      {"name"="date", "dataType"="datetime", "required"=true, "description"="date d'un avis"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createAvisAction(Avis $avis)

    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($avis->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($avis->getPrestataire()->getId());

        $avis->setCouple($couple);
        $avis->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($avis);
        $em->flush();
        return  ['success'=>'true','results'=>'avis ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/couple/avis/{id}",
     *     name = "app_avis_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newAvis", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Modifier avis.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un avis."
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
     *      {"name"="avis", "dataType"="integer", "required"=true, "description"="valeur d'un avis"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description d'un avis"},
     *      {"name"="date", "dataType"="datetime", "required"=true, "description"="date d'un avis"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateAvisAction(Avis $avis, Avis $newAvis)
    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($newAvis->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($newAvis->getPrestataire()->getId());

        $avis->setPrestataire($prestataire);
        $avis->setCouple($couple);
        $avis->setAvis($newAvis->getAvis());
        $avis->setDescription($newAvis->getDescription());
        $avis->setDate($newAvis->getDate());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'avis modifier avec succee'];
    }

    /**
     * @rest\Delete(
     *     path="/couple/avis/{id}",
     *     name="app_avis_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="supprimer avis.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un avis."
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
    public function deleteAvisAction(Avis $avis)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($avis);
        $em->flush();
        return  ['success'=>'true','results'=>'avis supprimer avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/avis/{id}",
     *     name="app_avis_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="afficher avis.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un avis."
     *        }
     *     },
     *     statusCodes={
     *         200="avis est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showAvisAction(Avis $avis)
    {
        return  ['success'=>'true','results'=>$avis];
    }

    /**
     * @rest\Get(
     *     path="/couple/avis/{id}",
     *     name="app_avisCouple_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des avis d'une couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une couple."
     *        }
     *     },
     *     statusCodes={
     *         200="liste des avis est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function Avis_By_CoupleAction($couple)
    {
        $avis_couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Avis')->AvisCouple($couple);
        return  ['success'=>'true','results'=>$avis_couple];
    }

    /**
     * @rest\Get(
     *     path="/avis/moyenne/{id}",
     *     name="app_avisPresatataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher la moyenne d'avis pour un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="avis est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function Avis_By_PrestataireAction($prestataire)
    {
        $avis_prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Avis')->AvisPrestataire($prestataire);
        return  ['success'=>'true','results'=>$avis_prestataire];
    }

    /**
     * @rest\Get(
     *     path="/avis/nombre/{id}",
     *     name="app_nombreAvis_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher la nombre d'avis pour un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="nombre d'avis pour un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nombre_avis_By_PrestataireAction($prestataire)
    {
        $nb_avis=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Avis')->NbAvisPrestataire($prestataire);
        return  ['success'=>'true','results'=>$nb_avis];
    }

}