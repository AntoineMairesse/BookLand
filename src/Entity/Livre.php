<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use App\Validator as CustomAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @CustomAssert\ISBN()
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255", maxMessage="Le titre du livre ne doit pas dépasser 255 caractères !")
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(
     *    message="Veuillez entrer une valeur positive"
     * )
     */
    private $nbpages;

    /**
     * @ORM\Column(type="date")
     * @Assert\LessThanOrEqual(
     *     value="today",
     *     message="Veuillez entrer une date valide (pas dans le futur)"
     * )
     */
    private $date_de_parution;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *     min = 0,
     *     max = 20,
     *     notInRangeMessage="La note doit être comprise entre 0 et 20 !"
     * )
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="livres")
     * @Assert\NotBlank
     */
    private $genre;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="livres")
     * @Assert\NotBlank
     */
    private $auteur;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->genre = new ArrayCollection();
        $this->auteur = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbpages(): ?int
    {
        return $this->nbpages;
    }

    public function setNbpages(int $nbpages): self
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    public function getDateDeParution(): ?\DateTimeInterface
    {
        return $this->date_de_parution;
    }

    public function setDateDeParution(\DateTimeInterface $date_de_parution): self
    {
        $this->date_de_parution = $date_de_parution;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }
}
