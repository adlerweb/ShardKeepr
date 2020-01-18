<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
abstract class Image extends UploadedFile
{
    const IMAGE_ICLOGO = 'iclogo';
    const IMAGE_TEMP = 'temp';
    const IMAGE_PART = 'part';
    const IMAGE_STORAGELOCATION = 'storagelocation';
    const IMAGE_FOOTPRINT = 'footprint';

    public function __construct($type = '')
    {
        $this->setType($type);
        //parent::__construct();
    }

    protected function setType(string $type)
    {
        switch ($type) {
            case self::IMAGE_ICLOGO:
            case self::IMAGE_TEMP:
            case self::IMAGE_PART:
            case self::IMAGE_FOOTPRINT:
            case self::IMAGE_STORAGELOCATION:
                return parent::setType($type);
                break;
            default:
                throw new InvalidArgumentException("Invalid Image Type: ".$type);
        }
    }
}
