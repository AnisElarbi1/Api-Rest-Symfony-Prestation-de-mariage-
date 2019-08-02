<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 14/03/2018
 * Time: 15:59
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Pays;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use SW\PrestataireBundle\Entity\Ville;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation as Doc;

class PaysController extends FOSRestController
{

    /**
     * @rest\Post(
     *     path="/admin/pays",
     *     name="app_pays_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("pays", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Ajouter pays.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau du requete(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du pays"},
     *      {"name"="flag", "dataType"="string", "required"=true, "description"="flag du pays"}
     *     }
     * )
     */
    public function createPaysAction(Pays $pays)
    {
        $em=$this->getDoctrine()->getManager();
        $em->persist($pays);
        $em->flush();
        return  ['success'=>'true','results'=>'pays ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/admin/pays/{id}",
     *     name = "app_pays_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newPays", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Modifier pays.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une pays."
     *        }
     *     },
     *     statusCodes={
     *         200="objet modifier avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du pays"},
     *      {"name"="flag", "dataType"="string", "required"=true, "description"="flag du pays"}
     *     }
     * )
     */
    public function updatePaysAction(Pays $pays, Pays $newPays)
    {

        $pays->setNom($newPays->getNom());
        $pays->setFlag($newPays->getFlag());
        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'pays modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/admin/pays/{id}",
     *     name="app_pays_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Supprimer une pays.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une pays."
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
    public function deletePaysAction(Pays $pays)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($pays);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/admin/pays/{id}",
     *     name="app_pays_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Afficher pays.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique du pays."
     *        }
     *     },
     *     statusCodes={
     *         200="pays est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPaysAction(Pays $pays)
    {
        return  ['success'=>'true','results'=>$pays];
    }

    /**
     * @rest\Get(
     *     path="/list_pays",
     *     name="app_listpays_shows"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des pays.",
     *     statusCodes={
     *         200="list des pays est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPaysAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:Pays')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }
}