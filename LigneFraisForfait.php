<?php

namespace GSB\VisiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisForfait
 *
 * @ORM\Table(name="ligne_frais_forfait")
 * @ORM\Entity(repositoryClass="GSB\VisiteurBundle\Repository\LigneFraisForfaitRepository")
 */
class LigneFraisForfait
{
    /**
     * @ORM\ManyToOne(targetEntity="GSB\VisiteurBundle\Entity\FicheFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fichefrais;
            
     /**
     * @ORM\ManyToOne(targetEntity="GSB\VisiteurBundle\Entity\FraisForfait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fraisforfait;
            
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;
    

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=6)
     * 
     */
    private $mois;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return LigneFraisForfait
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneFraisForfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set fichefrais
     *
     * @param \GSB\VisiteurBundle\Entity\FicheFrais $fichefrais
     *
     * @return LigneFraisForfait
     */
    public function setFichefrais(\GSB\VisiteurBundle\Entity\FicheFrais $fichefrais)
    {
        $this->fichefrais = $fichefrais;

        return $this;
    }

    /**
     * Get fichefrais
     *
     * @return \GSB\VisiteurBundle\Entity\FicheFrais
     */
    public function getFichefrais()
    {
        return $this->fichefrais;
    }
    
    

    /**
     * Set idVisiteur
     *
     * @param string $idVisiteur
     *
     * @return LigneFraisForfait
     */
    public function setIdVisiteur($idVisiteur)
    {
        $this->id_visiteur = $idVisiteur;

        return $this;
    }

    /**
     * Get idVisiteur
     *
     * @return string
     */
    public function getIdVisiteur()
    {
        return $this->id_visiteur;
    }

    /**
     * Set fraisforfait
     *
     * @param \GSB\VisiteurBundle\Entity\FraisForfait $fraisforfait
     *
     * @return LigneFraisForfait
     */
    public function setFraisforfait(\GSB\VisiteurBundle\Entity\FraisForfait $fraisforfait)
    {
        $this->fraisforfait = $fraisforfait;

        return $this;
    }

    /**
     * Get fraisforfait
     *
     * @return \GSB\VisiteurBundle\Entity\FraisForfait
     */
    public function getFraisforfait()
    {
        return $this->fraisforfait;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
