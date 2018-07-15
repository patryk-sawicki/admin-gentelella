<script>
    function deleteConfirmation(url){
        if (confirm("Are you sure you want to delete")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                dataType: 'html',
                type:'POST',
                url:url,
                data: {
                    _method: 'delete'
                },
                success:function(data){
                    location.reload();
                },
                error:function(data){

                }

            });
        }
    }
</script>