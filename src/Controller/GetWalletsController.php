<?php

namespace App\Controller;

use App\Classes\GetXml;
use App\Classes\ValCurs;
use App\Entity\Wallets;
use App\Repository\WalletsRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

//class GetWalletsController extends AbstractController
class GetWalletsController extends AbstractFOSRestController
{
    /**
     * @Route("/api/get/wallets", name="api_get_wallets")
     */
    public function index(WalletsRepository $repositoryWal): Response
    {
        // get xml
        $xml_utf8 = $this->getXml();

        // get cuurencies header (save to db)
        $valCurs = $this->insertUpdateValCurs($xml_utf8);

        // get wallets and save to db
        $wallets = $this->insertWalllets($repositoryWal,$xml_utf8);

        return $this->handleView($this->view($wallets));
    }

    function getXml() {
        $getXml = new GetXml('http://www.cbr.ru/scripts/XML_daily.asp');
        return $getXml->getXml();
    }

    function insertUpdateValCurs($xml_utf8) {
        $getXml = new GetXml('');
        $xmlValCursDate = $getXml->getHeaderAtribute($xml_utf8, "Date");
        $xmlValCursName = $getXml->getHeaderAtribute($xml_utf8, "name");

        $repositoryValCurs=$this->getDoctrine()->getRepository(\App\Entity\ValCurs::class);
        $valCursSize=$repositoryValCurs->findall();
        if(sizeof($valCursSize)>0) {
            $repositoryValCurs->truncate();
        }
        $valCursInsert = new \App\Entity\ValCurs();
        $valCursInsert->setDate(\DateTime::createFromFormat('d.m.Y',$xmlValCursDate));
        $valCursInsert->setName($xmlValCursName);
        $valCursInsert->setUpdateTime(new \DateTime("now"));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($valCursInsert);
        $entityManager->flush();
        return $valCursInsert;

    }

    function insertWalllets(WalletsRepository $repositoryWal, $xml_utf8){
        $encoders = new XmlEncoder();
        $normalizers = new ObjectNormalizer();


        $serializer = new Serializer([$normalizers], [$encoders]);
        $resp = $serializer->deserialize($xml_utf8,ValCurs::class, 'xml',array('use_attributes' => true));

        $repositoryWal->truncate();
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($resp->getValute() as $valE) {
            $wallets = new Wallets();

            $wallets->setValuteId($valE['@ID']);
            $wallets->setNumCode($valE['NumCode']);
            $wallets->setCharCode($valE['CharCode']);
            $wallets->setNominal($valE['Nominal']);
            $wallets->setName($valE['Name']);
            list($int,$dec)=explode(',', $valE['Value']);
            $wallets->setValueL($int);
            $wallets->setValueR($dec);


            $entityManager->persist($wallets);

        }

        $entityManager->flush();

        return $repositoryWal->findAll();
    }


}
