<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$article_title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{$article_description}">
    <meta name="author" content="{$article_author}">
    <link rel="shortcut icon" href="{$core_template}favicon.ico">
    <link href="{$core_template}css/style.css" rel="stylesheet">
    <link href="{$core_home}admin/css/admin.css" rel="stylesheet">
</head>
<body>
{!logo}
{!menu}
<div class="container">
    <div class="column large19 content" r-id="{$article_id}">
        <h1 r-editable="true" r-type="string" r-field="title">{$article_title}</h1>
        <p class="large6" r-editable="true" r-type="string" r-field="keywords">{$article_keywords}</p>
        <p class="large9" r-editable="true" r-type="string" r-field="description">{$article_description}</p>
        <p class="large12" r-editable="true" r-type="text" r-field="content">{$article_content}</p>
    </div>
    <div class="column large5 rightcol">
        <div class="widget">
            <div class="widget-head">Теги</div>
            <div class="widget-content">
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
            </div>
        </div>
        <div class="widget">
            <div class="widget-head">Хуеги</div>
            <div class="widget-content">
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
                dsfsfd
                asdf
                a
                sdf
                vd
                fav
                safd
                va
                sfa
                es
            </div>
        </div>
    </div>
</div>

<div class="container footer">
    <div class="column large24 footer-inner"><a href="{$core_home}">{$core_home}</a>   -   система управления контентом. {$core_copy}</div>
</div>

<script src="{$lib_jquery}"></script>
<script src="{$core_template}js/main.js"></script>
<script src="{$core_home}admin/js/admin.js"></script>
</body>
</html>