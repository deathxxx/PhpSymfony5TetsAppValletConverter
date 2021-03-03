<?php

namespace App\Controller;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;



class WalletsController extends AbstractFOSRestController
{
    /**
     * @Route("/api/wallets", name="wallets")
     */
    public function index(): Response {
        $repository=$this->getDoctrine()->getRepository(Wallets::class);
        $wallets=$repository->findall();
        return $this->handleView($this->view($wallets));
    }

    /**
     * @Route("/api/wallets/code", name="wallets_code")
     * @param WalletsRepository $repository
     * @return Response
     */
    public function walletsCode(WalletsRepository $repository): Response {
        $wallets=$repository->findAllWalletsCharCodeAndId();
        return $this->handleView($this->view($wallets));
    }

    /**
     * @Route("/api/wallets/{wal}", name="wallet_code_get")
     * @param WalletsRepository $repository
     * @return Response
     */
    public function getWalletCode(WalletsRepository $repository, $wal): Response {
        return $this->handleView(($this->view($repository->findOneByCharCode($wal))));
    }
}
