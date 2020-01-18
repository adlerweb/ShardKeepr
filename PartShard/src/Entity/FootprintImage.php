<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Image;

/**
 * Holds a footprint image.
 *
 * @ORM\Entity
 * @ORM\Table(name="FootprintImage")
 **/
class FootprintImage extends Image
{
    /**
     * The footprint object.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Footprint",inversedBy="image")
     *
     * @var Footprint
     */
    private $footprint = null;

    /**
     * Creates a new IC logo instance.
     */
    public function __construct()
    {
        parent::__construct(Image::IMAGE_FOOTPRINT);
    }

    /**
     * Sets the footprint.
     *
     * @param Footprint $footprint The footprint to set
     */
    public function setFootprint(Footprint $footprint)
    {
        $this->footprint = $footprint;
    }

    /**
     * Returns the footprint.
     *
     * @return Footprint the footprint
     */
    public function getFootprint()
    {
        return $this->footprint;
    }
}