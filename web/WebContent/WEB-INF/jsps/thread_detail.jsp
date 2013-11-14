<%@include file="header.jsp" %>

    <section class="section-breadcrumb">
        <ul class="breadcrumb">
          <li><a href="./home">Home</a> <span class="divider">/</span></li>
          <li><a href="./thread_list">Threads</a> <span class="divider">/</span></li>
          <li class="active">Thread name</li>
        </ul>
    </section>

	<c:if test="${not empty param.success}">
		<div class="alert alert-success">${fn:escapeXml(param.success)}</div>
	</c:if>

	<c:forEach var="comment" items="${comments}" varStatus="status">
	    <section>
	        <h2>
	            ${fn:escapeXml(status.first ? comment.nameThread : comment.nameAuthor)}
	            <ul class="rating pull-right">
	                <li><a href="./rating?id_thread=${fn:escapeXml(comment.idThread)}&amp;id_comment=${fn:escapeXml(comment.idComment)}&amp;dir=up" title="vote up"><span class="badge badge-success">+${fn:escapeXml(comment.ratingUp)}</span></a></li>
	                <li><a href="./rating?id_thread=${fn:escapeXml(comment.idThread)}&amp;id_comment=${fn:escapeXml(comment.idComment)}&amp;dir=down" title="vote down"><span class="badge badge-important">-${fn:escapeXml(comment.ratingDown)}</span></a></li>
	            </ul>
	        </h2>
	        <c:if test="${status.first}">
		        <p>
		        	<c:forEach var="tag" items="${tags}">
		        		<span class="label label-info">${fn:escapeXml(tag)}</span>
		        	</c:forEach>
		        </p>
	        </c:if>
	        <p>
	            ${fn:escapeXml(comment.content)}
	        </p>
	        <a href="thread_detail.html">Read more</a>
	    </section>
    </c:forEach>

    <section>
        <h1 id="add_tag">Add tag</h1>
        <form action="#add_tag" method="post">

            <label for="name_tag">Tag</label>
            <input type="text" id="add_name_tag" name="name_tag" value="${fn:escapeXml(param.name_tag)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.name_tag)}</span></span>

            <p><input type="submit" name="add_tag" class="btn" value="Add tag"></p>
        </form>
    </section>

    <section>
        <h1 id="add_comment">Add comment</h1>
        <form action="#add_comment" method="post">

            <label for="add_name_author">Your name</label>
            <input type="text" id="add_name_author" name="name_author" value="${fn:escapeXml(param.name_author)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.name_author)}</span></span>

            <label for="add_name_thread">Your email</label>
            <input type="email" id="add_name_thread" name="email_author" value="${fn:escapeXml(param.email_author)}">
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.email_author)}</span></span>

            <label for="add_name_thread">Comment</label>
            <textarea class="input-xlarge" rows="3" name="content">${fn:escapeXml(param.content)}</textarea>            
           	<span class="help-inline"><span class="text-error">${fn:escapeXml(errors.content)}</span></span>

            <p><input type="submit" name="add_comment" class="btn" value="Add comment"></p>
        </form>
    </section>

<%@include file="footer.jsp" %>
