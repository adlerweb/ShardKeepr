<?php

namespace App\Controller;

use App\Entity\Distributor;
use App\Form\DistributorType;
use App\Repository\DistributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;

/**
 * @Route("/Distributor", name="Distributor.")
 */
class DistributorController extends AbstractController {
    private $factory;

    public function __construct(DataTableFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Creates and returns a basic DataTable instance.
     *
     * @param array $options Options to be passed
     * @return DataTable
     */
    protected function createDataTable(array $options = [])
    {
        return $this->factory->create($options);
    }

    /**
     * Creates and returns a DataTable based upon a registered DataTableType or an FQCN.
     *
     * @param string $type FQCN or service name
     * @param array $typeOptions Type-specific options to be considered
     * @param array $options Options to be passed
     * @return DataTable
     */
    protected function createDataTableFromType($type, array $typeOptions = [], array $options = [])
    {
        return $this->factory->createFromType($type, $typeOptions, $options);
    }

    /**
     * @Route("/", name="index")
     * @param DistributorRepository $distributorRepository
     * @return Response
     */
    public function index(Request $request) {
        $table = $this->createDataTable()
            ->add('name', TextColumn::class, ['label' => 'Name', 'dataPriority' => 1])
            ->add('address', TextColumn::class, ['label' => 'Address'])
            ->add('url', TextColumn::class, ['label' => 'URL', 'render' => '<a href="%1$s">%1$s</a>'])
            ->add('email', TextColumn::class, ['label' => 'E-Mail', 'render' => '<a href="mailto:%1$s">%1$s</a>'])
            ->add('comment', TextColumn::class, ['label' => 'Comment'])
            ->add('phone', TextColumn::class, ['label' => 'Phone', 'render' => '<a href="tel:%1$s">%1$s</a>'])
            ->add('fax', TextColumn::class, ['label' => 'Fax'])
            ->add('skuurl', TextColumn::class, ['label' => 'SKU URL', 'render' => '<a href="%1$s">%1$s</a>'])
            ->add('actions', TextColumn::class, [
                'label' => 'Actions', 
                'dataPriority' => 2,
                'render' => function($value, $context) {
                    return '
                    <a href="'.$this->generateUrl('Distributor.show', ['id' => $context->getId()]).'"><button type="button" class="btn btn-secondary"><i class="fa fa-info-circle"></i></button></a>
                    <a href="'.$this->generateUrl('Distributor.edit', ['id' => $context->getId()]).'"><button type="button" class="btn btn-secondary"><i class="fa fa-edit"></i></button></a>
                    <a href="'.$this->generateUrl('Distributor.remove', ['id' => $context->getId()]).'"><button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></a>
                    ';
                }
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Distributor::class
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('Distributor/index.twig', ['datatable' => $table]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) {
        $distributor = new Distributor();
        return $this->edit($distributor, $request);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Distributor $distributor, Request $request) {

        $form = $this->createForm(
            DistributorType::class, 
            $distributor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $distributor->setEnabledForReports(false);
            $em->persist($distributor);
            $em->flush();
            $this->addFlash("success", "Distributor was saved");
            return $this->render('Distributor/create.twig', ['form' => $form->createView(), 'distributor' => $distributor]);
        }

        return $this->render('Distributor/create.twig', ['form' => $form->createView(), 'distributor' => $distributor]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Distributor $distributor) {
        return $this->render('Distributor/show.twig', ['distributor'=>$distributor]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @param Request $request
     * @return Response
     */
    public function remove(Distributor $unit) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($unit);
        $em->flush();

        $this->addFlash("success", "Distributor was removed");

        return $this->redirect($this->generateUrl('Distributor.index'));
    }
}