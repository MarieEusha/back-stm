<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"trainings_read"}
 *     },
 *     denormalizationContext={
            "disable_type_enforcement"=true
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
     * @Assert\NotBlank(message="la date est obligatoire")
     * @Assert\Type(type="DateTime", message= "la date doit être au format YYYY-mm-dd")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"trainings_read", "trainingMisseds_read"})
     * @Assert\NotBlank(message="le label est obligatoire")
     * @Assert\Type(type="string", message="le label doit être une chaîne de caractères")
     * @Assert\Length(min="3", max="50", minMessage="le nom de l'entraînement doit faire entre 3 et 50 caractères", maxMessage="le nom de l'entraînement doit faire entre 3 et 50 caractéres")
     */
    private $label;

    /**
     * @ORM\Column(type="text")
     * @Groups({"trainings_read"})
     * @Assert\NotBlank(message="la description est obligatoire")
     * @Assert\Type(type="string", message="la description doit être un texte")
     * @Assert\Length(min="3", max="700", minMessage="le nom de l'entraînement doit faire entre 3 et 700 caractères", maxMessage="le nom de l'entraînement doit faire entre 3 et 700 caractéres")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="trainings")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({"trainings_read"})
     * @Assert\NotBlank(message="Les informations de l'équipe sont obligatoires")
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=TrainingMissed::class, mappedBy="training")
     * @ORM\JoinColumn(onDelete="SET NULL")
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

    public function setDate($date): self
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
