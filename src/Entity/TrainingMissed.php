<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TrainingMissedRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TrainingMissedRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"trainingMisseds_read"}
 *     }
 * )
 */
class TrainingMissed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"trainingMisseds_read", "trainings_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Training::class, inversedBy="trainingMisseds")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"trainingMisseds_read"})
     * @Assert\NotBlank(message="Les informations de l'entraînement sont obligatoires")
     * @Assert\Type(type="int", message="la valeur choisie doit être un int")
     * @Assert\Length(min="1", max="6", minMessage="L'id de l'entraînement doit faire entre 1 et 6 chiffres", maxMessage="L'id de l'entraînement doit faire entre 1 et 6 chiffres")
     */
    private $training;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="trainingMisseds")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({"trainingMisseds_read", "trainings_read"})
     * @Assert\NotBlank(message="les informations du joueur sont obligatoires")
     * @Assert\Type(type="int", message="la valeur choisie doit être un int")
     * @Assert\Length(min="1", max="6", minMessage="L'id du joueur doit faire entre 1 et 6 chiffres", maxMessage="L'id du joueur doit faire entre 1 et 6 chiffres")
     */
    private $player;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }
}
