<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\SiPrefix;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitRepository")
 * @ORM\Table(name="Unit")
 */
class Unit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\NotBlank(message="unit.name.not_blank")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="string")
     * @Assert\NotBlank(message="unit.symbol.not_blank")
     */
    private $symbol;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SiPrefix")
     * @ORM\JoinTable(name="UnitSiPrefixes",
     *            joinColumns={@ORM\JoinColumn(name="unit_id", referencedColumnName="id")},
     *            inverseJoinColumns={@ORM\JoinColumn(name="siprefix_id", referencedColumnName="id")}
     *            )
     * @Assert\All({
     *      @Assert\Type(type="PartKeepr\SiPrefixBundle\Entity\SiPrefix")
     * })
     *
     * @var ArrayCollection
     */
    private $prefixes;

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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }
    
    public function getPrefixes()
    {
        return $this->prefixes->getValues();
    }

    public function addPrefix($prefix)
    {
        $this->prefixes->add($prefix);
    }

    public function removePrefix($prefix)
    {
        $this->prefixes->removeElement($prefix);
    }
}
