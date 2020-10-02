<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"trainings_read"}
 *     }
 * )
 */
class Training
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"trainings_read", "teams_read", "trainingMisseds_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"trainings_read", "trainingMisseds_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"trainings_read", "trainingMisseds_read"})
     */
    private $label;

    /**
     * @ORM\Column(type="text")
     * @Groups({"trainings_read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="trainings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"trainings_read"})
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=TrainingMissed::class, mappedBy="training")
     * @Groups({"trainings_read"})
     */
    private $trainingMisseds;

    public function __construct()
    {
        $this->trainingMisseds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return Collection|TrainingMissed[]
     */
    public function getTrainingMisseds(): Collection
    {
        return $this->trainingMisseds;
    }

    public function addTrainingMissed(TrainingMissed $trainingMissed): self
    {
        if (!$this->trainingMisseds->contains($trainingMissed)) {
            $this->trainingMisseds[] = $trainingMissed;
            $trainingMissed->setTraining($this);
        }

        return $this;
    }

    public function removeTrainingMissed(TrainingMissed $trainingMissed): self
    {
        if ($this->trainingMisseds->contains($trainingMissed)) {
            $this->trainingMisseds->removeElement($trainingMissed);
            // set the owning side to null (unless already changed)
            if ($trainingMissed->getTraining() === $this) {
                $trainingMissed->setTraining(null);
            }
        }

        return $this;
    }
}
