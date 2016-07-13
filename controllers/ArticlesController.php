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

        if (isset($params['parameters']['ext']) && $params['parameters']['ext'] == "json") {
            return json_encode($articles);
        } else {
            return TemplateSystem::render('index.tpl', array('articles' => $articles, 'page' => array('title' => 'Articles')));
        }
    }

    public static function one($params)
    {
        $article = Article::findOne(array('alias' => $params['parameters']['alias']));

        if (isset($params['parameters']['ext']) && $params['parameters']['ext'] == "json") {
            return json_encode($article);
        } else {
            return TemplateSystem::render('single.tpl', array('article' => $article, 'page' => array('title' => 'Articles -> ' . $article['title'])));
        }
    }
}