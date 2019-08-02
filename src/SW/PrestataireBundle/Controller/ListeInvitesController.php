<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 29/03/2018
 * Time: 11:47
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\ListeInvites;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class ListeInvitesController extends  FOSRestController
{
    /**
     * @rest\Post(
     *     path="/couple/listeInvites",
     *     name="app_listeInvites_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("listeInvites", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Ajouter invitee.",
     *      statusCodes={
     *         201="objet creer avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom d'invitée"},
     *      {"name"="prenom", "dataType"="string", "required"=true, "description"="prenom d'invitée"},
     *      {"name"="email", "dataType"="string", "required"=true, "description"="email d'invitée"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"}
     *     }
     * )
     */
    public function createListeInvitesAction(ListeInvites $listeInvites)

    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($listeInvites->getCouple()->getId());
        // return $ville->getPays();
        $listeInvites->setCouple($couple);
        $em=$this->getDoctrine()->getManager();
        $em->persist($listeInvites);
        $em->flush();
        return  ['success'=>'true','results'=>'invitee ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/couple/listeInvites/{id}",
     *     name = "app_listeInvites_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newlisteInvites", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Modifier invitee.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un invitee."
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
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom d'invitée"},
     *      {"name"="prenom", "dataType"="string", "required"=true, "description"="prenom d'invitée"},
     *      {"name"="email", "dataType"="string", "required"=true, "description"="email d'invitée"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"}
     *     }
     * )
     */
    public function updateListeInvitesAction(ListeInvites $listeInvites, ListeInvites $newlisteInvites)
    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($newlisteInvites->getCouple()->getId());
        $listeInvites->setCouple($couple);
        $listeInvites->setNom($newlisteInvites->getNom());
        $listeInvites->setPrenom($newlisteInvites->getPrenom());
        $listeInvites->setEmail($newlisteInvites->getEmail());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'invitee modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/couple/listeInvites/{id}",
     *     name="app_listeInvites_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Supprimer invitee.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un invitee."
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
    public function deleteListeInvitesAction(ListeInvites $listeInvites)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($listeInvites);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/couple/listeInvites/{id}",
     *     name="app_listeInvites_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des invitees.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'invitee."
     *        }
     *     },
     *     statusCodes={
     *         200="list des invitees est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showListeInvitesAction(ListeInvites $listeInvites)
    {
        return  ['success'=>'true','results'=>$listeInvites];
    }
//id mta3 couple
    /**
     * @rest\Get(
     *     path="/couple/listInvites/{couple}",
     *     name="app_listInvites_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des invitees d'un couple.",
     *     requirements={
     *        {
     *          "name"="couple",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="list des invitees d'un couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listInvites_By_CoupleAction($couple)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:ListeInvites')->listInvites_By_Couple($couple);
        return  ['success'=>'true','results'=>$list];

    }

}