<?php

namespace Cht\Sispag\Remessa\Cnab240;


class FileStructure
{
    /**
     * @var array
     */
    protected $fileHeader;

    /**
     * @var array
     */
    protected $fileTrailer;

    /**
     * @var array
     */
    protected $batchHeader;

    /**
     * @var array
     */
    protected $batchTrailer;

    /**
     * @var array
     */
    protected $batches;

    /**
     * @var \DateTime
     */
    protected $now;

    /**
     * @var array
     */
    protected $companyInfo;

    public function __construct()
    {
        $this->now = new \DateTime();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setFileHeader(array $data)
    {
        $this->fileHeader = $data;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setFileTrailer(array $data)
    {
        $this->fileTrailer = $data;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setBatchHeader(array $data)
    {
        $this->batchHeader = $data;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setBatchTrailer(array $data)
    {
        $this->batchTrailer = $data;

        return $this;
    }

    /**
     * @param array $batches
     * @return FileStructure
     */
    public function setBatches(array $batches)
    {
        $this->batches = $batches;

        return $this;
    }

    /**
     * @param array $companyInfo
     * @return FileStructure
     */
    public function setCompanyInfo(array $companyInfo)
    {
        $this->companyInfo = $companyInfo;

        return $this;
    }
}