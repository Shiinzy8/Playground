<?php


namespace MVP_Office\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    /**
     * @Route("/shopping-cart", name="cart")
     * @return Response
     */
    public function shoppingCart(): Response
    {
        return $this->render('@andrii_mvp_office/cart/index.html.twig');
    }
}
