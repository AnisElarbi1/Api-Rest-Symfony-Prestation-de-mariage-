<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 02/04/2018
 * Time: 15:09
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Reservation;
use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class ReservationController extends  FOSRestController
{
    /**
     * @rest\Post(
     *     path="couple/reservation",
     *     name="app_reservation_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("reservation", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Ajouter reservation.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="statut", "dataType"="string", "required"=true, "description"="statut du reservation"},
     *      {"name"="temps_debut", "dataType"="datetime", "required"=true, "description"="date debut du reservation"},
     *      {"name"="temps_fin", "dataType"="datetime", "required"=true, "description"="date fin du reservation"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createReservationAction(Reservation $reservation)

    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($reservation->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($reservation->getPrestataire()->getId());

        $reservation->setCouple($couple);
        $reservation->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();
        return  ['success'=>'true','results'=>'reservation ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/reservation/{id}",
     *     name = "app_reservation_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newReservation", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Modifier reservation.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une reservation."
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
     *      {"name"="statut", "dataType"="string", "required"=true, "description"="statut du reservation"},
     *      {"name"="temps_debut", "dataType"="datetime", "required"=true, "description"="date debut du reservation"},
     *      {"name"="temps_fin", "dataType"="datetime", "required"=true, "description"="date fin du reservation"},
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateReservationAction(Reservation $reservation, Reservation $newReservation)
    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($newReservation->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($newReservation->getPrestataire()->getId());

        $reservation->setPrestataire($prestataire);
        $reservation->setCouple($couple);
        $reservation->setStatut($newReservation->getStatut());
        $reservation->setTempsDebut($newReservation->getTempsDebut());
        $reservation->setTempsFin($newReservation->getTempsFin());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'reservation modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/reservation/{id}",
     *     name="app_reservation_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Supprimer reservation.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une reservation."
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
    public function deleteReservationAction(Reservation $reservation)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        return  ['success'=>'true','results'=>'reservation supprimer avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/reservation/{id}",
     *     name="app_reservation_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher reservation.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une reservation."
     *        }
     *     },
     *     statusCodes={
     *         200="reservation est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showReservationAction(Reservation $reservation)
    {
        return  ['success'=>'true','results'=>$reservation];
    }
//id  prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/prestataire/reservation/{id}",
     *     name="app_reservationPrestataire_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Afficher les reservations d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list de reservation d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listReservation_By_PrestataireAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Reservation')->listReservation_By_Prestataire($id);
        return  ['success'=>'true','results'=>$list];
    }
//id  couple passe en parametre
    /**
     * @rest\Get(
     *     path="/couple/reservation/{id}",
     *     name="app_reservationCouple_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher les reservations d'un couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="list de reservation d'un couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listReservation_By_CoupleAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Reservation')->listReservation_By_Couple($id);
        return  ['success'=>'true','results'=>$list];
    }

}