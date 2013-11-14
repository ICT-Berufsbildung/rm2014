<%@include file="header.jsp" %>

    <section class="section-breadcrumb">
        <ul class="breadcrumb">
          <li><a href="./home">Home</a> <span class="divider">/</span></li>
          <li class="active">Thread list</li>
        </ul>
    </section>

	<c:forEach var="thread" items="${threads}">
	    <section>
	        <h2>
	            <a href="thread_detail?id=${fn:escapeXml(thread.idThread)}">${fn:escapeXml(thread.name)}</a>
	            <ul class="rating pull-right">
	                <li><a href="./rating?id_thread=${fn:escapeXml(thread.idThread)}&amp;id_comment=${fn:escapeXml(thread.idComment)}&amp;dir=up" title="vote up"><span class="badge badge-success">+${fn:escapeXml(thread.ratingUp)}</span></a></li>
	                <li><a href="./rating?id_thread=${fn:escapeXml(thread.idThread)}&amp;id_comment=${fn:escapeXml(thread.idComment)}&amp;dir=down" title="vote down"><span class="badge badge-important">-${fn:escapeXml(thread.ratingDown)}</span></a></li>
	            </ul>
	        </h2>
	        <p>
	            ${fn:escapeXml(thread.content)}
	        </p>
	        <a href="thread_detail?id=${fn:escapeXml(thread.idThread)}">Read more</a>
	    </section>
    </c:forEach>

    <section>
        <h1 id="add_thread">Add thread</h1>
        <form action="#add_thread" method="post">

            <label for="add_name_author">Your name</label>
            <input type="text" id="add_name_author" name="name_author" value="${fn:escapeXml(param.name_author)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.name_author)}</span></span>

            <label for="add_name_thread">Your email</label>
            <input type="email" id="add_name_thread" name="email_author" value="${fn:escapeXml(param.email_author)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.email_author)}</span></span>

            <label for="add_name_thread">Thread name</label>
            <input class="input-xlarge" type="text" id="add_name_thread" name="name_thread" value="${fn:escapeXml(param.name_thread)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.name_thread)}</span></span>

            <label for="add_name_thread">Your question</label>
            <textarea class="input-xlarge" rows="3" name="content">${fn:escapeXml(param.content)}</textarea>            
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.content)}</span></span>

            <p><button type="submit" class="btn">Add thread</button></p>
        </form>
    </section>

<%@include file="footer.jsp" %>
