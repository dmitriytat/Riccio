<?php

/**
 * PHP Template system
 * 
 * @author dimko
 */
class TemplateSystem {

    /*
     * Файл шаблона
     */
    private static $mTemplate;

    /**
     * Для замены
     * @var array { "{$key}","value" } 
     */
    private static $mKeyValues;

    /**
     * Установка каталога шаблонов
     * @param mixed $template Каталог с шаблонами
     */
    public static function setTemplate($template = ".") {
        self::$mTemplate = $template;
    }

    /**
     * Назначение
     * @param mixed $key Переменная
     * @param mixed $value Значение
     */
    public static function assign($key, $value = "") {
        self::$mKeyValues["{\$$key}"] = $value;
    }

    /**
     * Назначение home+value
     * @param mixed $key Переменная
     * @param mixed $value Значение
     */
    public static function assignToHome($key, $value = "") {
        self::$mKeyValues["{\$$key}"] = self::$mKeyValues['{$home}'] . $value;
    }

    public static function addList($key, $name, $value) {
        self::$mKeyValues["{\$$key}"] = "<br>" . $name . "<ul>";
        foreach ($value as $li)
            self::$mKeyValues["{\$$key}"] .="<li>" . $li . "</li>";
        self::$mKeyValues["{\$$key}"] .="</ul>";
    }

    public static function clearAssign($key) {
        unset(self::$mKeyValues["{\$$key}"]);
    }

    /**
     * Отображение доступных данных
     */
    public static function showData() {
        echo json_encode(self::$mKeyValues);
    }


    /**
     * Отображение шаблона
     * @param mixed $templateFile файл шаблона
     */
    public static function showPage($templateFile) {
        foreach (self::$mKeyValues as $key => &$value) {
            $event = str_replace(array("{", "$", "}"), '', $key);
            EventSystem::fireEvent($event, array(&$value));
        }
        $templateFile = self::$mTemplate . $templateFile;
        $fPage = fopen($templateFile, "r");
        $tPage = fread($fPage, filesize($templateFile));
        echo str_replace(array_keys(self::$mKeyValues), self::$mKeyValues, $tPage);
        //echo strtr($tPage, $this->mValues);
    }


    /**
     * Отображение шаблона с вызывом события при встрече выражения,
     * а также подключением файлов
     * @param mixed $templateFile файл шаблона 
     */
    public static function showPage_new($templateFile) {
        $templateFile = self::$mTemplate . $templateFile;
        $fPage = fopen($templateFile, "r");
        $tPage = fread($fPage, filesize($templateFile));

        $includes = array();
        preg_match_all('/\{\!(\w+)\}/', $tPage, $includes, PREG_PATTERN_ORDER);
        $includes[0] = array_values(array_unique($includes[0]));
        $includes[1] = array_values(array_unique($includes[1]));

        foreach ($includes[1] as $i => $file) {
            $tempFile = self::$mTemplate . $includes[1][$i] . ".tpl";
            $fFile = fopen($tempFile, "r");
            $includes[2][] = fread($fFile, filesize($tempFile));
        }
        $tPage = str_replace($includes[0], $includes[2], $tPage);

        $found = array();
        preg_match_all('/\{\$(\w+)\}/', $tPage, $found, PREG_PATTERN_ORDER);
        $found[0] = array_values(array_unique($found[0]));
        $found[1] = array_values(array_unique($found[1]));
        foreach ($found[0] as $key) {
            if (isset(self::$mKeyValues{$key}))
                $found[2][] = self::$mKeyValues{$key};
            else
                $found[2][] = "";
        }
        foreach ($found[1] as $i => $event) {
            EventSystem::fireEvent($event, array(&$found[2][$i]));
        }
        echo str_replace($found[0], $found[2], $tPage);
    }



}

?>
