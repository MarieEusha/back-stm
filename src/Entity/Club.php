<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"clubs_read"}}
 * )
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"clubs_read", "users_read", "admins_read", "coachs_read", "players_read", "trainings_read", "tactics_read", "encounters_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     * @Groups({"clubs_read", "users_read", "admins_read", "coachs_read", "players_read", "trainings_read", "tactics_read", "encounters_read"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="club", orphanRemoval=true)
     * @Groups({"clubs_read"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="club", orphanRemoval=true)
     * @Groups({"clubs_read"})
     */
    private $teams;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->teams = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setClub($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getClub() === $this) {
                $user->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setClub($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getClub() === $this) {
                $team->setClub(null);
            }
        }

        return $this;
    }
}
