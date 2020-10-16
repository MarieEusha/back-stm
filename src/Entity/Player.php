<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @ApiResource(
 *     attributes={"order"={"team.label", "user.lastName": "ASC"}},
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"players_read", "teams_read", "tactics_read"})
     * @Assert\NotBlank(message="l'url de l'image est obligatoire")
     * @Assert\Type(type="string", message="l'url de l'image doit être une chaîne de caractères")
     * @Assert\Length(min="3", max="255", minMessage="l'url de l'image doit faire entre 3 et 255 caractéres", maxMessage="l'url de l'image doit faire entre 3 et 255 caractéres")
     */
    private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"players_read"})
     * @Assert\Type(type="int", message="La taille du joueur doit être un nombre entier")
     * @Assert\Length(min="2", max="3", minMessage="La taille du joueur doit faire entre 2 et 3 chiffres", maxMessage="La taille du joueur doit faire entre 2 et 3 chiffres")
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"players_read"})
     * @Assert\Type(type="float", message="Le poids du joueur doit être un nombre décimal")
     * @Assert\Length(min="2", max="3", minMessage="Le poids du joueur doit faire entre 2 et 3 chiffres", maxMessage="Le poids du joueur doit faire entre 2 et 3 chiffres")
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
     * @Groups({"players_read", "trainings_read", "trainingMisseds_read", "stats_read", "teams_read"})
     * @Assert\NotBlank(message="Les informations du joueur sont obligatoires")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     * @Groups({"players_read"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=TrainingMissed::class, mappedBy="player")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $trainingMisseds;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="player", orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="SET NULL")
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
