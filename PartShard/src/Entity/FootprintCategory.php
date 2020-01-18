<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\AbstractCategory;
use App\Entity\CategoryPathInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="FootprintCategory",indexes={@ORM\Index(columns={"lft"}),@ORM\Index(columns={"rgt"})})
 * The entity for our storage location categories
 */
class FootprintCategory extends AbstractCategory implements CategoryPathInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="FootprintCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="FootprintCategory", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     * @Groups({"tree"})
     *
     * @var ArrayCollection
     */
    protected $children;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Footprint", mappedBy="category")
     */
    protected $footprints;

    /**
     * @ORM\Column(type="text",nullable=true,name="categoryPath")
     * @Groups({"default"})
     *
     * @var string
     */
    protected $categoryPath;

    public function __construct()
    {
        parent::__construct();
        $this->storageLocations = new ArrayCollection();
    }

    /**
     * Sets the parent category.
     *
     * @Groups({"default"})
     *
     * @param AbstractCategory|null $parent
     */
    public function setParent(AbstractCategory $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Returns the parent category.
     *
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Returns the storage locations.
     *
     * @return ArrayCollection
     */
    public function getFootprints()
    {
        return $this->footprints->getValues();
    }

    /**
     * Returns the children.
     *
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children->getValues();
    }

    /**
     * Returns the category path.
     *
     * @return string
     */
    public function getCategoryPath()
    {
        return $this->categoryPath;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategoryPath($categoryPath)
    {
        $this->categoryPath = $categoryPath;
    }

    /**
     * {@inheritdoc}
     */
    public function generateCategoryPath($pathSeparator)
    {
        if ($this->getParent() !== null) {
            return $this->getParent()->generateCategoryPath($pathSeparator).$pathSeparator.$this->getName();
        } else {
            return $this->getName();
        }
    }
}