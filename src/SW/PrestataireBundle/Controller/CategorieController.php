<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 23/03/2018
 * Time: 00:19
 */

namespace SW\PrestataireBundle\Controller;
use SW\PrestataireBundle\Entity\Categorie;
use SW\PrestataireBundle\Entity\SousCategorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation as Doc;

class CategorieController extends FOSRestController
{
    /**
     * @rest\Post(
     *     path="/admin/categorie",
     *     name="app_categorie_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("categorie", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Ajouter categorie.",
     *     statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom categorie"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description du categorie"},
     *      {"name"="total", "dataType"="integer", "required"=true, "description"="nombre total du categorie"},
     *      {"name"="icone", "dataType"="string", "required"=false, "description"="icone  du categorie"}
     *     }
     * )
     */
    public function createCategorieAction(Categorie $categorie)
    {
        $em=$this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();
        return  ['success'=>'true','results'=>'categorie ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/admin/categorie/{id}",
     *     name = "app_categorie_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newCategorie", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Modifier categorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une categorie."
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
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom categorie"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description du categorie"},
     *      {"name"="total", "dataType"="integer", "required"=true, "description"="nombre total du categorie"},
     *      {"name"="icone", "dataType"="string", "required"=false, "description"="icone  du categorie"}
     *     }
     * )
     */
    public function updateCategorieAction(Categorie $categorie, Categorie $newCategorie)
    {

        $categorie->setNom($newCategorie->getNom());
        $categorie->setDescription($newCategorie->getDescription());
        $categorie->setTotal($newCategorie->getTotal());
        $categorie->setIcone($newCategorie->getIcone());
        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'categorie modifier avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/categories",
     *     name="app_categories_shows"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des categories.",
     *     statusCodes={
     *         200="liste de catégorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listCategoriesAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:Categorie')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }

    /**
     * @rest\Get(
     *     path="/categorie/{id}",
     *     name="app_categorie_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher categorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique du categorie."
     *        }
     *     },
     *     statusCodes={
     *         200="catégorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showCategorieAction(Categorie $categorie)
    {
        return  ['success'=>'true','results'=>$categorie];
    }

    /**
     *@rest\Delete(
     *     path="/admin/categorie/{id}",
     *     name="app_categorie_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="supprimer categorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une categorie."
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
    public function deleteCategorieAction(Categorie $categorie)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
    }
}