<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 12/03/2018
 * Time: 15:49
 */

namespace SW\PrestataireBundle\Controller;
use SW\PrestataireBundle\Entity\Prestataire;
use SW\PrestataireBundle\Entity\Ville;
use SW\PrestataireBundle\Entity\SousCategorie;
use SW\PrestataireBundle\Entity\ContactPersonne;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation as Doc;

class PrestataireController extends FOSRestController
{

    /**
     * @rest\Post(
     *     path="/prestataire",
     *     name="app_prestataire_create"
     *       )
     * @rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("prestataire", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Creer prestataire.",
     *     statusCodes={
     *         201="objet creer avec succee",
     *         400="probleme au niveau donnees json(ex manque de vergule)",
     *         500="probleme au niveau du serveur (verifier les champs inserer)",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     },
     *     parameters={
     *      {"name"="adresse", "dataType"="string", "required"=true, "description"="adresse de prestataire"},
     *      {"name"="code_postal", "dataType"="integer", "required"=true, "description"="code postal de prestataire"},
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de prestataire"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description"},
     *      {"name"="prix_min", "dataType"="integer", "required"=true, "description"="prix minimum pour un prestataire"},
     *      {"name"="nb_photo", "dataType"="integer", "required"=true, "description"="egale a 0 initialement"},
     *      {"name"="max_photo", "dataType"="integer", "required"=true, "description"="egale a 5 initialement"},
     *      {"name"="nb_video", "dataType"="integer", "required"=true, "description"="oegale a 0 initialement"},
     *      {"name"="max_video", "dataType"="integer", "required"=true, "description"="egale a 5 initialement"},
     *      {"name"="id_user", "dataType"="integer", "required"=true, "description"="identifiant du prestataire dans fos_user"},
     *      {"name"="activer", "dataType"="boolean", "required"=true, "description"="0 si compte desactiver(valeur par defaut) et 1 si activer "},
     *      {"name"="contact_personne", "dataType"="objet", "required"=true, "description"="objet contact_personne qui contient
      les attributs suivants: nom,email,telephone,telephone_portable,telephone_fax,site_internet"},
     *      {"name"="sous_categorie", "dataType"="objet", "required"=true, "description"="objet sous_categorie avec id"},
     *      {"name"="ville", "dataType"="objet", "required"=true, "description"="objet ville avec id"}
     *     }
     * )
     */
    public function createPrestataireAction(Prestataire $prestataire)
    {
        $sousCategorie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:SousCategorie')->find($prestataire->getSousCategorie()->getId());
        $ville=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Ville')->find($prestataire->getVille()->getId());

        $prestataire->setSousCategorie($sousCategorie);
        $prestataire->setVille($ville);

        $em=$this->getDoctrine()->getManager();
        $em->persist($prestataire);
        $em->flush();
        return  ['success'=>'true','results'=>'prestataire ajouter avec succee'];
        // return  ['success'=>'ok','results'=>$prestataire];
    }

    /**
     * @rest\View(StatusCode = 200)
     * @rest\Put(
     *     path = "/prestataire/{id}",
     *     name = "app_prestataire_update",
     *     requirements = {"id"="\d+"}
     * )
     * @ParamConverter("newPrestataire", converter="fos_rest.request_body")
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Modifier prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
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
     *      {"name"="adresse", "dataType"="string", "required"=true, "description"="adresse de prestataire"},
     *      {"name"="code_postal", "dataType"="integer", "required"=true, "description"="code postal de prestataire"},
     *      {"name"="nom", "dataType"="string", "required"=true, "description"="nom de prestataire"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="description"},
     *      {"name"="prix_min", "dataType"="integer", "required"=true, "description"="prix minimum pour un prestataire"},
     *      {"name"="nb_photo", "dataType"="integer", "required"=true, "description"="egale a 0 initialement"},
     *      {"name"="max_photo", "dataType"="integer", "required"=true, "description"="egale a 5 initialement"},
     *      {"name"="nb_video", "dataType"="integer", "required"=true, "description"="oegale a 0 initialement"},
     *      {"name"="max_video", "dataType"="integer", "required"=true, "description"="egale a 5 initialement"},
     *      {"name"="id_user", "dataType"="integer", "required"=true, "description"="identifiant du prestataire dans fos_user"},
     *      {"name"="contact_personne", "dataType"="objet", "required"=true, "description"="objet contact_personne qui contient
      les attributs suivants: nom,email,telephone,telephone_portable,telephone_fax,site_internet"},
     *      {"name"="sous_categorie", "dataType"="objet", "required"=true, "description"="objet sous_categorie avec id"},
     *      {"name"="ville", "dataType"="objet", "required"=true, "description"="objet ville avec id"}
     *     }
     * )
     */
    public function updatePrestataireAction(Prestataire $prestataire, Prestataire $newPrestataire)
    {
        $sousCategorie=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:SousCategorie')->find($newPrestataire->getSousCategorie()->getId());
        $ville=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Ville')->find($newPrestataire->getVille()->getId());

        $prestataire->setSousCategorie($sousCategorie);
        $prestataire->setVille($ville);
        $prestataire->setNom($newPrestataire->getNom());
        $prestataire->setDescription($newPrestataire->getDescription());
        $prestataire->setAdresse($newPrestataire->getAdresse());
        $prestataire->setCodePostal($newPrestataire->getCodePostal());
        $prestataire->setPrixMin($newPrestataire->getPrixMin());
        $prestataire->setIdUser($newPrestataire->getIdUser());

       //modifier contact_person
        $prestataire->getContactPersonne()->setNom($newPrestataire->getContactPersonne()->getNom());
        $prestataire->getContactPersonne()->setEmail($newPrestataire->getContactPersonne()->getEmail());
        $prestataire->getContactPersonne()->setTelephone($newPrestataire->getContactPersonne()->getTelephone());
        $prestataire->getContactPersonne()->setTelephonePortable($newPrestataire->getContactPersonne()->getTelephonePortable());
        $prestataire->getContactPersonne()->setTelephoneFax($newPrestataire->getContactPersonne()->getTelephoneFax());
        $prestataire->getContactPersonne()->setSiteInternet($newPrestataire->getContactPersonne()->getSiteInternet());

        $this->getDoctrine()->getManager()->flush();

        return  ['success'=>'true','results'=>'prestataire modifier avec succee'];
       // return  ['success'=>'true','results'=>$prestataire];
    }

    /**
     *@rest\Delete(
     *     path="/prestataire/{id}",
     *     name="app_prestataire_suprimer",
     *     requirements={"id"="\d+"}
     *       )
     * @rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Supprimer prestataire.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
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
    public function deletePrestataireAction(Prestataire $prestataire)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($prestataire);
        $em->flush();
        return  ['success'=>'true','results'=>'prestataire supprimer avec succee'];
    }

    /**
     * @rest\Get(
     *     path="/show_presataire/{prestataire}",
     *     name="app_prestataire_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher prestataire.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPrestataireAction(Prestataire $prestataire)
    {
        return  ['success'=>'true','results'=>$prestataire];
    }

    /**
     * @rest\Get(
     *     path="/prestataire/byUser/{id}",
     *     name="app_prestataire_show_by_iduser"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires",
     *     resource=true,
     *     description="Afficher prestataire par identifiant d'un user.",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un user."
     *        }
     *     },
     *     statusCodes={
     *         200="prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function showPrestataireByIdUserAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')-> showPrestataireByIdUser($id);
        return  ['success'=>'true','results'=>$list];
    }

 //id SousCategorie en parametre
    /**
     * @rest\Get(
     *     path="/couple/list_prestataire/{id}",
     *     name="app_listPrestatairesSousCategorie_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des prestataires d'une sous_categorie .",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un sous_categorie."
     *        }
     *     },
     *     statusCodes={
     *         200="list des prestataires d'un sous categorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPrestataires_By_SousCategorieAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->listPrestataire_By_SousCategorie($id);
        return  ['success'=>'true','results'=>$list];
    }
//id ville en parametre
    /**
     * @rest\Get(
     *     path="/couple/list_prstataire/{id}",
     *     name="app_listPrestatairesVille_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des prestataires d'une ville .",
     *     requirements={
     *        {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."
     *        }
     *     },
     *     statusCodes={
     *         200="list des prestataires dans une ville est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPrestataires_By_VilleAction($id)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->listPrestataire_By_Ville($id);
        return  ['success'=>'true','results'=>$list];
    }

    /**
     * @rest\Get(
     *     path="/couple/list_prstataire/{ville}/{souscategorie}",
     *     name="app_listPrestatairesVille_sousCategorie_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Couples",
     *     resource=true,
     *     description="Afficher liste des prestataires d'un sous_categorie et d'une ville .",
     *     requirements={
     *        {
     *          "name"="ville",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une ville."},
     *        {
     *          "name"="souscategorie",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'une souscategorie."
     *         }
     *       },
     *       statusCodes={
     *         200="list des prestataires dans une ville et d'un sous categorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPrestataires_By_Ville_SousCategorieAction($ville,$souscategorie)
    {
        $list=$this->getDoctrine()->getManager()->getRepository('SWPrestataireBundle:Prestataire')->listPrestataire_By_Ville_SousCategorie($ville,$souscategorie);
        return  ['success'=>'true','results'=>$list];
    }

    /**
     * @rest\Get(
     *     path="/nbPhoto/{prestataire}",
     *     name="app_nbPhoto_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher nombre des photos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="nombre des photos d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nbPhotosAction(Prestataire $prestataire)
    {
        return $prestataire->getNbPhoto();
    }

    /**
     * @rest\Get(
     *     path="/nbVideo/{prestataire}",
     *     name="app_nbVideo_show"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Prestataires/Couples",
     *     resource=true,
     *     description="Afficher nombre des videos d'un prestataire.",
     *     requirements={
     *        {
     *          "name"="prestataire",
     *          "dataType"="integer",
     *          "requirements"="\d+",
     *          "description"="identifiant unique d'un prestataire."
     *        }
     *     },
     *     statusCodes={
     *         200="nombre des videos d'un prestataire est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function nbVideoAction(Prestataire $prestataire)
    {
        return $prestataire->getNbVideo();
    }
    /**
     * @rest\Get(
     *     path="/list_prestataires",
     *     name="app_prestataires_shows"
     *          )
     * @rest\View
     * @Doc\ApiDoc(
     *     section="Administrateur",
     *     resource=true,
     *     description="Afficher liste des prestataires.",
     *     statusCodes={
     *         200="liste de catégorie est affiché",
     *         405="verifier la methode et l'url",
     *         401="probleme d'authentification"
     *     }
     * )
     */
    public function listPrestatairesAction()
    {
        $resultats=$this->getDoctrine()->getRepository('SWPrestataireBundle:Prestataire')->findAll();
        return  ['success'=>'true','results'=>$resultats];
    }

}