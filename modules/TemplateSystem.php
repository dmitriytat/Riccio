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
     * @return рендер страницы
     */
    public static function showPage($templateFile, $data, $dir = null)
    {
        if ($dir)
            $templateFile = $dir . '/' . $templateFile;
        else
            $templateFile = self::$mTemplate . $templateFile;

        $fPage = fopen($templateFile, "r");
        $tPage = fread($fPage, filesize($templateFile));

        $matches = array();
        preg_match_all('/\{([$!#])(\w+)\/?(\w+)?\,?\s?([\w.]+)?\}/', $tPage, $matches, PREG_PATTERN_ORDER);

        foreach ($matches[4] as $i => $file) {
            if ($file != '') {
                if ($matches[1][$i] == '!') {
                    foreach ($data[$matches[2][$i]][$matches[3][$i]] as $j => $item)
                        $matches[5][$i] .= self::showPage($file, $item);
                } elseif ($matches[1][$i] == '#') {
                    $matches[5][$i] = self::showPage($file, $data);
                } else
                    $matches[5][$i] = self::showPage($file, $data[$matches[2][$i]]);
            } else {
                $matches[5][$i] = $matches[3][$i] == '' ? $data[$matches[2][$i]] : $data[$matches[2][$i]][$matches[3][$i]];
                if ($matches[5][$i] == '')
                    $matches[5][$i] = $matches[0][$i];
                EventSystem::fireEvent($matches[2][$i] . ($matches[3][$i] != '' ? '/' . $matches[3][$i] : ''), array(&$matches[5][$i]));
            }
        }

        $tPage = str_replace($matches[0], $matches[5], $tPage);
        return str_replace($matches[0], $matches[5], $tPage);
    }
}

?>
