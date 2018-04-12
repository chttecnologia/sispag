<?php

namespace Cht\Sispag\Remessa\Cnab240;

use Cht\Sispag\Helper;


/**
 * Class SispagRemittance
 * @package Cht\Sispag\Remessa\Cnab240
 */
class SispagRemittance extends FileStructure
{
    private $header;

    /**
     * @var array
     */
    private $companyInfo;

    public function __construct(array $companyInfo = [])
    {
        $this->companyInfo = $companyInfo;

        parent::__construct();
    }

    public function setCompanyInfo(array $companyInfo)
    {
        $companyInfo['fileCode'] = 1;
        $companyInfo['generationDate'] = $this->now->format('dmY');
        $companyInfo['generationHour'] = $this->now->format('Hi');
        $companyInfo['unitDensity'] = 0;

        return parent::setCompanyInfo($companyInfo);
    }

    public function setBatches(array $batches)
    {
        $this->batches = $batches;
    }

    private function getBatches()
    {
        foreach ($this->batches as $batch) {
            $batchHeader = $this->generateBatchHeader([]);

            foreach ($batch as $item) {
                $this->generateBatchLine($item);
            }

            $batchHeader = $this->generateBatchHeader([]);
        }
    }

    private function generateBatchHeader(array $batches)
    {

    }

    private function generateBatchLine(array $data)
    {
        return '';
    }

    public function setFileHeader(array $data)
    {
        // remove o dígito verificador (último caracter)
        $data['accountNumber'] = substr(Helper::formatValue($data['accountNumber']), 0, -1);
        $data['agencyNumber'] = Helper::formatValue($data['agencyNumber']);
        $data['registrationNumber'] = Helper::formatValue($data['registrationNumber']);
        $data['dac'] = Helper::mod10($data['agencyNumber'] . $data['accountNumber']);
        $data['bankName'] = Helper::removeAccents($data['bankName']);

        return parent::setFileHeader($data);
    }

    /**
     * @throws \Exception
     */
    public function generateFileHeader()
    {
        $headerConf = ConfigStructure::FILE_HEADER;
        $header = '';

        foreach ($headerConf as $key => $conf) {
            if (isset($this->fileHeader[$conf['field']])) {
                $value = $this->fileHeader[$conf['field']];
            } else {
                if (!isset($conf['default'])) {
                    throw new \Exception("{$conf['field']} does not have default field");
                }
                $value = $conf['default'];
            }

            $header .= Validator::formatPicture($value, $conf['picture']);
        }

        return $header;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generateFileTrailer()
    {
        $trailerConf = ConfigStructure::FILE_TRAILER;
        $trailer = '';

        foreach ($trailerConf as $key => $conf) {
            if (isset($this->fileTrailer[$conf['field']])) {
                $value = $this->fileTrailer[$conf['field']];
            } else {
                if (!isset($conf['default'])) {
                    throw new \Exception("{$conf['field']} does not have default field");
                }
                $value = $conf['default'];
            }

            $trailer .= Validator::formatPicture($value, $conf['picture']);
        }

        return $trailer;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getFile()
    {
        $this->header = $this->generateFileHeader();
        return $this->header;

    }
}