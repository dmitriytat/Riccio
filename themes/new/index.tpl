{#Header, header.tpl}

    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                {!Menu/Items, menu.tpl}
            </ul>
        </nav>
        <h3 class="text-muted"><a href="/">{$Core/title}</a></h3>
    </div>

    {!List/Items, article.tpl}

{#Footer, footer.tpl}