<?php

	namespace GSB\VisiteurBundle\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use GSB\VisiteurBundle\Entity\Visiteur;
        use GSB\VisiteurBundle\Form\VisiteurType;
	use Symfony\Component\HttpFoundation\Request;
        use Symfony\Component\HttpFoundation\Response;


	class VisiteurController extends Controller
{
	public function visiteurAction(Request $query)
{
	// On crée un objet Candidat
	$visit = new Visiteur();

	//$form = $this->get('form.factory')->createBuilder(FormType::class, $visit)
        $form = $this->createForm(VisiteurType::class, $visit);

	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	// On enregistre notre objet $advert dans la base de données, par exemple
	$em = $this->getDoctrine()->getManager();
	$em->persist($visit);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Visiteur enregistré.');
	// On redirige vers la page de visualisation du candidat créé
	return new Response("Visiteur crée.");

	}
}
// Erreur dans le formulaire => retour vers ce dernier
	return $this->render('GSBVisiteurBundle:Visiteur:vueFormulaire.html.twig',
	array('form' => $form->createView(),));
	}
        
        function rechercherVisiteurAction($id) {
            
        $em = $this->getDoctrine()->getManager();
        
        $valeur = $em->getRepository("GSBVisiteurBundle:Visiteur")->listerVisiteur($id);
        
        return $this->render('GSBVisiteurBundle:Visiteur:rechercherVisiteur.html.twig',array('result'=>$valeur));
    }
}


