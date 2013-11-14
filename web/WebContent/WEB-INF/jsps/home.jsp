<%@include file="header.jsp" %>

<section class="section-breadcrumb">
    <ul class="breadcrumb">
      <li class="active">Home</li>
    </ul>
</section>

<section>
    <h1>
        <a href="thread_detail?id=${fn:escapeXml(thread.id)}">Hottest thread: ${fn:escapeXml(thread.name)}</a>
        <ul class="rating pull-right">
            <li><a href="#" title="vote up"><span class="badge badge-success">+${fn:escapeXml(thread.ratingUp)}</span></a></li>
            <li><a href="#" title="vote down"><span class="badge badge-important">-${fn:escapeXml(thread.ratingDown)}</span></a></li>
        </ul>
    </h1>
    <p>
        ${fn:escapeXml(thread.content)}
    </p>
    <a href="thread_detail?id=${fn:escapeXml(thread.id)}">Read more</a>
</section>

<section>
    <h1>Welcome to IT Help</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lectus urna, porta sit amet orci eu, sollicitudin consequat urna. Praesent nec lacus vitae elit accumsan vestibulum. Ut eu euismod metus. Pellentesque a quam ornare, blandit tellus eget, egestas risus. Etiam nec urna vitae augue viverra aliquam. Proin aliquet ultricies odio, congue malesuada purus imperdiet vitae. Nunc laoreet eleifend turpis nec suscipit. Morbi lacinia tortor mi, sit amet ultrices nisl varius eu. Vestibulum elit nisi, sollicitudin id urna sit amet, scelerisque elementum eros. Vivamus rutrum tempor dolor, eu luctus metus facilisis vel. Sed molestie varius adipiscing. Aliquam erat volutpat. Nulla non magna condimentum, scelerisque odio ut, condimentum quam. Aenean enim nulla, placerat eget tellus vel, ullamcorper blandit odio. Curabitur at nibh pellentesque, pretium urna at, porttitor libero. Pellentesque tellus nulla, suscipit a sodales ut, dapibus eu magna.
    </p>
    <p>
        Pellentesque gravida vestibulum diam in vestibulum. Phasellus venenatis sagittis enim. Vivamus facilisis dapibus tortor, et euismod velit. Mauris tellus dolor, accumsan in malesuada vitae, auctor ac augue. Integer adipiscing, lectus a pretium elementum, arcu felis suscipit mi, ac faucibus nibh massa vitae turpis. Integer egestas sapien eu nisi sagittis, et venenatis nisl dictum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed scelerisque tristique lobortis. Morbi eu convallis justo. In hac habitasse platea dictumst. Aenean eu lacus a neque facilisis porttitor. Phasellus ultricies, orci nec consequat sodales, risus arcu dictum arcu, eu aliquet ligula lacus sed erat. Etiam euismod nunc eget turpis facilisis sodales nec tincidunt orci. Fusce tristique sagittis risus. Maecenas rhoncus sed diam quis tincidunt.
    </p>
    <p>
        Pellentesque vel sem posuere, adipiscing lorem sed, tincidunt mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus mollis blandit adipiscing. Praesent blandit a eros vel interdum. Aenean vitae nisl tortor. Duis et lorem pulvinar, interdum sem et, pellentesque leo. Nunc iaculis, felis cursus elementum fringilla, dolor risus tempor dolor, in dictum sem sapien eu urna. Cras dapibus sem sed ligula consequat, in laoreet ante viverra.
    </p>
</section>

<%@include file="footer.jsp" %>
