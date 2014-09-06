<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{$description}">
    <meta name="author" content="{$author}">
    <link rel="shortcut icon" href="{$template}favicon.ico">
    <link href="{$template}css/style.css" rel="stylesheet">
    <link href="{$home}admin/css/admin.css" rel="stylesheet">
</head>
<body>
{!logo}
{!menu}
<div class="container">
    <div class="column large19 content" r-id="{$Aid}">
        <h1 r-editable="true" r-type="string" r-field="title">{$Atitle}</h1>
        <p class="large6" r-editable="true" r-type="string" r-field="keywords">{$Akeywords}</p>
        <p class="large9" r-editable="true" r-type="string" r-field="description">{$Adescription}</p>
        <p class="large12" r-editable="true" r-type="text" r-field="content">{$Acontent}</p>
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
    <div class="column large24 footer-inner"><a href="{$home}">{$home}</a>   -   система управления контентом. {$copy}</div>
</div>

<script src="{$jquery}"></script>
<script src="{$template}js/main.js"></script>
<script src="{$home}admin/js/admin.js"></script>
</body>
</html>