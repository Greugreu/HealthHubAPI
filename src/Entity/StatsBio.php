<?php

namespace App\Entity;

use App\Repository\StatsBioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsBioRepository::class)
 */
class StatsBio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, mappedBy="statsBio_idStatsBio", cascade={"persist", "remove"})
     */
    private $activityLog_idActivityLog;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

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

    public function getActivityLogIdActivityLog(): ?Users
    {
        return $this->activityLog_idActivityLog;
    }

    public function setActivityLogIdActivityLog(Users $activityLog_idActivityLog): self
    {
        // set the owning side of the relation if necessary
        if ($activityLog_idActivityLog->getStatsBioIdStatsBio() !== $this) {
            $activityLog_idActivityLog->setStatsBioIdStatsBio($this);
        }

        $this->activityLog_idActivityLog = $activityLog_idActivityLog;

        return $this;
    }
}
