$(document).ready(function()
{   
    $('#total').click(function(){
        let quantity=$('#quantity').val();
        let price = $('#price').val();
        let total=quantity*price;
       $('#total').val(total);
    });

    $('#example').DataTable();
});