<?php

	namespace GSB\VisiteurBundle\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use GSB\VisiteurBundle\Entity\FicheFrais;
	use Symfony\Component\HttpFoundation\Request;
        use Symfony\Component\HttpFoundation\Response;
        use GSB\VisiteurBundle\Form\FicheFraisType;
        use GSB\VisiteurBundle\Entity\Visiteur;
        use Symfony\Component\Form\Extension\Core\Type\TextType;
        use Symfony\Component\Form\Extension\Core\Type\SubmitType;


	class FicheFraisController extends Controller
{
	public function fichefraisAction(Request $query)
{
	// On crée un objet Candidat
	$fichefrais = new FicheFrais();
        
        $session = $query->getSession('levisi');
 
        //$form = $this->createFormBuilder($fichefrais)
        $form = $this->createForm(FicheFraisType::class, $fichefrais);
	$em = $this->getDoctrine()->getManager();
        

                //$data1 = array("data"=>$session);
               
                 //var_dump($data1);
        //$session = $query->getSession('levisi');

        if ($session->get('levisi')!= null){


			if ($query->isMethod('POST')) {
				$form->handleRequest($query);

					if ($form->isValid()) {
					$nbJustificatifs = $form["nbJustificatifs"]->getData();
                                        $id = $form["id"]->getData();
                                        $session->set('nbJustificatifs',$nbJustificatifs);   
                                        $session->set('id',$id);
					$em->persist($fichefrais);
					$em->flush();
					$query->getSession()->getFlashBag()->add('notice', 'Fiche frais enregistré.');
					
					
					return $this->redirect('/lignefraisforfait/ajouter');
					}
			}
		}
		else{
			return new Response("Non connecté(e)");
		}

	return $this->render('GSBVisiteurBundle:Visiteur:vueFicheFrais.html.twig',array('form'=> $form->createView(),));
	}
        
      /*  function listerFicheFraisAction($visiteur) { 
        $em = $this->getDoctrine()->getManager();
        $valeur = $em->getRepository("GSBVisiteurBundle:FicheFrais")->listerFicheFrais($visiteur);
        
        return $this->render('GSBVisiteurBundle:Visiteur:vueListerFicheFrais.html.twig',array('result'=>$valeur));
    }
    
    function ficheTerminerAction(){
	return new Response ("Fiche créée.");
        
        
    }*/   
        
        function listerFicheFraisAction(Request $query) { 
	$em = $this->getDoctrine()->getManager();
	if($this->get('session')->get('levisi') ==null){
		return new Response('Non connecté(e).');
	}else {
	
	$form = $this->createFormBuilder()
                ->add('date',TextType::class,array('required'=>false))
		->add('Valider', SubmitType::class)
		->getForm();
	
	if ($query->isMethod('POST')) {
		$form->handleRequest($query);

			if ($form->isValid()) {

			
				$date = $form["date"]->getData();
				if ($date !=null){

					$fichedate = $em->getRepository("GSBVisiteurBundle:FicheFrais")->dateFicheFrais($date);
					return $this->render('GSBVisiteurBundle:Visiteur:vueListerFicheFrais.html.twig',array('result'=>$fichedate,'form'=>$form->createView(),));
				}
				else {
					$visiteur = $this->get('session')->get('levisi')->getId();

					$valeur = $em->getRepository("GSBVisiteurBundle:FicheFrais")->listerFicheFrais($visiteur);
					return $this->render('GSBVisiteurBundle:Visiteur:vueListerFicheFrais.html.twig',array('result'=>$valeur,'form'=>$form->createView(),));
				}
			
			}
	}

		
		$visiteur = $this->get('session')->get('levisi')->getId();

		$valeur = $em->getRepository("GSBVisiteurBundle:FicheFrais")->listerFicheFrais($visiteur);
		
		return $this->render('GSBVisiteurBundle:Visiteur:vueListerFicheFrais.html.twig',array('result'=>$valeur,'form'=>$form->createView(),));
	    }
	}


   function fichefraisModifAction(Request $query,$id){
		$rep = $this->getDoctrine()->getManager()->getRepository('GSBVisiteurBundle:FicheFrais') ;
		$fichefrais= $rep->findOneById($id);
		$form = $this->createForm(FicheFraisType::class, $fichefrais);
		$em = $this->getDoctrine()->getManager();


			if ($query->isMethod('POST')) {
				$form->handleRequest($query);

					if ($form->isValid()) {
					$em->persist($fichefrais);
					$em->flush();
					$query->getSession()->getFlashBag()->add('notice', 'Fiche frais enregistré.');
					
					
					return new Response('Modification effectuée.');
					}
			}
		
		

	return $this->render('GSBVisiteurBundle:Visiteur:vueFicheFrais.html.twig',array('form'=> $form->createView(),));

    }
	function chercherFicheFraisAction($date){
		$rep = $this->getDoctrine()->getManager()->getRepository('GSBVisiteurBundle:FicheFrais') ;
		$fichefrais= $rep->findOneById($id);

	}	

        
}




