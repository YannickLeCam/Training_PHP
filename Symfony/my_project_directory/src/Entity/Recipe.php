<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[UniqueEntity('title')]
#[UniqueEntity('slug')]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min:5)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank()]
    private ?string $content = null;

    #[ORM\Column]

    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[LessThan(value:1440)] //La recette doit faire - de 24 h
    private ?int $duration = null;

    #[ORM\Column]
    private ?int $NbPersonne = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ingredients = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->NbPersonne;
    }

    public function setNbPersonne(?int $NbPersonne): static
    {
        $this->NbPersonne = $NbPersonne;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingrédients): static
    {
        $this->ingredients = $ingrédients;

        return $this;
    }
}
