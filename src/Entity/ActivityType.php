<?php

namespace App\Entity;

use App\Repository\ActivityTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityTypeRepository::class)
 */
class ActivityType
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
     * @ORM\OneToMany(targetEntity=ActivityLog::class, mappedBy="activityType_idActivityType")
     */
    private $activityLog_idActivityLog;

    public function __construct()
    {
        $this->activityLog_idActivityLog = new ArrayCollection();
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

    /**
     * @return Collection|ActivityLog[]
     */
    public function getActivityLogIdActivityLog(): Collection
    {
        return $this->activityLog_idActivityLog;
    }

    public function addActivityLogIdActivityLog(ActivityLog $activityLogIdActivityLog): self
    {
        if (!$this->activityLog_idActivityLog->contains($activityLogIdActivityLog)) {
            $this->activityLog_idActivityLog[] = $activityLogIdActivityLog;
            $activityLogIdActivityLog->setActivityTypeIdActivityType($this);
        }

        return $this;
    }

    public function removeActivityLogIdActivityLog(ActivityLog $activityLogIdActivityLog): self
    {
        if ($this->activityLog_idActivityLog->removeElement($activityLogIdActivityLog)) {
            // set the owning side to null (unless already changed)
            if ($activityLogIdActivityLog->getActivityTypeIdActivityType() === $this) {
                $activityLogIdActivityLog->setActivityTypeIdActivityType(null);
            }
        }

        return $this;
    }
}
