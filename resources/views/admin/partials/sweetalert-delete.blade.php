<script>

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            type: "DELETE",
            url: url,
            success: function (response) {
                Swal.fire(
                    'Deleted!',
                    'Item has been deleted.',
                    'success'
                )
                .then((result)=>{
                    location.reload()
                })
            }
        }); 
    }
})
});
</script>