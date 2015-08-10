<?php

namespace Mavrick\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mavrick\FirstBundle\Entity\User;
use Mavrick\FirstBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository("FirstBundle:User")->findAll();

        return $this->render('FirstBundle:Default:index.html.twig', array(
        	'users' => $user,
        	));
    }

    public function ajouterAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new UserType());

    	$request = $this->getRequest();
    	if ($request->isMethod('POST')) {
    		$form->bind($request);
    		$a = $form->getData();
    		$em->persist($a);	
    		$em->flush();
    		return $this->redirect($this->generateUrl("first_homepage"));
    	}
        return $this->render('FirstBundle:Default:SigIn.html.twig', array(
        	'form' => $form->createView(),
        	));
    }
    
}
