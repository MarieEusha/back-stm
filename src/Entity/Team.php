<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ApiResource(
 *     attributes={
 *     },
 *     normalizationContext={
 *       "groups"={"teams_read"}
 *     }
 * )
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"teams_read", "clubs_read", "players_read", "trainings_read", "tactics_read", "encounters_read", "coachs_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"teams_read", "clubs_read", "players_read", "trainings_read", "tactics_read", "encounters_read", "coachs_read"})
     * @Assert\NotBlank(message="Un nom d'équipe est obligatoire")
     * @Assert\Length(min="2", max="75", minMessage="Le nom d'équipe doit être compris entre 2 et 75 caractéres", maxMessage="Le nom d'équipe doit être compris entre 2 et 75 caractéres")
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"teams_read", "clubs_read", "players_read", "trainings_read", "tactics_read", "encounters_read", "coachs_read"})
     * @Assert\NotBlank(message="Une catégorie est obligatoire")
     * @Assert\Choice({"Cadet", "Junior", "Senior"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class)
     * @Groups({"teams_read"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"teams_read", "trainings_read", "tactics_read", "encounters_read"})
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="team")
     * @Groups({"teams_read"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="team", orphanRemoval=true)
     * @Groups({"teams_read"})
     */
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity=Tactic::class, mappedBy="team", orphanRemoval=true)
     * @Groups({"teams_read"})
     */
    private $tactics;

    /**
     * @ORM\OneToMany(targetEntity=Encounter::class, mappedBy="team")
     * @Groups({"teams_read"})
     */
    private $encounters;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->tactics = new ArrayCollection();
        $this->encounters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(?Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setTeam($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->contains($training)) {
            $this->trainings->removeElement($training);
            // set the owning side to null (unless already changed)
            if ($training->getTeam() === $this) {
                $training->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tactic[]
     */
    public function getTactics(): Collection
    {
        return $this->tactics;
    }

    public function addTactic(Tactic $tactic): self
    {
        if (!$this->tactics->contains($tactic)) {
            $this->tactics[] = $tactic;
            $tactic->setTeam($this);
        }

        return $this;
    }

    public function removeTactic(Tactic $tactic): self
    {
        if ($this->tactics->contains($tactic)) {
            $this->tactics->removeElement($tactic);
            // set the owning side to null (unless already changed)
            if ($tactic->getTeam() === $this) {
                $tactic->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Encounter[]
     */
    public function getEncounters(): Collection
    {
        return $this->encounters;
    }

    public function addEncounter(Encounter $encounter): self
    {
        if (!$this->encounters->contains($encounter)) {
            $this->encounters[] = $encounter;
            $encounter->setTeam($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->contains($encounter)) {
            $this->encounters->removeElement($encounter);
            // set the owning side to null (unless already changed)
            if ($encounter->getTeam() === $this) {
                $encounter->setTeam(null);
            }
        }

        return $this;
    }
}