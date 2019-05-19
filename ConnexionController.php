<?php

namespace GSB\VisiteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\Session;

use GSB\VisiteurBundle\Entity\Visiteur;
use Doctrine\ORM\VisiteurRepository;

class ConnexionController extends Controller{

public function connecterAction(Request $query) {
	$session= new Session();
       
	$login=$password=null;
		
		
	if($session->get('levisi')!= null){
            //echo $session;
		//return new Response ('Déjà connecté(e)');
            return $this->render('GSBVisiteurBundle:Visiteur:Accueil.html.twig');
                
	}
	else{


		$connexion = new Visiteur(); // contient les attributs login, mdp et profil
		$form = $this->createFormBuilder($connexion)
		->add('login',TextType::class)
		->add('mdp',PasswordType::class)
		->add('valider',SubmitType::class)
		->add('annuler',ResetType::class)
		->getForm();
                
           
		
		if ($query->isMethod('POST')) {
			$form->handleRequest($query);
		}
		if ( $form->isSubmitted() && $form->isValid()) {
			$data = $query->request->get('form');		
			$login= $data['login'];	
			$password = $data['mdp'];
                       


		$rep = $this->getDoctrine()->getManager()->getRepository('GSBVisiteurBundle:Visiteur') ;
		
                $vis= $rep->findOneBylogin($login);

                
		
			if( $vis != null && $vis->getmdp()==$password){
			
				$session->set('levisi',$vis);
                                
				return $this->render('GSBVisiteurBundle:Visiteur:Accueil.html.twig',array('levisi'=>$session));
			}

		else { 
			return $this->render('GSBVisiteurBundle:Visiteur:vueConnexion.html.twig',array('form'=>$form->createView(),'test'=>'Login et/ou mot de passe incorrect(s) '));
			}

		}	
		}
                
                
		return $this->render('GSBVisiteurBundle:Visiteur:vueConnexion.html.twig',array('form'=>$form->createView(),));
                

}
public function deconnecterAction(Request $request){
	 $session = $request->getSession('levisi');
	$session->set('levisi',null);
	$session->set('nbJustificatifs',null);

	 return $this->redirect('/');

}
	
public function accueilAction(Request $request){
	$session = $request->getSession('levisi');
	if ($session->get('levisi')== null){
            return new Response('Non connecté(e)');
             
           
	}
	else{
		return $this->render('GSBVisiteurBundle:Visiteur:Accueil.html.twig',array('levisi'=>$session));
}

}
}