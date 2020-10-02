<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EncounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EncounterRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"encounters_read"}
 *     }
 * )
 */
class Encounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"encounters_read", "teams_read", "stats_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"encounters_read", "stats_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"encounters_read"})
     */
    private $labelOpposingTeam;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"encounters_read"})
     */
    private $categoryOpposingTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="encounters")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"encounters_read"})
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Tactic::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"encounters_read"})
     */
    private $tactic;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="encounter")
     * @Groups({"encounters_read"})
     */
    private $stats;

    public function __construct()
    {
        $this->stats = new ArrayCollection();
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

    public function getLabelOpposingTeam(): ?string
    {
        return $this->labelOpposingTeam;
    }

    public function setLabelOpposingTeam(string $labelOpposingTeam): self
    {
        $this->labelOpposingTeam = $labelOpposingTeam;

        return $this;
    }

    public function getCategoryOpposingTeam(): ?string
    {
        return $this->categoryOpposingTeam;
    }

    public function setCategoryOpposingTeam(string $categoryOpposingTeam): self
    {
        $this->categoryOpposingTeam = $categoryOpposingTeam;

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

    public function getTactic(): ?Tactic
    {
        return $this->tactic;
    }

    public function setTactic(?Tactic $tactic): self
    {
        $this->tactic = $tactic;

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
            $stat->setEncounter($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getEncounter() === $this) {
                $stat->setEncounter(null);
            }
        }

        return $this;
    }
}
