<?php

	namespace GSB\VisiteurBundle\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use GSB\VisiteurBundle\Entity\FraisForfait;
	use Doctrine\ORM\FraisForfaitRepository;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\DateType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\ResetType;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
        use GSB\VisiteurBundle\Form\FraisForfaitType;

	class FraisForfaitController extends Controller
{
	public function fraisforfaitAction(Request $query)
{
	// On crée un objet Candidat
	$fraisforfait = new FraisForfait();

	//$form = $this->get('form.factory')->createBuilder(FormType::class, $fraisforfait)
        $form = $this->createForm(FraisForfaitType::class, $fraisforfait);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	// On enregistre notre objet $advert dans la base de données, par exemple
	$em = $this->getDoctrine()->getManager();
	$em->persist($fraisforfait);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Frais forfait enregistré.');
	// On redirige vers la page de visualisation du candidat créé
	return new Response("Frais forfait crée.");

	}
}
// Erreur dans le formulaire => retour vers ce dernier
	return $this->render('GSBVisiteurBundle:Visiteur:vueFraisForfait.html.twig',
	array('form' => $form->createView(),));
	}
        
        function listeFraisForfaitAction() { 
            
        $em = $this->getDoctrine()->getManager();
        
        $valeur = $em->getRepository("GSBVisiteurBundle:FraisForfait")->listerFraisForfait();
        
        return $this->render('GSBVisiteurBundle:Visiteur:vueListerFraisForfait.html.twig',array('result'=>$valeur));
    }
    
        function modifieFraisForfaitAction(Request $query, $id,$montant) { 
            
        $fraisforfait = new FraisForfait();
            
        $em = $this->getDoctrine()->getManager();
        
        $valeur = $em->getRepository("GSBVisiteurBundle:FraisForfait")->modifierFraisForfait($id,$montant);
        
        //$fraisforfait->setId($id);
        //$em->persist($fraisforfait);
	$em->flush();
        
        $query->getSession()->getFlashBag()->add('notice', 'Frais forfait modifié.');
	// On redirige vers la page de visualisation du candidat créé
	
        return new Response("Frais forfait modifié.");
    }
        
}
