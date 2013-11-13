<%@include file="header.jsp" %>

<section class="section-breadcrumb">
    <ul class="breadcrumb">
      <li class="active">Home</li>
    </ul>
</section>

<section>
    <h1>
        <a href="thread_detail.html">Hottest thread: ${fn:escapeXml(thread.name)}</a>
        <ul class="rating pull-right">
            <li><a href="#" title="vote up"><span class="badge badge-success">+${fn:escapeXml(thread.ratingUp)}</span></a></li>
            <li><a href="#" title="vote down"><span class="badge badge-important">-${fn:escapeXml(thread.ratingDown)}</span></a></li>
        </ul>
    </h1>
    <p>
        ${fn:escapeXml(thread.content)}
    </p>
    <a href="thread_detail.html">Read more</a>
</section>

<%@include file="footer.jsp" %>
