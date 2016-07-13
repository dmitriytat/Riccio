<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>${Page.title}</title>

    <!-- Bootstrap -->
    <link href="http://yastatic.net/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
</head>
<body>

<div class="container">

    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                *{menu.tpl articles}
            </ul>
        </nav>
        <h3 class="text-muted"><a href="${Core.home}">${Core.title}</a></h3>
    </div>
