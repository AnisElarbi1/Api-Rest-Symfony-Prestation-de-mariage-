<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 02/04/2018
 * Time: 10:43
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Administrateur;
use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class AdministrateurController extends FOSRestController
{

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/admin/{id}",
     *     name = "app_admin_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newAdministrateur", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Modifier administrateur.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un admin."
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
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de l'administrateur"},
     *      {"name"="telephone", "dataType"="string", "required"=true, "description"="telephone de l'administrateur"},
     *      {"name"="id_user", "dataType"="integer", "required"=true, "description"="reference de compte de l'utilisateur"}
     *     }
     * )
     */
    public function updateAdminAction(Administrateur $administrateur, Administrateur $newAdministrateur)
    {
        $administrateur->setNom($newAdministrateur->getNom());
        $administrateur->setTelephone($newAdministrateur->getTelephone());
        $this->getDoctrine()->getManager()->flush();

        return ['success' => 'true', 'results' => 'administrateur modifier avec succee'];
    }
    /**
     * @rest\Get(
     *     path="/admin/{id}",
     *     name="app_admin_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Afficher Administrateur.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un admin."
     *        }
     *     },
     *     statusCodes={
     *         200="administrateur est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showAdminAction(Administrateur $administrateur)
    {
        return  ['success'=>'true','results'=>$administrateur];
    }

    /**
     * @rest\Get(
     *     path="/admin/activer/prestataire/{id}",
     *     name="app_activerPresatataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Activer prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="prestataire activer",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
                                                                    public function activerPrestataireAction(Prestataire $prestataire)
    {
        $prestataire->setActiver(true);
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'compte prestataire activer'];
    }

    /**
     * @rest\Get(
     *     path="/admin/desactiver/prestataire/{id}",
     *     name="app_desactiverPresatataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Desactiver prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="prestataire desactiver",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function desactiverPrestataireAction(Prestataire $prestataire)
    {
        $prestataire->setActiver(false);
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'compte prestataire desactiver'];
    }

    /**
     * @rest\Get(
     *     path="/admin/activer/couple/{id}",
     *     name="app_activerCouple_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Activer couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="couple activer",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function activerCoupleAction(Couple $couple)
    {
        $couple->setActiver(true);
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'compte couple activer'];
    }

    /**
     * @rest\Get(
     *     path="/admin/desactiver/couple/{id}",
     *     name="app_desactiverCouple_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Desactiver couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="couple desactiver",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function desactiverCoupleAction(Couple $couple)
    {
        $couple->setActiver(false);
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'compte couple desactiver'];
    }

}