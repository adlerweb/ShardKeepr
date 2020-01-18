<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\BaseEntity;

/**
 * Represents a part in the database. The heart of our project. Handle with care!
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @TargetService(uri="/api/parts")
 */
class Part extends BaseEntity {
    /**
     * The category of the part.
     *
     * @ORM\ManyToOne(targetEntity="PartKeepr\PartBundle\Entity\PartCategory")
     * @Assert\NotNull()
     * @Groups({"default"})
     *
     * @var PartCategory
     */
    private $category;

    /**
     * The part's name.
     *
     * @ORM\Column
     * @Groups({"default"})
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * The part's short description.
     *
     * @ORM\Column(type="string",nullable=true)
     * @Groups({"default"})
     *
     * @var string
     */
    private $description;

    /**
     * The footprint of this part.
     *
     * @ORM\ManyToOne(targetEntity="PartKeepr\FootprintBundle\Entity\Footprint")
     * @Groups({"default"})
     *
     * @var Footprint
     */
    private $footprint;

    /**
     * The unit in which the part's "amount" is calculated. This is necessary to count parts
     * in "pieces", "meters" or "grams".
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PartMeasurementUnit", inversedBy="parts")
     * @Groups({"default"})
     *
     * @var PartMeasurementUnit
     */
    private $partUnit;

    /**
     * Defines the storage location of this part.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageLocation")
     * @Groups({"default"})
     *
     * @var StorageLocation
     */
    private $storageLocation;
}