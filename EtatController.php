<?php

	namespace GSB\VisiteurBundle\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use GSB\VisiteurBundle\Entity\Etat;
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
        use GSB\VisiteurBundle\Form\EtatType;

	class EtatController extends Controller
{
	public function etatAction(Request $query)
{
	// On crée un objet Candidat
	$etat = new Etat();

	//$form = $this->get('form.factory')->createBuilder(FormType::class, $fraisforfait)
        $form = $this->createForm(EtatType::class, $etat);


	if ($query->isMethod('POST')) {
	$form->handleRequest($query);

	if ($form->isValid()) {
	// On enregistre notre objet $advert dans la base de données, par exemple
	$em = $this->getDoctrine()->getManager();
	$em->persist($etat);
	$em->flush();
	$query->getSession()->getFlashBag()->add('notice', 'Etat enregistré.');
	// On redirige vers la page de visualisation du candidat créé
	return new Response("Etat crée.");

	}
}
// Erreur dans le formulaire => retour vers ce dernier
	return $this->render('GSBVisiteurBundle:Visiteur:vueEtat.html.twig',
	array('form' => $form->createView(),));
	}
}


