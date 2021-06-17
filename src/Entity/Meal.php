<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MealRepository::class)
 */
class Meal
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $foodQuantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $alcoholQuantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="meal_idMeal")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users_idUsers;

    /**
     * @ORM\ManyToMany(targetEntity=FoodType::class, inversedBy="meal_idMeal")
     */
    private $foodType_idFoodType;

    public function __construct()
    {
        $this->foodType_idFoodType = new ArrayCollection();
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

    public function getFoodQuantity(): ?int
    {
        return $this->foodQuantity;
    }

    public function setFoodQuantity(?int $foodQuantity): self
    {
        $this->foodQuantity = $foodQuantity;

        return $this;
    }

    public function getAlcoholQuantity(): ?int
    {
        return $this->alcoholQuantity;
    }

    public function setAlcoholQuantity(?int $alcoholQuantity): self
    {
        $this->alcoholQuantity = $alcoholQuantity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUsersIdUsers(): ?Users
    {
        return $this->users_idUsers;
    }

    public function setUsersIdUsers(?Users $users_idUsers): self
    {
        $this->users_idUsers = $users_idUsers;

        return $this;
    }

    /**
     * @return Collection|foodType[]
     */
    public function getFoodTypeIdFoodType(): Collection
    {
        return $this->foodType_idFoodType;
    }

    public function addFoodTypeIdFoodType(foodType $foodTypeIdFoodType): self
    {
        if (!$this->foodType_idFoodType->contains($foodTypeIdFoodType)) {
            $this->foodType_idFoodType[] = $foodTypeIdFoodType;
        }

        return $this;
    }

    public function removeFoodTypeIdFoodType(foodType $foodTypeIdFoodType): self
    {
        $this->foodType_idFoodType->removeElement($foodTypeIdFoodType);

        return $this;
    }
}
