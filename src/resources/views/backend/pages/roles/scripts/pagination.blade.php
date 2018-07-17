<script type="text/javascript">

    $(function() {

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load a').css('color', '#dfecf6');

            var url = $(this).attr('href');
            getArticles(url);
            console.log($(this));
            //window.history.pushState("", "", url);
        });

        function getArticles(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('#paginateRoles').html(data);
            }).fail(function () {
                alert('Roles could not be loaded.');
            });
        }
    });

</script>