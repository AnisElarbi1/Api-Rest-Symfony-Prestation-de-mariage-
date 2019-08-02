<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 03/04/2018
 * Time: 15:18
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Disponibilite;
use SW\PrestataireBundle\Entity\Prestataire;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class DisponibiliteController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/prestataire/disponibilite",
     *     name="app_disponibilite_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("disponibilite", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Ajouter disponibilite.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="date_debut", "dataType"="datetime", "required"=true, "description"="date debut de disponibilite"},
     *      {"name"="date_fin", "dataType"="datetime", "required"=true, "description"="date fin de disponibilite"},
     *      {"name"="note", "dataType"="string", "required"=false, "description"="note de disponibilite"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createDisponibiliteAction(Disponibilite $disponibilite)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($disponibilite->getPrestataire()->getId());

        $disponibilite->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($disponibilite);
        $em->flush();
        return  ['success'=>'true','results'=>'disponibilite ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/disponibilite/{id}",
     *     name = "app_disponibilite_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newDisponibilite", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier disponibilite.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une disponibilite."
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
     *      {"name"="date_debut", "dataType"="datetime", "required"=true, "description"="date debut de disponibilite"},
     *      {"name"="date_fin", "dataType"="datetime", "required"=true, "description"="date fin de disponibilite"},
     *      {"name"="note", "dataType"="string", "required"=false, "description"="note de disponibilite"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateDisponibiliteAction(Disponibilite $disponibilite, Disponibilite $newDisponibilite)
    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($newDisponibilite->getPrestataire()->getId());

        $disponibilite->setPrestataire($prestataire);
        $disponibilite->setNote($newDisponibilite->getNote());
        $disponibilite->setDateDebut($newDisponibilite->getDateDebut());
        $disponibilite->setDateFin($newDisponibilite->getDateFin());

        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'disponibilite modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/disponibilite/{id}",
     *     name="app_disponibilite_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer disponibilite.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une disponibilite."
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
    public function deleteDisponibiliteAction(Disponibilite $disponibilite)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($disponibilite);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/disponibilite/{id}",
     *     name="app_disponibilite_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher disponibilite.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une disponibilite."
     *        }
     *     },
     *     statusCodes={
     *         200="disponibilite est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showDisponibiliteAction(Disponibilite $disponibilite)
    {
        return  ['success'=>'true','results'=>$disponibilite];
    }

 //id mta3 prestataire
    /**
     * @rest\Get(
     *     path="/disponibilite/prestataire/{id}",
     *     name="app_disponibilitePrestataire_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des disponibilites d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="liste de disponibilite est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listDisponibilite_By_PrestataireAction($prestataire)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Disponibilite')->listDisponibilite_By_Prestataire($prestataire);
        return  ['success'=>'true','results'=>$list];
    }

 //id mta3 prestataire
    /**
     * @rest\Delete(
     *     path="/prestataire/disponibilite/delete/{id}",
     *     name="app_deleteDisponibilite_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer liste des disponibilites d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
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
     *  )
     */
    public function deleteDisponibilite_By_PrestataireAction($prestataire)
    {
        $this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Disponibilite')->deleteDisponibilite_By_Prestataire($prestataire);

    }

}