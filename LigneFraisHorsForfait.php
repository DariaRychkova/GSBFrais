<?php

namespace GSB\VisiteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisHorsForfait
 *
 * @ORM\Table(name="ligne_frais_hors_forfait")
 * @ORM\Entity(repositoryClass="GSB\VisiteurBundle\Repository\LigneFraisHorsForfaitRepository")
 */
class LigneFraisHorsForfait

{
    /**
     * @ORM\ManyToOne(targetEntity="GSB\VisiteurBundle\Entity\FicheFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fichefrais;
    
    
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
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2)
     */
    private $montant;


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return LigneFraisHorsForfait
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LigneFraisHorsForfait
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return LigneFraisHorsForfait
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }


    /**
     * Set fichefrais
     *
     * @param \GSB\VisiteurBundle\Entity\FicheFrais $fichefrais
     *
     * @return LigneFraisHorsForfait
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
