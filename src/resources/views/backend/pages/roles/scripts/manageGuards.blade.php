<script>
    function listRolePermission(guard_name, role_id = null){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            dataType: 'html',
            type:'GET',
            url:"{{url('/admin/roles')}}",
            data: {
                guard_name: guard_name
            },
            success:function(data){
                $("#createRolePermissions").html(data);
                //$('#showQuiz').modal('show');
            },
            error:function(data){

            }

        });
    }
</script>