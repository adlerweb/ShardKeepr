<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Manufacturer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerICLogoRepository")
 * @ORM\Table(name="ManufacturerICLogo")
 */
class ManufacturerICLogo extends Image
{
    /**
     * The manufacturer object.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Manufacturer", inversedBy="icLogos")
     * @ORM\JoinColumn(name="manufacturer_id",referencedColumnName="id")
     *
     * @var Manufacturer
     */
    private $manufacturer = null;

    /**
     * Creates a new IC logo instance.
     */
    public function __construct()
    {
        parent::__construct(Image::IMAGE_ICLOGO);
    }

    /**
     * Sets the manufacturer.
     *
     * @param Manufacturer $manufacturer The manufacturer to set
     */
    public function setManufacturer(Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;
    }
    /**
     * Returns the manufacturer.
     *
     * @return Manufacturer the manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
}
