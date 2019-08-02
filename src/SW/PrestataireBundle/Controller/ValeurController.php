<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 16/04/2018
 * Time: 10:16
 */

namespace SW\PrestataireBundle\Controller;

use SW\PrestataireBundle\Entity\Valeur;
use SW\PrestataireBundle\Entity\InformationSpecifique;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;


class ValeurController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/valeur",
     *     name="app_valeur_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("valeur", converter="fos_rest.request_body")
     */
    public function addValeurAction(Valeur $valeur)

    {
        $informationSpecifique=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:InformationSpecifique')->find($valeur->getInformationSpecifiques()->getId());

        $valeur->setInformationSpecifiques($informationSpecifique);

        $em=$this->getDoctrine()->getManager();
        $em->persist($valeur);
        $em->flush();
        return $valeur;
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/valeur/{id}",
     *     name = "app_valeur_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newValeur", converter="fos_rest.request_body")
     */
    public function updateValeurAction(Valeur $valeur, Valeur $newValeur)
    {
        $valeur->setValeur($newValeur->getValeur());
        $valeur->setPardefaut($newValeur->getPardefaut());

        $this->getDoctrine()->getManager()->flush();
        return $valeur;
    }

    /**
     *@rest\Delete(
     *     path="/valeur/{id}",
     *     name="app_valeur_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     */
    public function deleteValeurAction(Valeur $valeur)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($valeur);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/valeur/{id}",
     *     name="app_valeur_show"
     *          )
     * @rest\View
     */
    public function listValeursAction(Valeur $valeur)
    {
        return $valeur;
    }

 //id InformationSpecifique passe en parametre
    /**
     * @rest\Get(
     *     path="/informationSpecifique/valeurs/{id}",
     *     name="app_listValeurs_show"
     *          )
     * @rest\View
     */
    public function listValeurs_By_InformationSpecifiqueAction($id)
    {
        $listValeurs=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Valeur')->listValeurs_By_InformationSpecifique($id);
        return $listValeurs;
    }

}