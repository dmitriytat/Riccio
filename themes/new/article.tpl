<div class="jumbotron" r-id="{$id}" r-role="Article">
    <h1 r-role="title"><a href="{$Core/home}index.php?alias={$alias}">{$title}</a></h1>
    <div r-role="description">{$description}</div>
    <p class="lead" r-role="content">{$content}</p>
    <div r-role="keywords">{$keywords}</div>
    <br/>
    {$SocialShare}
    <a href="{$Core/home}index.php?alias={$alias}&mode=json">json link</a>
</div>