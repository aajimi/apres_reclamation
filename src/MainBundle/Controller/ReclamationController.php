<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Reclamation controller.
 *
 * @Route("reclamation")
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     * @Route("/", name="reclamation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('MainBundle:Reclamation')->findAll();

        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }

    /**
     * Creates a new offreCovoiturage entity.
     *
     */
    public function newReclamationAction(Request $request)
    {
        $reclamation = new Reclamation();
        $reclamationForm = $this->createForm('MainBundle\Form\ReclamationType', $reclamation);
        $reclamationForm->handleRequest($request);

        if ($reclamationForm->isSubmitted() && $reclamationForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('ShowReclamationList', array('idOffre' => $reclamation->getIdoffre()));
        }

        return $this->render('@Main/Reclamations/ReclamationCovoiturage.html.twig', array(
            'reclamation' => $reclamation,
            'reclamationForm' => $reclamationForm->createView(),
        ));
    }

    /**
     * Finds and displays a reclamation entity.
     *
     */
    public function showReclamationAction()
    {
        //Reclamation $reclamation

        return $this->render('@Main/Reclamations/showReclamation.html.twig');
    }

    public function newSignalerAction()
    {
        //Reclamation $reclamation

        return $this->render('@Main/Reclamations/showSignaler.html.twig');
    }

}
