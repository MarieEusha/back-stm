<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"players_read"}
 *     }
 * )
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"players_read", "teams_read", "trainings_read", "trainingMisseds_read", "tactics_read", "stats_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"players_read", "tactics_read"})
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"players_read"})
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     * @Groups({"players_read"})
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"players_read"})
     */
    private $injured;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="players", cascade={"persist", "remove"}))
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"players_read", "trainings_read", "trainingMisseds_read", "stats_read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     * @Groups({"players_read"})
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=TrainingMissed::class, mappedBy="player")
     */
    private $trainingMisseds;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="player", orphanRemoval=true)
     */
    private $stats;

    public function __construct()
    {
        $this->trainingMisseds = new ArrayCollection();
        $this->stats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
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

    public function getInjured(): ?bool
    {
        return $this->injured;
    }

    public function setInjured(bool $injured): self
    {
        $this->injured = $injured;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $trainingMissed->setPlayer($this);
        }

        return $this;
    }

    public function removeTrainingMissed(TrainingMissed $trainingMissed): self
    {
        if ($this->trainingMisseds->contains($trainingMissed)) {
            $this->trainingMisseds->removeElement($trainingMissed);
            // set the owning side to null (unless already changed)
            if ($trainingMissed->getPlayer() === $this) {
                $trainingMissed->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stats[]
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stats $stat): self
    {
        if (!$this->stats->contains($stat)) {
            $this->stats[] = $stat;
            $stat->setPlayer($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getPlayer() === $this) {
                $stat->setPlayer(null);
            }
        }

        return $this;
    }
}
