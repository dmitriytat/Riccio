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
    private static $context;

    /**
     * Установка каталога шаблонов
     * @param mixed $template Каталог с шаблонами
     */
    public static function setTemplate($template = ".")
    {
        self::$mTemplate = $template . '/';
    }

    /**
     * @param array $context
     */
    public static function setContext($context = array())
    {
        self::$context = $context;
    }

    /**
     * Рендер tpl
     * @param $templateFile
     * @param array $context
     * @return string
     * @throws Exception
     */
    public static function render($templateFile, $context = array())
    {
        if (!file_exists($templateFile))
            $templateFile = self::$mTemplate . $templateFile;

        if (!file_exists($templateFile))
            throw new Exception('Template not found');

        $pageFile = fopen($templateFile, "r");
        $page = fread($pageFile, filesize($templateFile));

        $actions = array();
        $values = array();
        preg_match_all('/([$*#])\{([\w\.]+)\s?([^{^}]+)?\}/', $page, $actions, PREG_PATTERN_ORDER);

        foreach ($actions[3] as $i => $arguments) {
            if (empty($arguments)) {
                if ($actions[1][$i] == "$") {
                    $values[$i] = self::parseExpression($actions[2][$i], $context);

                    if (is_callable($values[$i])) {
                        $values[$i] = call_user_func_array($values[$i], array());
                    }
                } else if ($actions[1][$i] == "#") {
                    $rendered = '';

                    $rendered .= self::render($actions[2][$i], $context);

                    $values[$i] = $rendered;
                }
            } else {
                $argumentsValues = self::parseArgs($arguments, $context);

                if ($actions[1][$i] == "$") {
                    if ($actions[2][$i] == "raw") {
                        $values[$i] = print_r($argumentsValues, true);
                    } else {
                        $function = self::parseExpression($actions[2][$i], $context);

                        if (is_callable($function)) {
                            $values[$i] = call_user_func_array($function, $argumentsValues);
                        } else {
                            $values[$i] = $argumentsValues;
                        }
                    }
                } else if ($actions[1][$i] == "*") {
//                    foreach ($argumentsValues as $i => $array) {
//                        if (!is_array($array)) {
//                            throw new Exception('It is not array : ' . print_r($array, true));
////                            $argumentsValues[$i] = array('' => $array);
//                        }
//                    }

                    $values[$i] = array_merge(...$argumentsValues);
                    $rendered = '';

                    foreach ($values[$i] as $item) {
                        $rendered .= self::render($actions[2][$i], array('key' => 'todo', 'data' => $item));
                    }

                    $values[$i] = $rendered;
                } else if ($actions[1][$i] == "#") {
                    $rendered = '';

                    $rendered .= self::render($actions[2][$i], array('data' => $argumentsValues[0]));

                    $values[$i] = $rendered;
                } else
                    $values[$i] = $argumentsValues;
            }

            EventSystem::fireEvent($actions[2][$i], array(&$values[$i]));
        }

        return str_replace($actions[0], $values, $page);
    }

    public static function parseArgs($argString, $context = array())
    {
        $arguments = array();
        $argumentsValues = array();
        preg_match_all('/([\w\.]+)|([\"\"\/\.\:\w]+)|(\([\(\)\w\"\:\s\.\,]+\))/', $argString, $arguments);

        foreach ($arguments[0] as $i => $argument) {
            $argumentsValues[$i] = self::parseArgument($argument, $context);
        }

        return $argumentsValues;
    }

    public static function parseArgument($argString, $context = array())
    {

        if ($argString[0] == '"') {
            return substr($argString, 1, -1);
        } else if ($argString[0] == '(') {
            return self::parseArray(substr($argString, 1, -1), $context);
        } else {
            return self::parseExpression($argString, $context);
        }
    }

    public static function parseArray($arrayExpression, $context = array())
    {
        $result = array();
        $expressions = array();
        preg_match_all('/(\w+):\s*([\w\"\.]+)/', $arrayExpression, $expressions);

        foreach ($expressions[1] as $i => $key) {
            $result[$key] = self::parseArgument($expressions[2][$i], $context);
        }

        return $result;
    }

    public static function parseExpression($expression, $context = array())
    {
        if ($expression == 'context') {
            return $context;
        }

        $path = array();
        preg_match_all('/(\w+)/', $expression, $path);

        $value = self::getValue($path[0], $context);

        if ($value == 'undefined') {
            $value = self::getValue($path[0], self::$context);
        }

        return $value;
    }

    public static function getValue($path, $context = array())
    {
        if (count($path) == 0) {
            return $context;
        } else {
            $part = array_shift($path);
            return self::getValue($path, isset($context[$part]) ? $context[$part] : 'undefined');
        }
    }
}
