<?php


namespace MVP_Office\Controller;


use MVP_Office\Entity\Purchase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
//    /**
//     * @Route("/checkout", name="app_checkout")
//     * @return Response
//     */
//    public function checkout(): Response
//    {
//        return $this->render('@andrii_mvp_office/checkout/index.html.twig');
//    }

    /**
     * @route("/confirmation/{id}", name="confirmation")
     * @param Purchase $purchase
     * @return Response
     */
    public function confirmation(Purchase $purchase): Response
    {
        $totalPrice = 0;
        $purchaseItems = $purchase->getPurchaseItems();

        for ($i = 0; $i < count($purchaseItems); $i++) {
            $totalPrice += $purchaseItems[$i]->getProduct()->getPrice() * $purchaseItems[$i]->getQuantity();
        }

        return $this->render('@andrii_mvp_office/checkout/confirmation.html.twig', [
            'purchase' => $purchase,
            'totalPrice' => $totalPrice,
        ]);
    }
}
