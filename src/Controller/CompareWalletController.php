<?php

namespace App\Controller;

use App\Classes\Calculator;
use App\Entity\Wallets;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompareWalletController extends AbstractFOSRestController
{
    /**
     * @Route("api/compare/wallet/{wal1}/{amount}/{wal2}", name="compare_wallet")
     */
    public function index($wal1, $amount, $wal2): Response
    {

        //execute update latest course to db
        $response = $this->forward("App\Controller\GetWalletsController::index");

        $calculator = new Calculator();
        $amountValue = $calculator->amountToFloat($amount);

        if (strpos(strtoupper($wal1), 'RUB') !== false) {
            if (strpos(strtoupper($wal2), 'RUB') !== false) {
                $result = $amountValue;
            } else {
                $walRep = $this->getDoctrine()->getRepository(Wallets::class);
                $wallet2 = $walRep->findOneByCharCode(strtoupper($wal2));
                $wallet2Value = floatval($wallet2->getValueL() . '.' . $wallet2->getValueR());

                $result = $calculator->calcMainValuteDesc($wallet2Value,$amount);
            }

        } else if (strpos(strtoupper($wal2), 'RUB') !== false) {
            $walRep = $this->getDoctrine()->getRepository(Wallets::class);
            $wallet1 = $walRep->findOneByCharCode(strtoupper($wal1));
            $wallet1Value = floatval($wallet1->getValueL() . '.' . $wallet1->getValueR());

            $result = $calculator->calcMainValuteAsc($wallet1Value,$amount);
        } else {


            $walRep = $this->getDoctrine()->getRepository(Wallets::class);
            $wallet1 = $walRep->findOneByCharCode(strtoupper($wal1));
            $wallet2 = $walRep->findOneByCharCode(strtoupper($wal2));
            $wallet1Value = floatval($wallet1->getValueL() . '.' . $wallet1->getValueR());
            $wallet2Value = floatval($wallet2->getValueL() . '.' . $wallet2->getValueR());

            $result = $calculator->calculateDifferentValute($wallet1Value,$wallet2Value,$amount);
        }

        return $this->handleView($this->view($result));
    }
}
