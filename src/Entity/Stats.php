<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsRepository", repositoryClass=StatsRepository::class)
 * @ApiResource(
 *     attributes={

 *     },
 *     normalizationContext={
            "groups"={"stats_read"}
 *     },
 *     denormalizationContext={
 *          "disable_type_enforcement"=true
 *     }
 * )
 */
class Stats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"stats_read", "encounters_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stats_read"})
     * @Assert\Type(type="integer", message="le nombre de carton rouge doit être un chiffre entier")
     * @Assert\PositiveOrZero(message="le nombre de carton rouge doit être un chiffre entier égale ou supérieur à 0")
     */
    private $redCard;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stats_read"})
     * @Assert\Type(type="integer", message="le nombre de carton rouge doit être un chiffre entier")
     * @Assert\PositiveOrZero(message="le nombre de carton rouge doit être un chiffre entier égale ou supérieur à 0")
     */
    private $yellowCard;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stats_read"})
     * @Assert\Type(type="integer", message="le nombre de carton rouge doit être un chiffre entier")
     * @Assert\PositiveOrZero(message="le nombre de carton rouge doit être un chiffre entier égale ou supérieur à 0")
     */
    private $passAssist;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stats_read"})
     * @Assert\Type(type="integer", message="le nombre de carton rouge doit être un chiffre entier")
     * @Assert\PositiveOrZero(message="le nombre de carton rouge doit être un chiffre entier égale ou supérieur à 0")
     */
    private $goal;

    /**
     * @ORM\ManyToOne(targetEntity=Encounter::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @Groups({"stats_read"})
     */
    private $encounter;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\NotBlank(message="Les informations de du joueur sont obligatoires")
     * @Groups({"stats_read"})
     */
    private $player;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRedCard(): ?int
    {
        return $this->redCard;
    }

    public function setRedcard( $redCard): self
    {
        $this->redCard = $redCard;

        return $this;
    }

    public function getYellowCard(): ?int
    {
        return $this->yellowCard;
    }

    public function setYellowCard( $yellowCard): self
    {
        $this->yellowCard = $yellowCard;

        return $this;
    }

    public function getPassAssist(): ?int
    {
        return $this->passAssist;
    }

    public function setPassAssist( $passAssist): self
    {
        $this->passAssist = $passAssist;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal( $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getEncounter(): ?Encounter
    {
        return $this->encounter;
    }

    public function setEncounter(?Encounter $encounter): self
    {
        $this->encounter = $encounter;

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
