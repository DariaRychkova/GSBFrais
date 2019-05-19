<?php

namespace GSB\VisiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FicheFrais
 *
 * @ORM\Table(name="fiche_frais")
 * @ORM\Entity(repositoryClass="GSB\VisiteurBundle\Repository\FicheFraisRepository")
 */
class FicheFrais
{
    /**
     * @ORM\ManyToOne(targetEntity="GSB\VisiteurBundle\Entity\Visiteur")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $visiteur;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="GSB\VisiteurBundle\Entity\Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $etat;
    
    /**
     * @var int
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=6)
     */
    private $mois;

    /**
     * @var int
     *
     * @ORM\Column(name="nbJustificatifs", type="integer")
     */
    private $nbJustificatifs;

    /**
     * @var string
     *
     * @ORM\Column(name="montantValide", type="decimal", precision=10, scale=2)
     */
    private $montantValide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="date")
     */
    private $dateModif;


    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return FicheFrais
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set nbJustificatifs
     *
     * @param integer $nbJustificatifs
     *
     * @return FicheFrais
     */
    public function setNbJustificatifs($nbJustificatifs)
    {
        $this->nbJustificatifs = $nbJustificatifs;

        return $this;
    }

    /**
     * Get nbJustificatifs
     *
     * @return int
     */
    public function getNbJustificatifs()
    {
        return $this->nbJustificatifs;
    }

    /**
     * Set montantValide
     *
     * @param string $montantValide
     *
     * @return FicheFrais
     */
    public function setMontantValide($montantValide)
    {
        $this->montantValide = $montantValide;

        return $this;
    }

    /**
     * Get montantValide
     *
     * @return string
     */
    public function getMontantValide()
    {
        return $this->montantValide;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return FicheFrais
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }
    
    /**
     * Set visiteur
     *
     * @param \GSB\VisiteurBundle\Entity\Visiteur $visiteur
     *
     * @return FicheFrais
     */
    public function setVisiteur(\GSB\VisiteurBundle\Entity\Visiteur $visiteur)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * Get visiteur
     *
     * @return \GSB\VisiteurBundle\Entity\Visiteur
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }
    
    /**
     * Set etat
     *
     * @param \GSB\VisiteurBundle\Entity\Etat $etat
     *
     * @return FicheFrais
     */
    public function setEtat(\GSB\VisiteurBundle\Entity\Etat $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \GSB\VisiteurBundle\Entity\Etat
     */
    public function getEtat()
    {
        return $this->etat;
    }
    
    
    public function getFF()
    {
        $mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");
        return "Mois : ".$mois[ $this->mois - 1 ]." | Visiteur : ".$this->nom." ".$this->prenom ;
    }
    

    /**
     * Get id
     *
     * @return \int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return FicheFrais
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
