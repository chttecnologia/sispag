<?php

namespace Cht\Sispag;

class Sispag
{
    const CNAB_240 = 240;
    const CNAB_400 = 400;

    /**
     * @var int
     */
    private $layout;

    public function __construct($layout = self::CNAB_240)
    {
        $this->layout = $layout;
    }

    public function cnab240()
    {
        $this->layout = self::CNAB_240;

        return $this;
    }

    public function cnab400()
    {
        $this->layout = self::CNAB_400;

        return $this;
    }

    public function remittance(array $companyInfo = [])
    {
        if ($this->layout === self::CNAB_240) {
            return new Remessa\Cnab240\SispagRemittance($companyInfo);
        }

        // TODO: Cnab400\SispagRemittance
        return null;
    }

    public function return()
    {
        if ($this->layout === self::CNAB_240) {
            return new Remessa\Cnab240\SispagReturn();
        }

        // TODO: Cnab400\SispagReturn
        return null;
    }
}