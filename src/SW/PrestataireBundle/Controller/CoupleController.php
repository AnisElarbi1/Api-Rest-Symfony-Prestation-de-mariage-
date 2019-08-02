<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 24/03/2018
 * Time: 16:04
 */

namespace SW\PrestataireBundle\Controller;
use SW\PrestataireBundle\Entity\Couple;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class CoupleController extends FOSRestController
{

    /**
     * @rest\Post(
     *     path="/couple",
     *     name="app_couple_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("couple", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Creer couple.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du couple"},
     *      {"name"="date_mariage", "dataType"="Date Time", "required"=true, "description"="date de mariage du couple"},
     *      {"name"="image", "dataType"="string", "required"=false, "description"="nombre total du categorie"},
     *      {"name"="id_user", "dataType"="integer", "required"=true, "description"="reference de compte d'un couple"},
     *      {"name"="activer", "dataType"="boolean", "required"=true, "description"="0 si compte desactiver(valeur par defaut) et 1 si activer "},
     *      {"name"="ville", "dataType"="objet", "required"=true, "description"="objet ville avec id"}
     *     }
     * )
     */
    public function createCoupleAction(Couple $couple)

    {
        $ville=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Ville')->find($couple->getVille()->getId());

        $couple->setVille($ville);
        $em=$this->getDoctrine()->getManager();
        $em->persist($couple);
        $em->flush();
        return  ['success'=>'true','results'=>'couple ajouter avec succee'];
    }


    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/couple/{id}",
     *     name = "app_couple_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newCouple", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Modifier couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique du couple."
     *        }
     *     },
     *      statusCodes={
     *         200="objet modifier avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom du couple"},
     *      {"name"="date_mariage", "dataType"="Date Time", "required"=true, "description"="date de mariage du couple"},
     *      {"name"="image", "dataType"="string", "required"=false, "description"="nombre total du categorie"},
     *      {"name"="id_user", "dataType"="integer", "required"=true, "description"="reference de compte d'un couple"},
     *      {"name"="ville", "dataType"="objet", "required"=true, "description"="objet ville avec id"}
     *     }
     * )
     */
    public function updateCoupleAction(Couple $couple, Couple $newCouple)
    {
        $ville=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Ville')->find($newCouple->getVille()->getId());
        $couple->setVille($ville);
        $couple->setNom($newCouple->getNom());
        $couple->setDateMariage($newCouple->getDateMariage());
        $couple->setImage($newCouple->getImage());
        $couple->setIdUser($newCouple->getIdUser());

        $this->getDoctrine()->getManager()->flush();
        return  ['success'=>'true','results'=>'couple modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/couple/{id}",
     *     name="app_couple_suprimer",
     *     requirements={"id"="\d+"}
     * )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Supprimer couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique du couple."
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
    public function deleteCoupleAction(Couple $couple)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($couple);
        $em->flush();
        return  ['success'=>'true','results'=>'couple supprimer avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/list_couples",
     *     name="app_couples_shows"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Afficher liste des couples.",
     *     statusCodes={
     *         200="liste de catégorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listCouplesAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:Couple')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }

    /**
     * @rest\Get(
     *     path="/couple/{id}",
     *     name="app_couple_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique du couple."
     *        }
     *     },
     *     statusCodes={
     *         200="couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showCoupleAction(Couple $couple)
    {
        return  ['success'=>'true','results'=>$couple];
    }

    /**
     * @rest\Get(
     *     path="/couple/by_user/{user}",
     *     name="app_couple_show_by_iduser"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher couple par identifiant d'un user.",
     *     requirements={
     *        {
     *          "name"="user",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un user."
     *        }
     *     },
     *     statusCodes={
     *         200="couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showCoupleByIdUserAction($user)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')-> showCoupleByIdUser($user);
        return  ['success'=>'true','results'=>$list];
    }

}