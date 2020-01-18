<?php

namespace App\Controller;

use App\Entity\Manufacturer;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

//noImage.png
class ImageController extends AbstractController
{
    /**
     * @Route("/image/{type}/{file}", name="image")
     */
    public function index(Request $request)
    {
        $file = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_\.] remove;', $request->get('file'));;
        switch ($request->get('type')) {
            case Image::IMAGE_ICLOGO:
                if(!file_exists($this->getParameter('uploadDirectory').'/'.Image::IMAGE_ICLOGO.'/'.$file)) {
                    return new BinaryFileResponse($this->getParameter('kernel.project_dir') . '/public/img/noImage.png');
                }else{
                    return new BinaryFileResponse($this->getParameter('uploadDirectory').'/'.Image::IMAGE_ICLOGO.'/'.$file);
                }
                break;
            /*case Image::IMAGE_TEMP:
            case Image::IMAGE_PART:
            case Image::IMAGE_FOOTPRINT:
            case Image::IMAGE_STORAGELOCATION:
                return parent::setType($type);
                break;*/
            default:
                throw new InvalidArgumentException("Invalid Image Type: ".$request->get('type'));
        }
    }
}