<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 03/04/2018
 * Time: 16:11
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\ListePromotions;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class ListePromotionsController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/Promotions",
     *     name="app_listePromotions_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("listePromotions", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Ajouter promotion.",
     *     statusCodes={
     *         201="objet creer avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="valeur", "dataType"="integer", "required"=true, "description"="valeur de promotion"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de promotion"},
     *      {"name"="date_debut", "dataType"="string", "required"=true, "description"="date debut de promotion"},
     *      {"name"="date_fin", "dataType"="string", "required"=true, "description"="date fin de promotion"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createListePromotionsAction(ListePromotions $listePromotions)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($listePromotions->getPrestataire()->getId());

        $listePromotions->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($listePromotions);
        $em->flush();
        return  ['success'=>'true','results'=>'promotion ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/Promotions/{id}",
     *     name = "app_listePromotions_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newPromotion", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier promotion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une promotion."
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
     *      {"name"="valeur", "dataType"="integer", "required"=true, "description"="valeur de promotion"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de promotion"},
     *      {"name"="date_debut", "dataType"="string", "required"=true, "description"="date debut de promotion"},
     *      {"name"="date_fin", "dataType"="string", "required"=true, "description"="date fin de promotion"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateListePromotionsAction(ListePromotions $listePromotions, ListePromotions $newPromotion)
    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($newPromotion->getPrestataire()->getId());

        $listePromotions->setPrestataire($prestataire);
        $listePromotions->setValeur($newPromotion->getValeur());
        $listePromotions->setDescription($newPromotion->getDescription());
        $listePromotions->setDateDebut($newPromotion->getDateDebut());
        $listePromotions->setDateFin($newPromotion->getDateFin());

        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'promotion modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/Promotions/{id}",
     *     name="app_listePromotions_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer promotion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une promotion."
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
    public function deleteListePromotionsAction(ListePromotions $listePromotions)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($listePromotions);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/Promotions/{id}",
     *     name="app_listePromotions_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher promotion.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une promotion."
     *        }
     *     },
     *     statusCodes={
     *         200="promotion est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPromotionsAction(ListePromotions $listePromotions)
    {
        return  ['success'=>'true','results'=>$listePromotions];
    }

    /**
     * @rest\Get(
     *     path="/couples/lesPromotions",
     *     name="app_lesPromotions_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher la liste des promotions.",
     *     statusCodes={
     *         200="list des promotions est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showLesPromotionsAction()
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:ListePromotions')->findAll();
        return  ['success'=>'true','results'=>$list];
    }

 //id mta3 prestataire
    /**
     * @rest\Get(
     *     path="/Promotions/{prestataire}",
     *     name="app_listePromotionsPrestataire_show",
     *     requirements={"prestataire"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher la promotion d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="liste des promotions d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function Promotions_By_PrestataireAction($prestataire)
    {
        $promortion=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:ListePromotions')->listePromotions_By_Prestataire($prestataire);
        return ['success'=>'true','results'=>$promortion];
    }

//id mta3 prestataire
    /**
     * @rest\Delete(
     *     path="/Promotions/delete/{prestataire}",
     *     name="app_deletePromotions_show",
     *     requirements={"prestataire"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Delete la promotion d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
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
    public function deletePromotions_By_PrestataireAction($prestataire)
    {
        $this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:ListePromotions')->deletePromotions_By_Prestataire($prestataire);

    }

}