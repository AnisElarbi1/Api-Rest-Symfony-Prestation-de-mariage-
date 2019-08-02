<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 02/04/2018
 * Time: 01:02
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Favoris;
use SW\PrestataireBundle\Entity\Couple;
use SW\PrestataireBundle\Entity\Prestataire;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class FavorisController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/couple/favoris",
     *     name="app_favoris_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("favoris", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Ajouter favoris.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="couple", "dataType"="objet", "required"=true, "description"="objet couple avec id"},
     *      {"name"="prestataire", "dataType"="objet", "required"=true, "description"="objet prestataire avec id"}
     *     }
     * )
     */
    public function createFavorisAction(Favoris $favoris)

    {
        $couple=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Couple')->find($favoris->getCouple()->getId());
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($favoris->getPrestataire()->getId());

        $favoris->setCouple($couple);
        $favoris->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($favoris);
        $em->flush();
        return  ['success'=>'true','results'=>'favoris ajouter avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/couple/favoris/{id}",
     *     name="app_favoris_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Supprimer favoris.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une favoris."
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
    public function deleteFavorisAction(Favoris $favoris)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($favoris);
        $em->flush();
        return  ['success'=>'true','results'=>'favoris supprimer avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/couple/favoris/{id}",
     *     name="app_favoris_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher favoris.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un favoris."
     *        }
     *     },
     *     statusCodes={
     *         200="favoris est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showFavorisAction(Favoris $favoris)
    {
        return  ['success'=>'true','results'=>$favoris];
    }
 //id mta3 couple
    /**
     * @rest\Get(
     *     path="/couple/favoris/list/{id}",
     *     name="app_listFavoris_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des favoris d'un couple.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un couple."
     *        }
     *     },
     *     statusCodes={
     *         200="list des favoris d'un couple est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listFavoris_By_CoupleAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Favoris')->listFavoris_By_Couple($id);
        return  ['success'=>'true','results'=>$list];
    }

}