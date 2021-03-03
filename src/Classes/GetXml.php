<?php


namespace App\Classes;


use Symfony\Component\HttpClient\HttpClient;

class GetXml
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getXml() {
        $client = HttpClient::create();
        $response = $client->request('GET', $this->url,
            [
                'headers' => [
                    'Content-Type' => 'application/xml; charset=windows-1251',
                ],
            ]);

        $res = $response->getContent();
        $xml_utf8 = mb_convert_encoding($res, "HTML-ENTITIES", "windows-1251");
        return $xml_utf8;
    }

    public function getHeaderAtribute($xml_utf8, $attribute) {

        $xml=new \DOMDocument();
        $xml->loadXML($xml_utf8);
        $valCurs = $xml->getElementsByTagName('ValCurs');
        foreach ($valCurs as $val) {
            $xmlValAttribute = $val->getAttribute($attribute);
        }

        return $xmlValAttribute;
    }
}
