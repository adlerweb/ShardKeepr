<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Manufacturer;
use App\Entity\ManufacturerICLogo;
use App\Entity\UploadedFile;
use App\Form\ManufacturerType;
use App\Repository\ManufacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;

/**
 * @Route("/Manufacturer", name="Manufacturer.")
 */
class ManufacturerController extends AbstractController {
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
     * @param ManufacturerRepository $manufacturerRepository
     * @return Response
     */
    public function index(Request $request) {
        //$this->generateUrl('Manufacturer.remove', ['id' => 1])
        $table = $this->createDataTable()
            //->add('id', TextColumn::class, ['label' => 'ID'])
            ->add('name', TextColumn::class, ['label' => 'Name', 'dataPriority' => 1])
            ->add('address', TextColumn::class, ['label' => 'Address'])
            ->add('url', TextColumn::class, ['label' => 'URL', 'render' => '<a href="%1$s">%1$s</a>'])
            ->add('email', TextColumn::class, ['label' => 'E-Mail', 'render' => '<a href="mailto:%1$s">%1$s</a>'])
            ->add('comment', TextColumn::class, ['label' => 'Comment'])
            ->add('phone', TextColumn::class, ['label' => 'Phone', 'render' => '<a href="tel:%1$s">%1$s</a>'])
            ->add('fax', TextColumn::class, ['label' => 'Fax'])
            ->add('image', TextColumn::class, [
                'label' => 'Logo',
                'render' => function($value, $context) {
                    $logo = $context->getIcLogos();
                    if(!$logo) return '';
                    //{{ path('image', {type: manufacturer.icLogos.type, file: manufacturer.icLogos.filename ~ '.' ~ manufacturer.icLogos.extension}) }}
                    return '<img style="max-height: 3em;" src="'.$this->generateUrl('image', ['type' => $logo->getType(), 'file' => $logo->getFilename()]).'.'.$logo->getExtension().'">';
                }
            ])
            ->add('actions', TextColumn::class, [
                'label' => 'Actions', 
                'dataPriority' => 2,
                'render' => function($value, $context) {
                    return '
                    <a href="'.$this->generateUrl('Manufacturer.show', ['id' => $context->getId()]).'"><button type="button" class="btn btn-secondary"><i class="fa fa-info-circle"></i></button></a>
                    <a href="'.$this->generateUrl('Manufacturer.edit', ['id' => $context->getId()]).'"><button type="button" class="btn btn-secondary"><i class="fa fa-edit"></i></button></a>
                    <a href="'.$this->generateUrl('Manufacturer.remove', ['id' => $context->getId()]).'"><button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></a>
                    ';
                }
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Manufacturer::class
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('Manufacturer/index.twig', ['datatable' => $table]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) {
        $manufacturer = new Manufacturer();
        return $this->edit($manufacturer, $request);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Manufacturer $manufacturer, Request $request) {
        $form = $this->createForm(
            ManufacturerType::class, 
            $manufacturer, 
            [
                'imageMaxSize' => $this->getParameter('imageMaxSize'),
                'imageMime' => $this->getParameter('imageMime')
            ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);

            /** @var UploadedFile $uimage */
            $uimage = $form['image']->getData();
            if($uimage) {
                $uid = sha256(uniqid(true).$uimage->getClientOriginalName());

                $image = new ManufacturerICLogo;
                $image->setOriginalFilename($uimage->getClientOriginalName());
                $image->setFilename($uid);
                $image->setCreated(new \DateTime());
                $image->setExtension($uimage->guessExtension());
                $image->setMimetype($uimage->getMimeType());
                $image->setSize($uimage->getSize());
                $image->setManufacturer($manufacturer);

                $uimage->move(
                    $this->getParameter('uploadDirectory').'/'.Image::IMAGE_ICLOGO,
                    $uid.'.'.$uimage->guessExtension()
                );

                $em->persist($image);
            }
            $em->flush();
            $this->addFlash("success", "Manufacturer was saved");
            return $this->render('Manufacturer/create.twig', ['form' => $form->createView(), 'manufacturer' => $manufacturer]);
            //return $this->redirect($this->generateUrl('Manufacturer.index'));
        }

        return $this->render('Manufacturer/create.twig', ['form' => $form->createView(), 'manufacturer' => $manufacturer]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Manufacturer $manufacturer) {
        return $this->render('Manufacturer/show.twig', ['manufacturer'=>$manufacturer]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @param Request $request
     * @return Response
     */
    public function remove(Manufacturer $unit) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($unit);
        $em->flush();

        $this->addFlash("success", "Manufacturer was removed");

        return $this->redirect($this->generateUrl('Manufacturer.index'));
    }
}