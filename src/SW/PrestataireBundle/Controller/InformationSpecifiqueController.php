<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 15/04/2018
 * Time: 23:55
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\FicheInformations;
use SW\PrestataireBundle\Entity\InformationSpecifique;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;

class InformationSpecifiqueController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/informationSpecifique",
     *     name="app_informationSpecifique_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("informationSpecifique", converter="fos_rest.request_body")
     */
    public function addInformationSpecifiqueAction(InformationSpecifique $informationSpecifique)

    {
        $ficheInformations=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:FicheInformations')->find($informationSpecifique->getFicheInformations()->getId());

        $informationSpecifique->setFicheInformations($ficheInformations);

        $em=$this->getDoctrine()->getManager();
        $em->persist($informationSpecifique);
        $em->flush();
        return $informationSpecifique;
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/informationSpecifique/{id}",
     *     name = "app_informationSpecifique_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newinformationSpecifique", converter="fos_rest.request_body")
     */
    public function updateInformationSpecifiqueAction(InformationSpecifique $informationSpecifique, InformationSpecifique $newinformationSpecifique)
    {
        $informationSpecifique->setNom($newinformationSpecifique->getNom());
        $informationSpecifique->setType($newinformationSpecifique->getType());
        $informationSpecifique->setObligatoire($newinformationSpecifique->getObligatoire());

        $this->getDoctrine()->getManager()->flush();

        return $informationSpecifique;
    }

    /**
     *@rest\Delete(
     *     path="/informationSpecifique/{id}",
     *     name="app_informationSpecifique_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     */
    public function deleteInformationSpecifiqueAction(InformationSpecifique $informationSpecifique)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($informationSpecifique);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/informationSpecifique/{id}",
     *     name="app_informationSpecifique_show"
     *          )
     * @rest\View
     */
    public function showInformationSpecifiqueAction(InformationSpecifique $informationSpecifique)
    {
        return $informationSpecifique;
    }

}