<?php

	namespace GSB\VisiteurBundle\Controller;
        use Doctrine\ORM\LigneFraisForfaitRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use GSB\VisiteurBundle\Entity\LigneFraisForfait;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	
        use GSB\VisiteurBundle\Form\LigneFraisForfaitType;

	class LigneFraisForfaitController extends Controller
{
	public function lignefraisforfaitAction(Request $query)
{
	$lignefraisforfait = new LigneFraisForfait();
	$em = $this->getDoctrine()->getManager();
        $form = $this->createForm(LigneFraisForfaitType::class, $lignefraisforfait);
	$session = $query->getSession('levisi');
	$nbJustificatifs = $session->get('nbJustificatifs');
        //$id = $session->get('id');
        //echo $id;

	if ($session->has('compteur') != true ){

	$session->set('compteur',1);
	}

	$compteur = $session->get('compteur');

	if ($session->get('levisi')!= null){
		
		

			if ($query->isMethod('POST')) {
				$form->handleRequest($query);

				if ($form->isValid()) {

	
				$em->persist($lignefraisforfait);
				$em->flush();
				$query->getSession()->getFlashBag()->add('notice', 'Ligne Frais forfait enregistré.');
				if (  $compteur < $nbJustificatifs ){
					$compteur = $compteur +1;
					$session->set('compteur',$compteur);
	
			return $this->redirect('/lignefraisforfait/ajouter');
		}
				return $this->redirect('/lignefraishorsforfait/ajouter');
				
				
				}
			}
/*		while (  $compteur <= $nbJustificatifs ){
			$compteur = $compteur +1;
			$session->set('compteur',$compteur);
	
			return $this->redirect('/lignefraisforfait/ajouter');
		}
*/	
	
	}

	else { return new Response ("Non connecté(e)");}
	

return $this->render('GSBVisiteurBundle:Visiteur:vueLigneFraisForfait.html.twig',
	array('form' => $form->createView(),));
	}
        
        function listeLigneFraisForfaitAction($fichefrais) {
            
        $em = $this->getDoctrine()->getManager();
        
        $valeur = $em->getRepository("GSBVisiteurBundle:LigneFraisForfait")->listerLigneFraisForfait($fichefrais);
        
        return $this->render('GSBVisiteurBundle:Visiteur:listerLigneFraisForfait.html.twig',array('result'=>$valeur));
    }
    
    /*function modifieLigneFraisForfaitAction(Request $query, $fichefrais,$mois,$quantite) { 
            
        $lignefraisforfait = new LigneFraisForfait();
            
        $em = $this->getDoctrine()->getManager();
        
        $valeur = $em->getRepository("GSBVisiteurBundle:LigneFraisForfait")->modifierLigneFraisForfait($fichefrais,$mois,$quantite);
        
        //$fraisforfait->setId($id);
        //$em->persist($fraisforfait);
	$em->flush();
        
        $query->getSession()->getFlashBag()->add('notice', 'Ligne frais forfait modifié.');
	// On redirige vers la page de visualisation du candidat créé
	
        return new Response("Ligne frais forfait modifié.");
    }*/
    
    public function lignefraisforfaitModifAction(Request $query,$id)
{

	 $em = $this->getDoctrine()->getManager();
	$rep = $this->getDoctrine()->getManager()->getRepository('GSBVisiteurBundle:LigneFraisForfait') ;
	$lignefraisforfait= $rep->findOneById($id);
        $form = $this->createForm(LigneFraisForfaitType::class, $lignefraisforfait);
        
        if ($query->isMethod('POST')) {
				$form->handleRequest($query);

				if ($form->isValid()) {

	
				$em->persist($lignefraisforfait);
				$em->flush();
				$query->getSession()->getFlashBag()->add('notice', 'Ligne Frais forfait enregistré.');
				
			return new Response ('Modification effectuée.');
		}
	
	}

        return $this->render('GSBVisiteurBundle:Visiteur:vueLigneFraisForfait.html.twig',
                array('form' => $form->createView(),));
}

}


