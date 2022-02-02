<?php

namespace App\Entity;

use App\Entity\Drink;
use App\Entity\Benefit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $image;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Benefit::class, inversedBy: 'ingredients')]
    private $benefits;

    #[ORM\ManyToMany(targetEntity: Drink::class, mappedBy: 'ingredients')]
    private $drinks;

    public function __construct()
    {
        $this->benefits = new ArrayCollection();
        $this->drinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Benefit[]
     */
    public function getBenefits(): Collection
    {
        return $this->benefits;
    }

    public function addBenefit(Benefit $benefit): self
    {
        if (!$this->benefits->contains($benefit)) {
            $this->benefits[] = $benefit;
        }

        return $this;
    }

    public function removeBenefit(Benefit $benefit): self
    {
        $this->benefits->removeElement($benefit);

        return $this;
    }

    /**
     * @return Collection|Drink[]
     */
    public function getDrinks(): Collection
    {
        return $this->drinks;
    }

    public function addDrink(Drink $drink): self
    {
        if (!$this->drinks->contains($drink)) {
            $this->drinks[] = $drink;
            $drink->addIngredient($this);
        }

        return $this;
    }

    public function removeDrink(Drink $drink): self
    {
        if ($this->drinks->removeElement($drink)) {
            $drink->removeIngredient($this);
        }

        return $this;
    }
}
