<?php

namespace App\Entity;

use App\Repository\FoodTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodTypeRepository::class)
 */
class FoodType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAlcohol;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $extra = [];

    /**
     * @ORM\ManyToMany(targetEntity=Meal::class, mappedBy="foodType_idFoodType")
     */
    private $meal_idMeal;

    public function __construct()
    {
        $this->meal_idMeal = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIsAlcohol(): ?bool
    {
        return $this->isAlcohol;
    }

    public function setIsAlcohol(bool $isAlcohol): self
    {
        $this->isAlcohol = $isAlcohol;

        return $this;
    }

    public function getExtra(): ?array
    {
        return $this->extra;
    }

    public function setExtra(?array $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getMealIdMeal(): Collection
    {
        return $this->meal_idMeal;
    }

    public function addMealIdMeal(Meal $mealIdMeal): self
    {
        if (!$this->meal_idMeal->contains($mealIdMeal)) {
            $this->meal_idMeal[] = $mealIdMeal;
            $mealIdMeal->addFoodTypeIdFoodType($this);
        }

        return $this;
    }

    public function removeMealIdMeal(Meal $mealIdMeal): self
    {
        if ($this->meal_idMeal->removeElement($mealIdMeal)) {
            $mealIdMeal->removeFoodTypeIdFoodType($this);
        }

        return $this;
    }
}
