<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CoachRepository::class)
 * @ApiResource(
 *     attributes={},
 *     normalizationContext={"groups"={"coachs_read"}},
 *     itemOperations={"GET", "PUT", "DELETE", "teamsCoach"={
 *          "method"="get",
 *          "path"="/coaches/{id}/teams",
 *          "controller"="App\Controller\TeamsByCoachController"
 *      }
 *     }
 * )
 */
class Coach
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"coachs_read", "teams_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="coaches", cascade={"persist", "remove"}))
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinColumn(onDelete="SET NULL")
     * @Groups({"coachs_read"})
     * @Assert\NotBlank(message="les informations de l'utilisateur sont obligatoires")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="coach")
     * @ORM\joinColumn(nullable=true, onDelete="SET NULL")
     * @Groups({"coachs_read"})
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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
            $this->teams[] = $coach;
            $team->setCoach($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getCoach() === $this) {
                $team->setCoach(null);
            }
        }

        return $this;
    }

}
