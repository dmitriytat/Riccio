<?php

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.07.16
 * Time: 20:39
 */
class ArticlesController
{
    public static function all($params)
    {
        $articles = Article::all();

        if (isset($params['ext']) && $params['ext'] == "json") {
            return json_encode($articles);
        } else {
            return TemplateSystem::render('index.tpl', array('articles' => $articles));
        }
    }

    public static function one($params)
    {
        $article = Article::findOne(array('alias' => $params['alias']));

        if (isset($params['ext']) && $params['ext'] == "json") {
            return json_encode($article);
        } else {
            return TemplateSystem::render('single.tpl', array('article' => $article));
        }
    }
}