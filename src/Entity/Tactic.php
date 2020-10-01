<?php

namespace App\Entity;

use App\Repository\TacticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacticRepository::class)
 */
class Tactic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="tactics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos2;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos3;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos4;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos5;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos6;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos7;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos8;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos9;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos10;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pos11;

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

    public function getPos1(): ?Player
    {
        return $this->pos1;
    }

    public function setPos1(?Player $pos1): self
    {
        $this->pos1 = $pos1;

        return $this;
    }

    public function getPos2(): ?Player
    {
        return $this->pos2;
    }

    public function setPos2(?Player $pos2): self
    {
        $this->pos2 = $pos2;

        return $this;
    }

    public function getPos3(): ?Player
    {
        return $this->pos3;
    }

    public function setPos3(?Player $pos3): self
    {
        $this->pos3 = $pos3;

        return $this;
    }

    public function getPos4(): ?Player
    {
        return $this->pos4;
    }

    public function setPos4(?Player $pos4): self
    {
        $this->pos4 = $pos4;

        return $this;
    }

    public function getPos5(): ?Player
    {
        return $this->pos5;
    }

    public function setPos5(?Player $pos5): self
    {
        $this->pos5 = $pos5;

        return $this;
    }

    public function getPos6(): ?Player
    {
        return $this->pos6;
    }

    public function setPos6(?Player $pos6): self
    {
        $this->pos6 = $pos6;

        return $this;
    }

    public function getPos7(): ?Player
    {
        return $this->pos7;
    }

    public function setPos7(?Player $pos7): self
    {
        $this->pos7 = $pos7;

        return $this;
    }

    public function getPos8(): ?Player
    {
        return $this->pos8;
    }

    public function setPos8(?Player $pos8): self
    {
        $this->pos8 = $pos8;

        return $this;
    }

    public function getPos9(): ?Player
    {
        return $this->pos9;
    }

    public function setPos9(?Player $pos9): self
    {
        $this->pos9 = $pos9;

        return $this;
    }

    public function getPos10(): ?Player
    {
        return $this->pos10;
    }

    public function setPos10(?Player $pos10): self
    {
        $this->pos10 = $pos10;

        return $this;
    }

    public function getPos11(): ?Player
    {
        return $this->pos11;
    }

    public function setPos11(?Player $pos11): self
    {
        $this->pos11 = $pos11;

        return $this;
    }
}
