<?php

namespace Cht\Sispag\Remessa\Cnab240;


/**
 * Class Validator
 * @package Cht\Sispag\Remessa\Cnab240
 */
class Validator
{

    const STRING = 'X';
    const NUMBER = '9';
    const DECIMAL = 'V9';

    /**
     * @var string
     */
    private static $valueSize;

    /**
     * @var string
     */
    private static $valueType;

    /**
     * @var string
     */
    private static $decimalSize;

    /**
     * @var string
     */
    private static $decimalType;

    /**
     * @param $value
     * @param $picture
     * @return string
     * @throws \Exception
     */
    public static function formatPicture($value, $picture)
    {
        $regex = '/(?P<valueType>X|9)\((?P<valueSize>[0-9]+)\)(?P<decimalType>(V9)?)\(?(?P<decimalSize>([0-9]+)?)\)?/';

        if (preg_match($regex, $picture, $matches)) {
            self::$valueType = $matches['valueType'];
            self::$valueSize = (int)$matches['valueSize'];

            self::$decimalType = $matches['decimalType'];
            self::$decimalSize = (int)$matches['decimalSize'];

            if (strlen($value) > self::$valueSize and !$value instanceof \DateTime) {
                throw new \Exception('Invalid length');
            }

            if (self::$valueType === self::STRING) {
                return self::formatStringValue($value);
            } elseif (self::$valueType === self::NUMBER) {
                if (!is_numeric($value) and !$value instanceof \DateTime) {
                    throw new \Exception("Invalid type", 1);
                }

                return self::formatNumberValue($value);
            }
        }
        return false;
    }

    /**
     * @param $value
     * @return string
     */
    private static function formatStringValue($value)
    {
        return str_pad($value, self::$valueSize, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param \DateTime $value
     * @return \DateTime
     */
    private static function formatDateValue(\DateTime $value)
    {
        if (self::$valueSize === 8) {
            $value->format('dmY');
        } elseif (self::$valueSize === 6) {
            $value->format('dmy');
        }

        return $value;
    }

    /**
     * @param $value
     * @return \DateTime|string
     */
    private static function formatNumberValue($value)
    {
        if ($value instanceof \DateTime) {
            return self::formatDateValue($value);
        }

        if (self::$decimalType === self::DECIMAL) {
            return self::formatDecimalValue($value);
        }

        return str_pad($value, self::$valueSize, '0', STR_PAD_LEFT);
    }

    /**
     * @param $value
     * @return string
     */
    private static function formatDecimalValue($value)
    {
        $integerLen = self::$valueSize;
        $decimalLen = self::$decimalSize;

        $value = self::parseNumber($value);

        list($int, $dec) = array_pad(explode(".", $value), 2, 0);

        $integerValue = str_pad($int, $integerLen, '0', STR_PAD_LEFT);

        // Round decimal value
        if (strlen($dec) > $decimalLen) {
            $extra = strlen($dec) - $decimalLen;
            $extraPow = pow(10, $extra);
            $dec = round($dec / $extraPow);
        }

        $decimalValue = str_pad($dec, $decimalLen, '0', STR_PAD_RIGHT);
        return $integerValue . $decimalValue;
    }


    /**
     * @param $valor
     * @return string
     */
    private static function parseNumber($valor)
    {
        $valor = preg_replace('/[^0-9.]/', '', $valor);
        $valor = preg_replace('/^0+/', '', $valor);
        return $valor ?: '0';
    }
}