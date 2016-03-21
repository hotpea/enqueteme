<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Enquete;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, $success_message = null)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $surveys = $em->getRepository('AppBundle:Enquete')->findAll();

        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'success_message' => $success_message,
            'surveys' => $surveys
        ));
    }
}
