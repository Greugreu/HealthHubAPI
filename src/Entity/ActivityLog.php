<?php

namespace App\Entity;

use App\Repository\ActivityLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityLogRepository::class)
 */
class ActivityLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $steps;

    /**
     * @ORM\Column(type="time")
     */
    private $length;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasDistance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="activityLog_idActivityLog")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users_idUsers;

    /**
     * @ORM\ManyToOne(targetEntity=ActivityType::class, inversedBy="activityLog_idActivityLog")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activityType_idActivityType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSteps(): ?int
    {
        return $this->steps;
    }

    public function setSteps(int $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    public function getLength(): ?\DateTimeInterface
    {
        return $this->length;
    }

    public function setLength(\DateTimeInterface $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getHasDistance(): ?bool
    {
        return $this->hasDistance;
    }

    public function setHasDistance(bool $hasDistance): self
    {
        $this->hasDistance = $hasDistance;

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

    public function getActivityTypeIdActivityType(): ?activityType
    {
        return $this->activityType_idActivityType;
    }

    public function setActivityTypeIdActivityType(?activityType $activityType_idActivityType): self
    {
        $this->activityType_idActivityType = $activityType_idActivityType;

        return $this;
    }
}
