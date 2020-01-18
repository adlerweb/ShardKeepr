<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiPrefixRepository")
 * @ORM\Table(name="SiPrefix")
 */
class SiPrefix
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="NotBlank")
     */
    private $prefix;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $symbol;

    /**
     * @ORM\Column(type="integer")
     */
    private $exponent;

    /**
     * @ORM\Column(type="integer")
     */
    private $base;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getExponent(): ?int
    {
        return $this->exponent;
    }

    public function setExponent(int $exponent): self
    {
        $this->exponent = $exponent;

        return $this;
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(int $base): self
    {
        $this->base = $base;

        return $this;
    }
}
