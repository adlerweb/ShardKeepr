<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FootprintRepository")
 * @ORM\Table(name="Footprint")
 */
class Footprint
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * The category of the footprint.
     *
     * @ORM\ManyToOne(targetEntity="FootprintCategory", inversedBy="footprints")
     * @Groups({"default"})
     *
     * @var FootprintCategory
     */
    private $category;

    /**
     * Holds the footprint image.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\FootprintImage",
     *               mappedBy="footprint", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @Groups({"default"})
     *
     * @var FootprintImage
     */
    private $image;

    /**
     * Holds the footprint attachments.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\FootprintAttachment",
     *                mappedBy="footprint", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"default"})
     *
     * @var FootprintAttachment
     */
    private $attachments;

    /**
     * Returns the category path.
     *
     * @Groups({"default"})
     *
     * @return string
     */
    public function getCategoryPath()
    {
        if ($this->category !== null) {
            return $this->category->getCategoryPath();
        } else {
            return '';
        }
    }

    /**
     * Constructs a new Footprint entity.
     */
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    /**
     * Sets the category for this footprint.
     *
     * @param FootprintCategory $category The category
     *
     * @return void
     */
    public function setCategory(FootprintCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Returns the category of this footprint.
     *
     * @return FootprintCategory The footprint category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the footprint image.
     *
     * @param FootprintImage $image The footprint image
     *
     * @return void
     */
    public function setImage($image)
    {
        if ($image instanceof FootprintImage) {
            $image->setFootprint($this);
            $this->image = $image;
        } else {
            // Because this is a 1:1 relationship. only allow the temporary image to be set when no image exists.
            // If an image exists, the frontend needs to deliver the old file ID with the replacement property set.
            if ($this->getImage() === null) {
                $this->image = $image;
            }
        }
    }

    /**
     * Returns the footprint image.
     *
     * @return FootprintImage The footprint image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the attachments for this footprint.
     *
     * @return ArrayCollection The attachments
     */
    public function getAttachments()
    {
        return $this->attachments->getValues();
    }

    /**
     * Adds an IC Logo.
     *
     * @param FootprintAttachment $attachment
     * 
     * @return void
     */
    public function addAttachment($attachment)
    {
        if ($attachment instanceof FootprintAttachment) {
            $attachment->setFootprint($this);
        }

        $this->attachments->add($attachment);
    }

    /**
     * Removes an IC Logo.
     *
     * @param FootprintAttachment $attachment
     *
     * @return void
     */
    public function removeAttachment($attachment)
    {
        if ($attachment instanceof FootprintAttachment) {
            $attachment->setFootprint(null);
        }
        $this->attachments->removeElement($attachment);
    }
}