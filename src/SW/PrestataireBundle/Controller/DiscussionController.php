<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 05/04/2018
 * Time: 14:24
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Discussion;
use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\Prestataire;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class DiscussionController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/discussion",
     *     name="app_discussion_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("discussion", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Creer discussion.",
     *     statusCodes={
     *         201="objet creer avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre du discussion"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createDiscussionAction(Discussion $discussion)

    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($discussion->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($discussion->getPrestataire()->getId());

        $discussion->setCouple($couple);
        $discussion->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($discussion);
        $em->flush();
        return  ['success'=>'true','results'=>'discussion creer avec succee'];

    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/discussion/{id}",
     *     name = "app_discussion_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newDiscussion", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Modifier discussion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
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
     *      {"name"="titre", "dataType"="string", "required"=true, "description"="titre du discussion"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateTitreDiscussionAction(Discussion $discussion, Discussion $newDiscussion)
    {
        $discussion->setTitre($newDiscussion->getTitre());
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'discussion modifier avec succee'];
    }

    /**
     * @rest\Delete(
     *     path="/discussion/{id}",
     *     name="app_discussion_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Supprimer discussion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
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
    public function deleteDiscussionAction(Discussion $discussion)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($discussion);
        $em->flush();
        return  ['success'=>'true','results'=>'discussion supprimer avec succee'];

    }

    /**
     * @rest\Get(
     *     path="/discussion/{id}",
     *     name="app_discussion_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher discussion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
     *        }
     *     },
     *     statusCodes={
     *         200="discussion est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showDiscussionAction(Discussion $discussion)
    {
        return  ['success'=>'true','results'=>$discussion];

    }

//id prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/prestataire/discussion/{id}",
     *     name="app_discussionPresatataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Afficher liste des discussions d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list des discussions d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listDiscussion_By_PrestataireAction($prestataire)
    {
        $discussion_prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Discussion')->listDiscussion_By_Prestataire($prestataire);
        return  ['success'=>'true','results'=>$discussion_prestataire];

    }

  //id couple passe en parametre
    /**
     * @rest\Get(
     *     path="/couple/discussion/{id}",
     *     name="app_discussionCouple_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des discussions d'un couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="list des discussions d'un couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listDiscussion_By_CoupleAction($couple)
    {
        $discussion_couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Discussion')->listDiscussion_By_Couple($couple);
        return  ['success'=>'true','results'=>$discussion_couple];

    }

    /**
     * @rest\Get(
     *     path="/prestataire/discussion/nombre/{id}",
     *     name="app_nombreDiscussionPrestataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Afficher nombre des discussions d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="nombre des discussions d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function NbDiscussion_By_PrestataireAction($prestataire)
    {
        $nb_discussion=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Discussion')->NbDiscussion_By_Prestataire($prestataire);
        return  ['success'=>'true','results'=>$nb_discussion];

    }

    /**
     * @rest\Get(
     *     path="/couple/discussions/nombre/{id}",
     *     name="app_nombreDiscussionCouple_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher nombre des discussions d'un couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="nombre des discussions d'un couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function NbDiscussion_By_CoupleAction($couple)
    {
        $nb_discussion=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Discussion')->NbDiscussion_By_Couple($couple);
        return  ['success'=>'true','results'=>$nb_discussion];

    }

}