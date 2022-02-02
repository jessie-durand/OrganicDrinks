<?php

namespace App\Entity;

use App\Entity\Drink;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryDrinkRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoryDrinkRepository::class)]
class CategoryDrink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'categoryDrink', targetEntity: Drink::class)]
    private $drink;

    public function __construct()
    {
        $this->drink = new ArrayCollection();
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

    /**
     * @return Collection|Drink[]
     */
    public function getDrink(): Collection
    {
        return $this->drink;
    }

    public function addDrink(Drink $drink): self
    {
        if (!$this->drink->contains($drink)) {
            $this->drink[] = $drink;
            $drink->setCategoryDrink($this);
        }

        return $this;
    }

    public function removeDrink(Drink $drink): self
    {
        if ($this->drink->removeElement($drink)) {
            // set the owning side to null (unless already changed)
            if ($drink->getCategoryDrink() === $this) {
                $drink->setCategoryDrink(null);
            }
        }

        return $this;
    }
}
