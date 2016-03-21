<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Enquete as Enquete;
use AppBundle\Entity\Questions as Questions;
use AppBundle\Entity\Alternatives as Alternatives;

class EnquetesController extends Controller
{
    /**
     * @Route("/add_survey", name="adicionar_enquete")
     */
    public function addAction()
    {
        return $this->render('surveys/add.html.twig');
    }

    /**
     * @Route("/save_survey", name="salvar_enquete")
     * @Method({"POST", "GET"})
     */
    public function saveSurveyAction()
    {
        $response = new Response();

        // requisitando os dados da chamada ajax
        $request = Request::createFromGlobals();
        $title = $request->request->get('title');
        $questions = $request->request->get('questions');

        // instanciando EntityManaget
        $em = $this->container->get('doctrine.orm.entity_manager');

        $enqueteObj = new Enquete();
        $enqueteObj->setTitle($title);
        $em->persist($enqueteObj);

        foreach($questions as $question){
            foreach($question as $k=>$q){
                if($k == 0){
                    $questionsObj = new Questions($q, $enqueteObj);
                    $em->persist($questionsObj);
                } else {
                    foreach($q as $alternative){
                        $alternativesObj = new Alternatives($alternative, $questionsObj);
                        $em->persist($alternativesObj);
                    }
                }
            }
        }
        $em->flush();

        $response->headers->set('Content-type', 'application/json; charset=utf-8');
        $answer = array('success' => 'true','message' => 'Enquete criada com sucesso!');
        $response->setContent(json_encode($answer));
        return $response;
    }

    /**
     * @Route("/answer/{id}", name="responder_enquete")
     * @Method("GET")
     */
    public function answerSurveyAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $survey = $em->getRepository('AppBundle:Enquete')->findOneById($id);

        return $this->render('surveys/answer.html.twig', array(
            'survey' => $survey
        ));
    }

    /**
     * @Route("/revise_survey", name="revisar_enquete")
     */
    public function reviseAction()
    {
        return $this->render('surveys/revise.html.twig', array('coisa' => 'coisa'));
    }
}
