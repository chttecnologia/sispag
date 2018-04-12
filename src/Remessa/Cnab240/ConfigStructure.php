<?php

namespace Cht\Sispag\Remessa\Cnab240;


class ConfigStructure
{
    const TIPO_INSCRICAO_CNPJ = 2;

    const FILE_HEADER = [
        '1,3'     => ['picture' => '9(03)', 'field' => 'bankCode', 'default' => 341], // 341
        '4,7'     => ['picture' => '9(04)', 'field' => 'batchCode', 'default' => '0000'], // 0000
        '8,8'     => ['picture' => '9(01)', 'field' => 'registryType', 'default' => 0], // 0
        '9,14'    => ['picture' => 'X(06)', 'field' => 'white', 'default' => ' '],
        '15,17'   => ['picture' => '9(03)', 'field' => 'fileLayout', 'default' => '081'], // 081
        '18,18'   => ['picture' => '9(01)', 'field' => 'companyDocument'], // 1=CPF - 2=CNPJ
        '19,32'   => ['picture' => '9(14)', 'field' => 'registrationNumber'], // NOTA 1
        '33,52'   => ['picture' => 'X(20)', 'field' => 'white', 'default' => ' '],
        '53,57'   => ['picture' => '9(05)', 'field' => 'agencyNumber'], // NOTA 1
        '58,58'   => ['picture' => 'X(01)', 'field' => 'white', 'default' => ' '],
        '59,70'   => ['picture' => '9(12)', 'field' => 'accountNumber'], // NOTA 1
        '71,71'   => ['picture' => 'X(01)', 'field' => 'white', 'default' => ' '],
        '72,72'   => ['picture' => '9(01)', 'field' => 'dac'], // NOTA 1
        '73,102'  => ['picture' => 'X(30)', 'field' => 'companyName'],
        '103,132' => ['picture' => 'X(30)', 'field' => 'bankName'],
        '133,142' => ['picture' => 'X(10)', 'field' => 'white', 'default' => ' '],
        '143,143' => ['picture' => '9(01)', 'field' => 'fileCode'], // 1=REMESSA 2=RETORNO
        '144,151' => ['picture' => '9(08)', 'field' => 'generationDate'], // DDMMAAAA
        '152,157' => ['picture' => '9(06)', 'field' => 'generationHour'], // HHMMSS
        '158,166' => ['picture' => '9(09)', 'field' => 'zeros', 'default' => 0],
        '167,171' => ['picture' => '9(05)', 'field' => 'unitDensity'], // NOTA 2
        '172,240' => ['picture' => 'X(69)', 'field' => 'white', 'default' => ' ']
    ];

    const FILE_TRAILER = [
        '1,3'    => ['picture' => '9(03)', 'field' => 'bankCode', 'default' => 341], // 341
        '4,7'    => ['picture' => '9(04)', 'field' => 'batchCode', 'default' => 9999], // 9999
        '8,8'    => ['picture' => '9(01)', 'field' => 'registryType', 'default' => 9], // 9
        '9,17'   => ['picture' => 'X(09)', 'field' => 'white', 'default' => ' '],
        '18,23'  => ['picture' => '9(06)', 'field' => 'totalBatches'], // NOTA 17
        '24,29'  => ['picture' => '9(06)', 'field' => 'totalRegistries'], // NOTA 17
        '30,240' => ['picture' => 'X(211)', 'field' => 'white', 'default' => ' '],
    ];

    const BATCH_HEADER = [
        '1,3'     => ['picture'=>'9(03)', 'field' => 'bankCode', 'DEFAULT' => 341], // 341
        '4,7'     => ['picture'=>'9(04)', 'field' => 'batchCode'], // NOTA 3
        '8,8'     => ['picture'=>'9(01)', 'field' => 'registryType', 'DEFAULT' => 1], // 1
        '9,9'     => ['picture'=>'X(01)', 'field' => 'operationType', 'DEFAULT' => 'C'], // C=CRÉDITO
        '10,11'   => ['picture'=>'9(02)', 'field' => 'paymentType'], // NOTA 4
        '12,13'   => ['picture'=>'9(02)', 'field' => 'paymentMethod'], // NOTA 5
        '14,16'   => ['picture'=>'9(03)', 'field' => 'batchLayout', 'DEFAULT' => '040'], // 040
        '17,17'   => ['picture'=>'X(01)', 'field' => 'white', 'DEFAULT' => ' '],
        '18,18'   => ['picture'=>'9(01)', 'field' => 'companyDocument'], // 1=CPF - 2=CNPJ
        '19,32'   => ['picture'=>'9(14)', 'field' => 'registrationNumber'], // NOTA 1
        '33,36'   => ['picture'=>'X(04)', 'field' => 'registryIdentification', 'default' => 1707], // NOTA 13
        '37,52'   => ['picture'=>'X(16)', 'field' => 'white', 'DEFAULT' => ' '],
        '53,57'   => ['picture'=>'9(05)', 'field' => 'agencyNumber'], // NOTA 1
        '58,58'   => ['picture'=>'X(01)', 'field' => 'white', 'DEFAULT' => ' '],
        '59,70'   => ['picture'=>'9(12)', 'field' => 'accountNumber'], // NOTA 1
        '71,71'   => ['picture'=>'X(01)', 'field' => 'white', 'DEFAULT' => ' '],
        '72,72'   => ['picture'=>'9(01)', 'field' => 'dac'], // NOTA 1
        '73,102'  => ['picture'=>'X(30)', 'field' => 'companyName'],
        '103,132' => ['picture'=>'X(30)', 'field' => 'batchPurpose'], // NOTA 6
        '133,142' => ['picture'=>'X(10)', 'field' => 'historyCC'], // NOTA 7
        '143,172' => ['picture'=>'X(30)', 'field' => 'companyStreet'],
        '173,177' => ['picture'=>'9(05)', 'field' => 'companyNumber'],
        '178,192' => ['picture'=>'X(15)', 'field' => 'companyComplement'],
        '193,212' => ['picture'=>'X(20)', 'field' => 'companyCity'],
        '213,220' => ['picture'=>'9(08)', 'field' => 'companyZipCode'],
        '221,222' => ['picture'=>'X(02)', 'field' => 'companyState'],
        '223,230' => ['picture'=>'X(08)', 'field' => 'white', 'DEFAULT' => ' '],
        '231,240' => ['picture'=>'X(10)', 'field' => 'occurrences'], // VEM COM DADOS SOMENTE NO RETORNO DA REMESSA. PREENCHER COM BRANCO NO ENVIO
    ];
}