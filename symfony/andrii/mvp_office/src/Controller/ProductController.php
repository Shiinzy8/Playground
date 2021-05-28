<?php


namespace MVP_Office\Controller;


use ApiPlatform\Core\Api\IriConverterInterface;
use MVP_Office\Entity\Category;
use MVP_Office\Entity\Product;
use MVP_Office\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render(
            '@andrii_mvp_office/product/index.html.twig',
            [
                'categories' => $categoryRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/category/{id}", name="category")
     * @param Category $category
     * @param IriConverterInterface $iriConverter
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function showCategory(
        Category $category,
        IriConverterInterface $iriConverter,
        CategoryRepository $categoryRepository,
    ): Response
    {
        return $this->render(
            '@andrii_mvp_office/product/index.html.twig',
            [
                'currentCategoryId' => $iriConverter->getIriFromItem($category),
                'categories' => $categoryRepository->findAll(),
            ]
        );
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
