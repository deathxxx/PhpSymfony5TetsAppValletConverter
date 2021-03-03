<?php



namespace App\Classes;


class ValCurs
{
    private $Date;
    private $name;
    private $Valute = array();


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date): void
    {
        $this->Date = $Date;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValute()
    {
        return $this->Valute;
    }

    /**
     * @param mixed $Valute
     */
    public function setValute($Valute): void
    {
        $this->Valute = $Valute;
    }

}
