<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 05/04/2018
 * Time: 16:11
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Discussion;
use SW\PrestataireBundle\Entity\LigneMessage;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class LigneMessageController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/message",
     *     name="app_message_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("ligneMessage", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Creer message.",
     *     statusCodes={
     *         201="objet creer avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="pseudo", "dataType"="string", "required"=true, "description"="pseudo"},
     *      {"name"="contenue", "dataType"="objet", "required"=true, "description"="contenu du message"},
     *      {"name"="destinataire", "dataType"="integer", "required"=true, "description"="identifiant de destinataire"},
     *      {"name"="expediteur", "dataType"="integer", "required"=true, "description"="identifiant du expediteur"},
     *      {"name"="date_envoie", "dataType"="datetime", "required"=true, "description"="date d'envoye de message"},
     *      {"name"="vue", "dataType"="boolean", "required"=true, "description"="pour definie si un message est lu ou non"},
     *      {"name"="discussion", "dataType"="objet", "required"=true, "description"="objet discussion avec id"}
     *     }
     * )
     */
    public function addMessageAction(LigneMessage $ligneMessage)

    {
        $disc=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Discussion')->find($ligneMessage->getDiscussion()->getId());

        $ligneMessage->setDiscussion($disc);

        $em=$this->getDoctrine()->getManager();
        $em->persist($ligneMessage);
        $em->flush();
        return  ['success'=>'true','results'=>'message ajouter avec succee'];
    }
//id connecte et discussion
    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "messages/vue/{id}/{discussion}",
     *     name = "app_vue_update",
     *     requirements = {"id"="\d+"}
     * )
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Modifier message pour devient comme lu  .",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un connecte."},
     *        {
     *          "name"="discussion",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
     *         }
     *       },
     *     statusCodes={
     *         200="objet modifier avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="pseudo", "dataType"="string", "required"=true, "description"="pseudo"},
     *      {"name"="contenue", "dataType"="objet", "required"=true, "description"="contenu du message"},
     *      {"name"="destinataire", "dataType"="integer", "required"=true, "description"="identifiant de destinataire"},
     *      {"name"="expediteur", "dataType"="integer", "required"=true, "description"="identifiant du expediteur"},
     *      {"name"="date_envoie", "dataType"="datetime", "required"=true, "description"="date d'envoye de message"},
     *      {"name"="vue", "dataType"="boolean", "required"=true, "description"="pour definie si un message est lu ou non"},
     *      {"name"="discussion", "dataType"="objet", "required"=true, "description"="objet discussion avec id"}
     *     }
     * )
     */
    public function updateVueAction($id,$discussion)
    {
        $this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:LigneMessage')->updateVue($id,$discussion);
        //$this->getDoctrine()->getManager()->flush();

        //return $ligneMessage;
        return  ['success'=>'true','results'=>'message marque comme lu'];
    }

    /**
     * @rest\Get(
     *     path="/message/{id}",
     *     name="app_message_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher message.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un message."
     *        }
     *     },
     *     statusCodes={
     *         200="message est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showMessageAction(LigneMessage $ligneMessage)
    {
        return  ['success'=>'true','results'=>$ligneMessage];
    }

 //id discussion passe en parametre
    /**
     * @rest\Get(
     *     path="/message/list/discussion/{discussion}",
     *     name="app_discussionMessages_show",
     *     requirements = {"discussion"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher list des messages par discussion .",
     *     requirements={
     *        {
     *          "name"="discussion",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
     *        }
     *     },
     *     statusCodes={
     *         200="list des messages d'une discussion est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listMessages_By_DiscussionAction($discussion)
    {
        $messages_discussion=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:LigneMessage')->listMessages_By_Discussion($discussion);
        return  ['success'=>'true','results'=>$messages_discussion];
    }

 //id connecte et id discussion passe en parametre
    /**
     * @rest\Get(
     *     path="/message/nombre/{id}/{discussion}",
     *     name="app_nbMessages_nonlu_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Nombre des messages non lu pour chaque utilisateur .",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un connecte."},
     *        {
     *          "name"="discussion",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une discussion."
     *         }
     *       },
     *     statusCodes={
     *         200="nombre des messages non lu d'un utilisateur est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nbMessages_nonLu_By_connecterAction($id,$discussion)
    {
        $nb_message=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:LigneMessage')->nbMessages_nonLu($id,$discussion);
        return  ['success'=>'true','results'=>$nb_message];
    }

}