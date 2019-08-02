<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 16/04/2018
 * Time: 12:11
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\LigneInformation;
use SW\PrestataireBundle\Entity\Prestataire;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;

class LigneInformationController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/ligneInformation",
     *     name="app_ligneInformation_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("ligneInformation", converter="fos_rest.request_body")
     */
    public function addLigneInformationAction(LigneInformation $ligneInformation)

    {
        $prestataire=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->find($ligneInformation->getPrestataire()->getId());

        $ligneInformation->setPrestataire($prestataire);

        $em=$this->getDoctrine()->getManager();
        $em->persist($ligneInformation);
        $em->flush();
        return $ligneInformation;
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/ligneInformation/{id}",
     *     name = "app_ligneInformation_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newligneInformation", converter="fos_rest.request_body")
     */
    public function updateLigneInformationAction(LigneInformation $ligneInformation, LigneInformation $newligneInformation)
    {
        $ligneInformation->setNom($newligneInformation->getNom());
        $ligneInformation->setIcone($newligneInformation->getIcone());
        $ligneInformation->setContenu($newligneInformation->getIcone());

        $this->getDoctrine()->getManager()->flush();

        return $ligneInformation;
    }

    /**
     *@rest\Delete(
     *     path="/ligneInformation/{id}",
     *     name="app_ligneInformation_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     */
    public function deleteLigneInformationAction(LigneInformation $ligneInformation)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($ligneInformation);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/ligneInformation/{id}",
     *     name="app_ligneInformation_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     */
    public function showLigneInformationAction(LigneInformation $ligneInformation)
    {
        return $ligneInformation;
    }

//id  prestataire passe en parametre
    /**
     * @rest\Get(
     *     path="/prestataire/ligneInformation/{id}",
     *     name="app_ligneInformation_By_Prestataire_show",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     */
    public function listLigneInformation_By_PrestataireAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:LigneInformation')->listLigneInformation_By_Prestataire($id);
        return $list;
    }

 //id  prestataire passe en parametre
    /**
     *@rest\Delete(
     *     path="/prestataire/deleteligneInformation/{id}",
     *     name="app_deleteligneInformation_By_Prestataire",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     */
    public function deleteLignesInformation_By_PrestataireAction($id)
    {
        $this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:LigneInformation')->deleteLignesInformation_By_Prestataire($id);

    }
}