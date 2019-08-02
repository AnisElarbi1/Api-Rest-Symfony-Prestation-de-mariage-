<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 15/04/2018
 * Time: 22:26
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\FicheInformations;
use SW\PrestataireBundle\Entity\SousCategorie;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;

class FicheInformationsController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/ficheInformations",
     *     name="app_ficheInformations_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("ficheInformations", converter="fos_rest.request_body")
     */
    public function createFicheInformationsAction(FicheInformations $ficheInformations)

    {
        $sousCategorie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:SousCategorie')->find($ficheInformations->getSousCategorie()->getId());

        $ficheInformations->setSousCategorie($sousCategorie);

        $em=$this->getDoctrine()->getManager();
        $em->persist($ficheInformations);
        $em->flush();
        return $ficheInformations;
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/ficheInformations/{id}",
     *     name = "app_ficheInformations_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newficheInformations", converter="fos_rest.request_body")
     */
    public function updateFicheInformationsAction(FicheInformations $ficheInformations, FicheInformations $newficheInformations)
    {
        $ficheInformations->setNom($newficheInformations->getNom());
        $this->getDoctrine()->getManager()->flush();

        return $ficheInformations;
    }

    /**
     *@rest\Delete(
     *     path="/ficheInformations/{id}",
     *     name="app_ficheInformations_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     */
    public function deleteFicheInformationsAction(FicheInformations $ficheInformations)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($ficheInformations);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/ficheInformations/{id}",
     *     name="app_ficheInformations_show"
     *          )
     * @rest\View
     */
    public function showFicheInformationsAction(FicheInformations $ficheInformations)
    {
        return $ficheInformations;
    }

 //id  sousCategorie passe en parametre
    /**
     * @rest\Get(
     *     path="/sousCategorie/ficheInformations/{id}",
     *     name="app_ficheInformationsSousCategorie_show"
     *          )
     * @rest\View
     */
    public function showFicheInformations_By_SousCatgorieAction($id)
    {
        $ficheInformations=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:FicheInformations')->showFicheInformations_By_SousCatgorie($id);
        return $ficheInformations;
    }

//id  sousCategorie passe en parametre , je utiliser l'id retourne par cette methode  dans la methode deletefiche
    /**
     * @rest\Get(
     *     path="/sousCategorie/idFicheInformations/{id}",
     *     name="app_idFicheInformationsSousCategorie_show"
     *          )
     * @rest\View
     */
    public function idFicheInformations_By_SousCatgorieAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:FicheInformations')->idFicheInformations_By_SousCatgorie($id);
        return $list;
    }
}