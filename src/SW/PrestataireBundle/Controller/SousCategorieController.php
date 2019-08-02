<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 23/03/2018
 * Time: 15:49
 */

namespace SW\PrestataireBundle\Controller;
use SW\PrestataireBundle\Entity\SousCategorie;
use SW\PrestataireBundle\Entity\Categorie;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as rest;
use Nelmio\ApiDocBundle\Annotation as Doc;

class SousCategorieController extends FOSRestController
{

    /**
     * @rest\Post(
     *     path="/admin/souscategorie",
     *     name="app_souscategorie_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("sousCategorie", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Ajouter SousCategorie.",
     *      statusCodes={
     *         201="objet ajouter avec succee",
     *         400="probleme au niveau du requete(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *      parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de sous_categorie"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description du sous_categorie"},
     *      {"name"="icone", "dataType"="string", "required"=false, "description"="icone  du sous_categorie"},
     *      {"name"="categorie", "dataType"="objet", "required"=true, "description"="objet categorie"}
     *     }
     * )
     */
    public function createSousCategorieAction(SousCategorie $sousCategorie)

    {
        //return $sousCategorie;
        $obj=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Categorie')->find($sousCategorie->getCategorie()->getId());
        $sousCategorie->setCategorie($obj);

        $em=$this->getDoctrine()->getManager();
        $em->persist($sousCategorie);
        $em->flush();
        return  ['success'=>'true','results'=>'SousCategorie ajouter avec succee'];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/admin/souscategorie/{id}",
     *     name = "app_souscategorie_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newSousCategorie", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Modifier SousCategorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une SousCategorie."
     *        }
     *     },
     *    statusCodes={
     *         200="objet modifier avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de sous_categorie"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description du sous_categorie"},
     *      {"name"="icone", "dataType"="string", "required"=false, "description"="icone  du sous_categorie"},
     *      {"name"="categorie", "dataType"="objet", "required"=true, "description"="objet categorie"}
     *     }
     * )
     */
    public function updateSousCategorieAction(SousCategorie $sousCategorie, SousCategorie $newSousCategorie)
    {
        $categorie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Categorie')->find($newSousCategorie->getCategorie()->getId());

        $sousCategorie->setNom($newSousCategorie->getNom());
        $sousCategorie->setDescription($newSousCategorie->getDescription());
        $sousCategorie->setTotal($newSousCategorie->getTotal());
        $sousCategorie->setIcone($newSousCategorie->getIcone());
        $sousCategorie->setCategorie($categorie);
        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'SousCategorie modifier avec succee'];
    }

    /**
     *@rest\Delete(
     *     path="/admin/souscategorie/{id}",
     *     name="app_souscategorie_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Supprimer SousCategorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une SousCategorie."
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
    public function deleteSousCategorieAction(SousCategorie $sousCategorie)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($sousCategorie);
        $em->flush();
    }

    /**
     * @rest\Get(
     *     path="/souscategorie/{id}",
     *     name="app_souscategorie_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher SousCategorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une SousCategorie."
     *        }
     *     },
     *     statusCodes={
     *         200="sous_catégorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showSousCategorieAction(SousCategorie $sousCategorie)
    {
        return  ['success'=>'true','results'=>$sousCategorie];
    }

 //id mta3 categorie
    /**
     * @rest\Get(
     *     path="/souscategorie/list/{id}",
     *     name="app_listSousCategories_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des SousCategorie d'une categorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une Categorie."
     *        }
     *     },
     *     statusCodes={
     *         200="list sous_catégorie d'une categorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listSousCategories_By_CategorieAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:SousCategorie')->listSousCategories_By_Categorie($id);
        return  ['success'=>'true','results'=>$list];
    }

//id categorie passe en parametre resultat est list id de sousCategorie ,puis en affiche chaque id fiche depend de id sousCategorie et en supprimer
//et en fin je supprimer la liste de sousCategorie
    /**
     * @rest\Get(
     *     path="/souscategorie/listId/{id}",
     *     name="app_listIdSousCategories_By_categorie",
     *     requirements = {"id"="\d+"}
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher liste des id de SousCategorie d'une categorie.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une Categorie."
     *        }
     *     },
     *     statusCodes={
     *         200="list id de sous_catégorie d'une categorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listIdSousCategories_By_CategorieAction($categorie)
    {
        $listId=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:SousCategorie')->listIdSousCategories_By_Categorie($categorie);
        return  ['success'=>'true','results'=>$listId];
    }
    /**
     * @rest\Get(
     *     path="/list_sous_categories",
     *     name="app_sous_shows"
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
    public function listSousCategoriesAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:SousCategorie')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }
}