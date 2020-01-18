<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This entity represents a part measurement unit. Typical measurement units are pieces, centimeters etc.
 *
 * @ORM\Entity
 * @ORM\Table(name="PartUnit")
 **/
class PartMeasurementUnit {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Defines the name of the unit.
     *
     * @ORM\Column(type="string", unique=true)
     * @Groups({"default"})
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank(message="partMeasurementUnit.name.not_blank")
     *
     * @var string
     */
    private $name;

    /**
     * Defines the short name of the unit.
     *
     * @ORM\Column(type="string", name="shortName")
     * @Groups({"default"})
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank(message="partMeasurementUnit.shortName.not_blank")
     *
     * @var string
     */
    private $shortName;

    /**
     * Defines if the unit is default or not. Note that this property may not be set directly.
     *
     * @ORM\Column(type="boolean", name="is_default")
     * @Groups({"default"})
     *
     * @var bool
     */
    private $default;

    /**
     * The parts used by this PartMeasurementUnit.
     *
     * @TODO ORM\OneToMany(targetEntity="App\Entity\Part",mappedBy="partUnit")
     */
    private $parts;

    /**
     * Creates a new part unit.
     *
     * Sets the default to false.
     */
    public function __construct() {
        $this->parts = new ArrayCollection();
        $this->setDefault(false);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the name for this unit.
     *
     * @param string $name The name for this unit
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Returns the name for this unit.
     *
     * @param none
     *
     * @return string The name for this unit
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * Sets the short name for this unit.
     *
     * Short names are used for list views (e.g. if your unit name is "metres", your short name could be "m")
     *
     * @param string $shortName The short name
     */
    public function setShortName(string $shortName) {
        $this->shortName = $shortName;
    }

    /**
     * Returns the short name for this unit.
     *
     * @param none
     *
     * @return string The short name for this unit
     */
    public function getShortName(): ?string {
        return $this->shortName;
    }

    /**
     * Defines if the unit is default or not.
     *
     * @param bool $default True if the unit is default, false otherwise
     */
    public function setDefault(bool $default) {
        $this->default = (bool) $default;
    }

    /**
     * Returns if the unit is default or not.
     *
     * @param none
     *
     * @return bool True if the unit is default, false for not
     */
    public function isDefault(): ?bool {
        return $this->default;
    }

    /**
     * Returns the parts for this PartUnit.
     *
     * @return ArrayCollection
     */
    public function getParts(): ?array {
        return $this->parts->getValues();
    }
}