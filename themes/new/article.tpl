<div class="jumbotron" r-id="${data.id}" r-role="Article">
    <h1 r-role="title"><a href="${data.url}.html">${data.title}</a></h1>
    <div r-role="description">${data.description}</div>
    <p class="lead" r-role="content">${data.content}</p>
    <div r-role="keywords">${data.keywords}</div>
    <br/>
    ${SocialShare data.url ".html"}
    <a href="${data.url}.json">json link</a>
</div>