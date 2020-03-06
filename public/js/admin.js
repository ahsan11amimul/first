$(document).ready(function(){
   
    $('#total').click(function(){
       // alert('Hi');
       let price=parseInt($('#price').val());
       //alert(price);
       let quantity=parseInt($('#quantity').val());
       //alert(quantity);
       let total=price*quantity;
       //alert(total);
       $('#total').val(total);
    });
    // $('#new_password').click(function () {
    //     let current_password = $('#current_password').val();

    //     $.ajax({
    //         type: 'GET',
    //         url: '/admin/check_password',
    //         data: { current_password: current_password },
    //         success: function (response) {
    //             if (response == "wrong") {
    //                 $('#check_password').html("<h5>Password does not Match</h5>");
    //             } else {
    //                 $('#check_password').html("<h5>Password  Match</h5>");
    //             }
    //         }, error: function () {
    //             alert("Error");
    //         }
    //     });
    //     let new_password = $('#new_password').val();

    //     let confirm_password = $('#confirm_password').val();
    //     if (new_password !== confirm_password) {
    //         $('#confirm_status').html("<h5>Password does not Match!!</h5>");
    //     }
    // });
       
    $('#example').DataTable();
});