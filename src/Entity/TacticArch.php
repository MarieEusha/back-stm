<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TacticArchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TacticArchRepository::class)
 */
class TacticArch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"encounters_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"encounters_read", "encounters_subresource"})
     * @Assert\NotBlank(message="Le choix de la tactique est obligatoire")
     * @Assert\Type(type="string", message="Le choix de la tactique doit être une chaîne de caractères")
     * @Assert\Length(min="3", max="50", minMessage="Le choix de la tactique doit faire entre 3 et 50 caractéres", maxMessage="Le choix de la tactique doit faire entre 3 et 50 caractéres")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="tacticArches")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="team obligatoire")
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 1 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 2 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos2;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 3 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos3;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 4 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos4;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 5 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos5;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 6 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos6;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 7 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos7;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 8 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos8;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 9 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos9;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 10 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos10;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="position 11 obligatoire")
     * @Groups({"encounters_read"})
     */
    private $pos11;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class)
     * @ORM\JoinTable(name="tactic_arch_substitute")
     * @Groups({"encounters_read"})
     */
    private $substitutes;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class)
     * @ORM\JoinTable(name="tactic_arch_substituteOut")
     * @Groups({"encounters_read"})
     */
    private $substitutesOut;



    public function __construct()
    {
        $this->substitutes = new ArrayCollection();
        $this->substitutesOut = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
     * @return mixed
     */
    public function getPos1()
    {
        return $this->pos1;
    }

    /**
     * @param mixed $pos1
     */
    public function setPos1($pos1): void
    {
        $this->pos1 = $pos1;
    }

    /**
     * @return mixed
     */
    public function getPos2()
    {
        return $this->pos2;
    }

    /**
     * @param mixed $pos2
     */
    public function setPos2($pos2): void
    {
        $this->pos2 = $pos2;
    }

    /**
     * @return mixed
     */
    public function getPos3()
    {
        return $this->pos3;
    }

    /**
     * @param mixed $pos3
     */
    public function setPos3($pos3): void
    {
        $this->pos3 = $pos3;
    }

    /**
     * @return mixed
     */
    public function getPos4()
    {
        return $this->pos4;
    }

    /**
     * @param mixed $pos4
     */
    public function setPos4($pos4): void
    {
        $this->pos4 = $pos4;
    }

    /**
     * @return mixed
     */
    public function getPos5()
    {
        return $this->pos5;
    }

    /**
     * @param mixed $pos5
     */
    public function setPos5($pos5): void
    {
        $this->pos5 = $pos5;
    }

    /**
     * @return mixed
     */
    public function getPos6()
    {
        return $this->pos6;
    }

    /**
     * @param mixed $pos6
     */
    public function setPos6($pos6): void
    {
        $this->pos6 = $pos6;
    }

    /**
     * @return mixed
     */
    public function getPos7()
    {
        return $this->pos7;
    }

    /**
     * @param mixed $pos7
     */
    public function setPos7($pos7): void
    {
        $this->pos7 = $pos7;
    }

    /**
     * @return mixed
     */
    public function getPos8()
    {
        return $this->pos8;
    }

    /**
     * @param mixed $pos8
     */
    public function setPos8($pos8): void
    {
        $this->pos8 = $pos8;
    }

    /**
     * @return mixed
     */
    public function getPos9()
    {
        return $this->pos9;
    }

    /**
     * @param mixed $pos9
     */
    public function setPos9($pos9): void
    {
        $this->pos9 = $pos9;
    }

    /**
     * @return mixed
     */
    public function getPos10()
    {
        return $this->pos10;
    }

    /**
     * @param mixed $pos10
     */
    public function setPos10($pos10): void
    {
        $this->pos10 = $pos10;
    }

    /**
     * @return mixed
     */
    public function getPos11()
    {
        return $this->pos11;
    }

    /**
     * @param mixed $pos11
     */
    public function setPos11($pos11): void
    {
        $this->pos11 = $pos11;
    }

    /**
     * @return Collection|Player[]
     */
    public function getSubstitutes(): Collection
    {
        return $this->substitutes;
    }

    public function addSubstitute(Player $substitute): self
    {
        if (!$this->substitutes->contains($substitute)) {
            $this->substitutes[] = $substitute;
        }

        return $this;
    }

    public function removeSubstitute(Player $substitute): self
    {
        $this->substitutes->removeElement($substitute);

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getSubstitutesOut(): Collection
    {
        return $this->substitutesOut;
    }

    public function addSubstitutesOut(Player $substitutesOut): self
    {
        if (!$this->substitutesOut->contains($substitutesOut)) {
            $this->substitutesOut[] = $substitutesOut;
        }

        return $this;
    }

    public function removeSubstitutesOut(Player $substitutesOut): self
    {
        $this->substitutesOut->removeElement($substitutesOut);

        return $this;
    }


}
