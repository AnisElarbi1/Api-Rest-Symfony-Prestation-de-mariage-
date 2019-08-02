<?php
/**
 * Created by PhpStorm.
 * User: EL Arbi Anis
 * Date: 22/05/2018
 * Time: 10:43
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation as Doc;
/**
 * @RouteResource("login", pluralize=false)
 */
class RestLoginController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Doc\ApiDoc(
     *     section="Authentification",
     *     resource=true,
     *     description="Login."
     *
     * )
     */
    public function postAction()
    {
        // route handled by Lexik JWT Authentication Bundle
        throw new \DomainException('You should never see this');
    }
}