<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 01/04/2018
 * Time: 21:30
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Evenement;
use SW\PrestataireBundle\Entity\Prestataire;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;
class EvenementController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="prestataire/evenement",
     *     name="app_evenement_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("evenement", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Creer evenement.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de l'evenement"},
     *      {"name"="type", "dataType"="string", "required"=true, "description"="type de l'evenement"},
     *      {"name"="date_debut", "dataType"="datetime", "required"=true, "description"="date debut de l'evenement"},
     *      {"name"="date_fin", "dataType"="datetime", "required"=true, "description"="date fin de l'evenement"},
     *      {"name"="ville", "dataType"="string", "required"=true, "description"="ville de l'evenement"},
     *      {"name"="adresse", "dataType"="string", "required"=true, "description"="adresse de l'evenement"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de l'evenement"},
     *      {"name"="image", "dataType"="string", "required"=true, "description"="image de l'evenement"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function creatEvenementAction(Evenement $evenement)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($evenement->getPrestataire()->getId());
        // return $ville->getPays();
        $evenement->setPrestataire($prestataire);
        $em=$this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();
        return  ['success'=>'true','results'=>'evenement ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "prestataire/evenement/{id}",
     *     name = "app_evenement_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newEvenement", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier evenement.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un evenement."
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
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de l'evenement"},
     *      {"name"="type", "dataType"="string", "required"=true, "description"="type de l'evenement"},
     *      {"name"="date_debut", "dataType"="datetime", "required"=true, "description"="date debut de l'evenement"},
     *      {"name"="date_fin", "dataType"="datetime", "required"=true, "description"="date fin de l'evenement"},
     *      {"name"="ville", "dataType"="string", "required"=true, "description"="ville de l'evenement"},
     *      {"name"="adresse", "dataType"="string", "required"=true, "description"="adresse de l'evenement"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description de l'evenement"},
     *      {"name"="image", "dataType"="string", "required"=true, "description"="image de l'evenement"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function updateEvenementAction(Evenement $evenement, Evenement $newEvenement)
    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($newEvenement->getPrestataire()->getId());

        $evenement->setPrestataire($prestataire);
        $evenement->setNom($newEvenement->getNom());
        $evenement->setAdresse($newEvenement->getAdresse());
        $evenement->setVille($newEvenement->getVille());
        $evenement->setImage($newEvenement->getImage());
        $evenement->setDescription($newEvenement->getDescription());
        $evenement->setType($newEvenement->getType());
        $evenement->setDateDebut($newEvenement->getDateDebut());
        $evenement->setDateFin($newEvenement->getDateFin());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'evenement modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="prestataire/evenement/{id}",
     *     name="app_evenement_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer evenement.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un evenement."
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
    public function deleteEvenementAction(Evenement $evenement)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/evenement/{id}",
     *     name="app_evenement_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher evenement.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un evenement."
     *        }
     *     },
     *     statusCodes={
     *         200="evenement est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showEvenementAction(Evenement $evenement)
    {
        return  ['success'=>'true','results'=>$evenement];
    }
 //id mta3 prestataire
    /**
     * @rest\Get(
     *     path="/evenement/prestataire/{id}",
     *     name="app_listEvenementsPrestataire_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher list des evenements d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="list des evenements est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listEvenements_By_PrestataireAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Evenement')->listEvenements_By_Prestataire($id);
        return  ['success'=>'true','results'=>$list];
    }

    /**
     * @rest\Get(
     *     path="/couple/evenement/list/{id}",
     *     name="app_listEvenementsville_show",
     *     requirements={"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher list des evenements dans une ville.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."
     *        }
     *     },
     *     statusCodes={
     *         200="list des evenements est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listEvenements_By_VilleAction($ville)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Evenement')->listEvenements_By_Ville($ville);
        return  ['success'=>'true','results'=>$list];
    }

//id  prestataire passe en parametre
    /**
     *@rest\Delete(
     *     path="/prestataire/evenement/list/{id}",
     *     name="app_deleteEvenement_By_Prestataire",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer les evenements d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         204="lsite des evenements supprimer avec succee",
     *         404="objet n'existe pas",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function deleteEvenement_By_PrestataireAction($id)
    {
        $this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Evenement')->deleteEvenement_By_Prestataire($id);
    }

}