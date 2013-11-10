
    <footer>
        Copyright &copy; <?php echo date('Y'); ?> <strong>IT Help</strong> - ICT Championships 2014 <br /> Candidate information
    </footer>
</div>

<script>
$('.vote').click(function (e) {
    e.preventDefault();

    var element = $(this);

    $.ajax({
        type: 'POST',
        url: './vote.php',
        data: {
            id: element.data('id'),
            rating: element.data('rating')
        }
    }).done(function (html) {
        element.find('.badge').html(html);
    });
});
</script>
</body>
</html>
