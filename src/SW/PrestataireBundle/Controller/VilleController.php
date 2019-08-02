<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 14/03/2018
 * Time: 16:24
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Pays;
use SW\PrestataireBundle\Entity\Ville;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class VilleController extends FOSRestController
{

    /**
     * @rest\Post(
     *     path="/admin/ville",
     *     name="app_ville_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("ville", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Ajouter une ville.",
     *      statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau du requete(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du ville"},
     *      {"name"="pays", "dataType"="objet", "required"=true, "description"="objet pays"}
     *     }
     * )
     */
    public function createVilleAction(Ville $ville)

    {
        $pays=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Pays')->find($ville->getPays()->getId());
       // return $ville->getPays();
        $ville->setPays($pays);
        $em=$this->getDoctrine()->getManager();
        $em->persist($ville);
        $em->flush();
        return  ['success'=>'true','results'=>'ville ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/admin/ville/{id}",
     *     name = "app_ville_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newVille", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Modifier une ville.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."
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
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du ville"},
     *      {"name"="pays", "dataType"="objet", "required"=true, "description"="objet pays"}
     *     }
     * )
     */
    public function updateVilleAction(Ville $ville, Ville $newVille)
    {
        $pays=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Pays')->find($newVille->getPays()->getId());

        $ville->setNom($newVille->getNom());
        $ville->setPays($pays);
        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'ville modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/admin/ville/{id}",
     *     name="app_ville_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Supprimer une ville.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."
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
    public function deleteVilleAction(Ville $ville)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($ville);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/admin/ville/{id}",
     *     name="app_ville_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Afficher une ville.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."
     *        }
     *     },
     *     statusCodes={
     *         200="ville est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showVilleAction(Ville $ville)
    {
        return  ['success'=>'true','results'=>$ville];
    }
//id mta3 pays
    /**
     * @rest\Get(
     *     path="/list_ville/pays/{id}",
     *     name="app_listVille_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des villes d'une pays.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une pays."
     *        }
     *     },
     *     statusCodes={
     *         200="list des villes d'une pays est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listVille_By_PaysAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Ville')->listVille_By_Pays($id);
        return  ['success'=>'true','results'=>$list];

    }

    /**
     * @rest\Get(
     *     path="/list_villes",
     *     name="app_listvilles_shows"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des villes.",
     *     statusCodes={
     *         200="list des villes est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listVilleAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:Ville')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }


}