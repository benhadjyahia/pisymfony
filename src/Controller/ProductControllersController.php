<?php

namespace App\Controller;

use App\Entity\SearchData;
use App\Entity\Contact;
use App\Form\SearchForm;
use App\Notification;
use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Entity\PropertySearch;
use App\Form\ContactpType;
use App\Form\ProductSearchType;
use App\Form\ProductType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\ProductRepository;
use ContainerXCxFaA8\PaginatorInterface_82dac15;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/product/controllers")
 */
class ProductControllersController extends AbstractController
{
    private $repository;
    private $ProductRepository;


    /**
     *@Route("/list",name="products_list")
     */
    public function home(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
        $product= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire
            $nom = $propertySearch->getNom();
            if ($nom!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
                $product= $this->getDoctrine()->getRepository( Product::class)->findBy(['Nom_p' => $nom] );

            else
                //si si aucun nom n'est fourni on affiche tous les articles
                $product= $this->getDoctrine()->getRepository(Product::class)->findAll();
        }
        return  $this->render('product_controllers/index2.html.twig',[ 'form' =>$form->createView(), 'products' => $product]);
    }
    /**
     *@Route("/list1",name="products1_list")
     */
    public function home1(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
        $product= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire
            $nom = $propertySearch->getNom();
            if ($nom!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
                $product= $this->getDoctrine()->getRepository( Product::class)->findBy(['Nom_p' => $nom] );
            else
                //si si aucun nom n'est fourni on affiche tous les articles
                $product= $this->getDoctrine()->getRepository(Product::class)->findAll();
        }
        return  $this->render('product_controllers/index3.html.twig',[ 'form' =>$form->createView(), 'products' => $product]);
    }
    /**
     * @Route("/", name="product_controllers_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, PaginatorInterface $paginator, Request $request): Response
    {



        $search= new ProductSearch();
        $form = $this->createForm(ProductSearchType::class,$search);
        $form->handleRequest($request);
        $data = $productRepository->findAll();

        $products = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('product_controllers/index.html.twig', [
            'products' => $products,
            'form'     =>$form->createView()
        ]);
    }

    /**
     * @Route("/listpdf", name="product_controllers_listpdf", methods={"GET"})
     */
    public function indexlistpdf(ProductRepository $productRepository )
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $products = $productRepository->findAll();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('product_controllers/listp.html.twig', [
            'products' => $products,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/rrrbbb", name="product_controllers_index123456",)
     */
    public function index123456 (ProductRepository $productRepository, Request $request): Response
    {

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $products = $productRepository->findSearch($data);
        return $this->render('product_controllers/index123456.html.twig', [
            'products' => $products,
            'form'=>$form->createView()
        ]);

    }




    /**
     * @Route("/rrr", name="product_controllers_index1234",)
     */
    public function index1234 (ProductRepository $productRepository, Request $request): Response
    {

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $products = $productRepository->findSearch($data);
        return $this->render('product_controllers/index1234.html.twig', [
            'products' => $products,
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/fr", name="product_controllers_index1", methods={"GET"})
     */
    public function index2 (ProductRepository $productRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $data = new SearchData();
        $data->page =$request->get('page',1);
        $form = $this->createForm(SearchForm::class, $data);
        $form ->handleRequest($request);
        $products = $productRepository->findSearch($data);

        $data = $productRepository->findAll();
        $products = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('product_controllers/index1.html.twig', [
            'products' => $products,
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/new", name="product_controllers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_controllers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_controllers/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_controllers_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product_controllers/show.html.twig', [
            'product' => $product,
        ]);
    }


    /**
     * @Route("/1/{id}", name="product1_controllers1_show", methods={"GET"})
     */
    public function show1(Product $product): Response
    {
        return $this->render('product_controllers/show1.html.twig', [
            'product' => $product,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="product_controllers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_controllers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_controllers/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_controllers_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_controllers_index', [], Response::HTTP_SEE_OTHER);
    }


}
