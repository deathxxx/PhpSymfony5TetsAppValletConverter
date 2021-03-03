<?php

namespace App\Entity;

use App\Repository\WalletsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WalletsRepository::class)
 */
class Wallets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $NumCode;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $CharCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nominal;

    /**
     * @ORM\Column(type="integer")
     */
    private $ValueL;

    /**
     * @ORM\Column(type="integer")
     */
    private $ValueR;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ValuteId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumCode(): ?string
    {
        return $this->NumCode;
    }

    public function setNumCode(string $NumCode): self
    {
        $this->NumCode = $NumCode;

        return $this;
    }

    public function getCharCode(): ?string
    {
        return $this->CharCode;
    }

    public function setCharCode(string $CharCode): self
    {
        $this->CharCode = $CharCode;

        return $this;
    }

    public function getNominal(): ?int
    {
        return $this->Nominal;
    }

    public function setNominal(int $Nominal): self
    {
        $this->Nominal = $Nominal;

        return $this;
    }

    public function getValueL(): ?int
    {
        return $this->ValueL;
    }

    public function setValueL(int $Value): self
    {
        $this->ValueL = $Value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValueR(): ?int
    {
        return $this->ValueR;
    }

    /**
     * @param mixed $ValueR
     */
    public function setValueR($ValueR): self
    {
        $this->ValueR = $ValueR;

        return $this;
    }




    public function getValuteId(): ?string
    {
        return $this->ValuteId;
    }

    public function setValuteId(string $ValuteId): self
    {
        $this->ValuteId = $ValuteId;

        return $this;
    }
}
