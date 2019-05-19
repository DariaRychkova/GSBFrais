<?php

namespace GSB\VisiteurBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use GSB\VisiteurBundle\Entity\FraisForfait;
use GSB\VisiteurBundle\Entity\FicheFrais;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LigneFraisForfaitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $session = new Session();
        $id = $session->get('id');
        
        
        $builder
        /*->add('fichefrais', EntityType::class, array('class'=> FicheFrais::class,
'choice_label' => 'id'))*/
         ->add('fichefrais', EntityType::class, array('class'=> 'GSBVisiteurBundle:FicheFrais',
                       'query_builder' => function (EntityRepository $ep) use ($id) {
                        return $ep->createQueryBuilder('v')
                       ->where('v.id = :id')
                       ->setParameter('id', $id)   
                       ->orderBy('v.id', 'ASC'); }
                    ,'choice_label' => 'id'
                    ,'multiple'  => false
                    ,'required' => true
                    ,'placeholder' => '--- Choisir fiche frais ---'
                    ,'choice_label' => 'id' )) 
	->add('mois', TextType::class)
	->add('quantite', TextType::class)
        ->add('fraisforfait', EntityType::class, array('class'=> FraisForfait::class,
'choice_label' => 'libelle'))
	->add('Enregistrer', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GSB\VisiteurBundle\Entity\LigneFraisForfait'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gsb_visiteurbundle_lignefraisforfait';
    }


}
