<?php
/**
 * Created by PhpStorm.
 * User: Alexandre
 * Date: 11/04/2018
 * Time: 17:45
 */

namespace Cht\Sispag;


class Helper
{
    public static function mod10($valor)
    {
        $soma = 0;
        $valor = ltrim($valor, '0');
        for ($i = 0; $i < strlen($valor); $i++) {
            $mult = ($i % 2) ? 1 : 2;
            $soma += (int)$valor[$i] * $mult;
        }
        $resto = $soma % 10;
        $dv = 10 - $resto;
        return $dv == 10 ? 0 : $dv;
    }

    public static function formatValue($value)
    {
        return preg_replace('/\D/', '', $value);
    }

    public static function removeAccents($string)
    {
        return preg_replace(
            [
                '/\xc3[\x80-\x85]/',
                '/\xc3\x87/',
                '/\xc3[\x88-\x8b]/',
                '/\xc3[\x8c-\x8f]/',
                '/\xc3([\x92-\x96]|\x98)/',
                '/\xc3[\x99-\x9c]/',
                '/\xc3[\xa0-\xa5]/',
                '/\xc3\xa7/',
                '/\xc3[\xa8-\xab]/',
                '/\xc3[\xac-\xaf]/',
                '/\xc3([\xb2-\xb6]|\xb8)/',
                '/\xc3[\xb9-\xbc]/',
            ],
            str_split('ACEIOUaceiou', 1),
            self::isUtf8($string) ? $string : utf8_encode($string)
        );
    }

    public static function isUtf8($string)
    {
        return preg_match('%^(?:
             [\x09\x0A\x0D\x20-\x7E]
            | [\xC2-\xDF][\x80-\xBF]
            | \xE0[\xA0-\xBF][\x80-\xBF]
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
            | \xED[\x80-\x9F][\x80-\xBF]
            | \xF0[\x90-\xBF][\x80-\xBF]{2}
            | [\xF1-\xF3][\x80-\xBF]{3}
            | \xF4[\x80-\x8F][\x80-\xBF]{2}
            )*$%xs',
            $string
        );
    }
}