<div class="jumbotron" r-id="${data.id}" r-role="Article">
    <h1 r-role="title"><a href="${Core.home}${data.alias}.html">${data.title}</a></h1>
    <p class="lead" r-role="description">${data.description}</p>
    <div r-role="content">${data.content}</div>
    <br/>
    <div r-role="keywords">${data.keywords}</div>
    <br/>
    ${SocialShare Core.home data.alias ".html"}
    <a href="${Core.home}${data.alias}.json">json link</a>

    ${MessagesPlugin data.id}
</div>
