<?php

namespace App\Controller;

use App\Entity\PartMeasurementUnit;
use App\Form\PartMeasurementUnitType;
use App\Repository\PartMeasurementUnitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/PartMeasurementUnit", name="PartMeasurementUnit.")
 */
class PartMeasurementUnitController extends AbstractController {

    /**
     * @Route("/", name="index")
     * @param PartMeasurementUnitRepository $partMeasurementUnitRepository
     * @return Response
     */
    public function index(PartMeasurementUnitRepository $partMeasurementUnitRepository) {
        $units = $partMeasurementUnitRepository->findAll();
        return $this->render('PartMeasurementUnit/index.twig', ['units'=>$units]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) {
        $unit = new PartMeasurementUnit();

        $form = $this->createForm(PartMeasurementUnitType::class, $unit);
        $form->handleRequest($request);

        if($form->isSubmitted()) { // && $form->isValid()
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();
            $this->addFlash("success", "Unit was added");
            return $this->redirect($this->generateUrl('PartMeasurementUnit.index'));
        }

        return $this->render('PartMeasurementUnit/create.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Request $request
     * @return Response
     */
    public function show(PartMeasurementUnit $unit) {
        return $this->render('PartMeasurementUnit/show.twig', ['unit'=>$unit]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @param Request $request
     * @return Response
     */
    public function remove(PartMeasurementUnit $unit) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($unit);
        $em->flush();

        $this->addFlash("success", "Unit was removed");

        return $this->redirect($this->generateUrl('PartMeasurementUnit.index'));
    }
}