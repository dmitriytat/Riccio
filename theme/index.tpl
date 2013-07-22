
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="{$home}/theme/css/bootstrap.min.css" rel="stylesheet">
        <link href="{$home}/theme/css/bootstrap-responsive.min.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="{$home}/theme/favicon.ico">
        <link href="{$home}/theme/css/main.css" rel="stylesheet">
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="{$home}"><i class="icon-home icon-white"></i> {$project}</a></li>
                            <li><a href="{$home}/computer.html"><i class="icon-fire icon-white"></i> Computer</a></li>
                            <li><a href="https://github.com/dimkosru/Riccio"><i class="icon-download-alt icon-white"></i> GitHub</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h1>{$title}</h1>
            </div>
            <hr>
            <!-- Example row of columns -->
            <div class="row">
                <div class="row">
                    <div class="span10">
                        {$version}
                        {$widget}
                    </div>
                </div>


            </div>
            <hr>

            <footer>
                <p>{$copy}</p>
            </footer>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{$home}/theme/js/jquery.js"></script>
        <script src="{$home}/theme/js/bootstrap.min.js"></script>

    </body>
</html>
