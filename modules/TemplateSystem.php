<?php

/**
 * PHP Template system
 *
 * @author dimko
 */
class TemplateSystem
{

    /**
     * Файл шаблона
     */
    private static $mTemplate;

    /**
     * Установка каталога шаблонов
     * @param mixed $template Каталог с шаблонами
     */
    public static function setTemplate($template = ".")
    {
        self::$mTemplate = $template . '/';
    }

    /**
     * Отображение шаблона
     * @param mixed $templateFile файл шаблона
     * @param array $data данные в массиве
     * @return string
     */
    public static function showPage($templateFile, $data, $dir = null, $req = false)
    {
        if ($dir)
            $templateFile = $dir . '/' . $templateFile;
        else
            $templateFile = self::$mTemplate . $templateFile;

        $fPage = fopen($templateFile, "r");
        $tPage = fread($fPage, filesize($templateFile));

        $matches = array();
        preg_match_all('/\{([$!#])(\w+)\/?(\w+)?\,?\s?([^\{^\}]+)?\}/', $tPage, $matches, PREG_PATTERN_ORDER);

        foreach ($matches[4] as $i => $parameter) {
            if (!isset($matches[5][$i])) $matches[5][$i] = '';

            if ($parameter != '' && $parameter[0] != '*') {
                if ($matches[1][$i] == '!') {
                    foreach ($data[$matches[2][$i]][$matches[3][$i]] as $item) {
                        $matches[5][$i] .= self::showPage($parameter, $item, $dir, true);
                    }
                } elseif ($matches[1][$i] == '#') {
                    $matches[5][$i] = self::showPage($parameter, $data, $dir, true);
                } else
                    $matches[5][$i] = self::showPage($parameter, $data[$matches[2][$i]], $dir, true);
            } else {
                if (array_key_exists($matches[2][$i], $data))
                    $matches[5][$i] = $matches[3][$i] == '' ? $data[$matches[2][$i]] : $data[$matches[2][$i]][$matches[3][$i]];

                if ($parameter != '') {
                    $parameterVars = array();
                    preg_match_all('/\(([+])(\w+)\)/', $parameter, $parameterVars, PREG_PATTERN_ORDER);

                    foreach ($parameterVars[2] as $j => $varName) {
                        $parameterVars[3][$j] = $data[$varName] ? $data[$varName] : '';
                    }

                    $matches[5][$i] = str_replace($parameterVars[0], $parameterVars[3], substr($parameter, 1));
                }

                if ($matches[5][$i] == '')
                    $matches[5][$i] = $matches[0][$i];

                EventSystem::fireEvent($matches[2][$i] . ($matches[3][$i] != '' ? '/' . $matches[3][$i] : ''), array(&$matches[5][$i]));
            }
        }

        if (!$req)
            $tPage = str_replace($matches[0], $matches[5], $tPage);

        return str_replace($matches[0], $matches[5], $tPage);
    }
}

?>
