$(document).ready(function (){

    $(".delete-btn").click(function () {
        if(!confirm("are you sure")) return false;
        var id = $(this).parent().parent().children().eq(0).text();
        var csrf =  $('#csrf_field').val();

        // console.log(csrf);

        $.ajax({
            method: "POST",
            url: "/admin/category/postDelete",
            dataType: "json",
            // contentType: 'application/json',
            data: {
                'id': id,
                '_token': csrf,

            },
            success: function (data) {
                // console.log(data);

                if(data.success) {
                    alert("delete category #"+id+" successfully");
                    location.reload();
                }
                else alert("Something went wrong ! Cannot delete category")


            },
            error: function(xhr, status, error){
                let errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Error - ' + errorMessage);
            }
        });

        // console.log(id);
    });

    $(".update-btn").click(function (){
        var id = $(this).parent().parent().children().eq(0).text();
    });


});

