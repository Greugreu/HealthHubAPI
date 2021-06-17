<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=Meal::class, mappedBy="users_idUsers")
     */
    private $meal_idMeal;

    /**
     * @ORM\OneToOne(targetEntity=Consume::class, inversedBy="users", cascade={"persist", "remove"})
     */
    private $consume_idConsume;

    /**
     * @ORM\OneToOne(targetEntity=AdressBook::class, cascade={"persist", "remove"})
     */
    private $adressBook_idAdressBook;

    /**
     * @ORM\OneToOne(targetEntity=StatsBio::class, inversedBy="activityLog_idActivityLog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statsBio_idStatsBio;

    /**
     * @ORM\OneToMany(targetEntity=ActivityLog::class, mappedBy="users_idUsers")
     */
    private $activityLog_idActivityLog;

    public function __construct()
    {
        $this->meal_idMeal = new ArrayCollection();
        $this->activityLog_idActivityLog = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection|meal[]
     */
    public function getMealIdMeal(): Collection
    {
        return $this->meal_idMeal;
    }

    public function addMealIdMeal(meal $mealIdMeal): self
    {
        if (!$this->meal_idMeal->contains($mealIdMeal)) {
            $this->meal_idMeal[] = $mealIdMeal;
            $mealIdMeal->setUsersIdUsers($this);
        }

        return $this;
    }

    public function removeMealIdMeal(meal $mealIdMeal): self
    {
        if ($this->meal_idMeal->removeElement($mealIdMeal)) {
            // set the owning side to null (unless already changed)
            if ($mealIdMeal->getUsersIdUsers() === $this) {
                $mealIdMeal->setUsersIdUsers(null);
            }
        }

        return $this;
    }

    public function getConsumeIdConsume(): ?consume
    {
        return $this->consume_idConsume;
    }

    public function setConsumeIdConsume(?consume $consume_idConsume): self
    {
        $this->consume_idConsume = $consume_idConsume;

        return $this;
    }

    public function getAdressBookIdAdressBook(): ?adressBook
    {
        return $this->adressBook_idAdressBook;
    }

    public function setAdressBookIdAdressBook(?adressBook $adressBook_idAdressBook): self
    {
        $this->adressBook_idAdressBook = $adressBook_idAdressBook;

        return $this;
    }

    public function getStatsBioIdStatsBio(): ?statsBio
    {
        return $this->statsBio_idStatsBio;
    }

    public function setStatsBioIdStatsBio(statsBio $statsBio_idStatsBio): self
    {
        $this->statsBio_idStatsBio = $statsBio_idStatsBio;

        return $this;
    }

    /**
     * @return Collection|activityLog[]
     */
    public function getActivityLogIdActivityLog(): Collection
    {
        return $this->activityLog_idActivityLog;
    }

    public function addActivityLogIdActivityLog(activityLog $activityLogIdActivityLog): self
    {
        if (!$this->activityLog_idActivityLog->contains($activityLogIdActivityLog)) {
            $this->activityLog_idActivityLog[] = $activityLogIdActivityLog;
            $activityLogIdActivityLog->setUsersIdUsers($this);
        }

        return $this;
    }

    public function removeActivityLogIdActivityLog(activityLog $activityLogIdActivityLog): self
    {
        if ($this->activityLog_idActivityLog->removeElement($activityLogIdActivityLog)) {
            // set the owning side to null (unless already changed)
            if ($activityLogIdActivityLog->getUsersIdUsers() === $this) {
                $activityLogIdActivityLog->setUsersIdUsers(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
