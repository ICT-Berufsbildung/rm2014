<%@include file="header.jsp" %>

    <section class="section-breadcrumb">
        <ul class="breadcrumb">
          <li><a href="./home">Home</a> <span class="divider">/</span></li>
          <li><a href="./thread_list">Threads</a> <span class="divider">/</span></li>
          <li class="active">Thread name</li>
        </ul>
    </section>

	<c:forEach var="comment" items="${comments}" varStatus="status">
	    <section>
	        <h2>
	            ${fn:escapeXml(status.first ? comment.nameThread : comment.nameAuthor)}
	            <ul class="rating pull-right">
	                <li><a href="#" title="vote up"><span class="badge badge-success">+${fn:escapeXml(comment.ratingUp)}</span></a></li>
	                <li><a href="#" title="vote down"><span class="badge badge-important">-${fn:escapeXml(comment.ratingDown)}</span></a></li>
	            </ul>
	        </h2>
	        <p>
	            ${fn:escapeXml(comment.content)}
	        </p>
	        <a href="thread_detail.html">Read more</a>
	    </section>
    </c:forEach>

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
