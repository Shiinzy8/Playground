<?php


namespace MVP_Office\Controller;


use MVP_Office\Entity\Category;
use MVP_Office\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('@andrii_mvp_office/product/index.html.twig');
    }

    /**
     * @Route("/category/{id}", name="category")
     * @param Category $category
     * @return Response
     */
    public function showCategory(Category $category): Response
    {
        return $this->render('@andrii_mvp_office/product/index.html.twig');
    }

    /**
     * @Route("/product/{id}", name="product")
     * @param Product $product
     * @return Response
     */
    public function showProduct(Product $product): Response
    {
        return $this->render('@andrii_mvp_office/product/index.html.twig');
    }
}
