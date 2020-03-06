$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
//     total();
//     items();
//     $('.add_cart').on('click', function (e) {
//         e.preventDefault();
//         var id = $(this).attr('id');
//         $.ajax({
//             url: "add_cart",
//             type: "POST",
//             data: { id: id },
//             success: function (data) {
//                 $('#check').html(data);
             
//                 total();
//                 items();
//                 //location.reload();
//             },
//             error: function (err) {
//                 alert(err);
//             },
//         });
//     });


// //    show_cart();
// //     function show_cart()
// //     {
// //         $.ajax({
// //             url: 'show_cart',
// //             type: 'GET',
// //             success: function (response) {
               
// //              // $('#cart_view').html(response);
// //              }
// //         });
// //     }
//     increment_cart();
//     function increment_cart()
//     {
//         $('.increment_cart').on('click', function (e) {
//             e.preventDefault();
//             var id = $(this).attr('cart_id');
//             //alert(id);
//             $.ajax({
//                 url: 'increment_cart',
//                 type: 'get',
//                 data: { id: id },
//                 success: function (data) {
//                     //alert(data);
//                    // show_cart();
//                     total();
//                     items();
//                 }
//             });
//         });

//     }
//     decrement_cart();
//     function decrement_cart()
//     {
//         $('.decrement_cart').on('click', function (e) {
//             e.preventDefault();
//             var id = $(this).attr('cart_id');
//             //alert(id);
//             $.ajax({
//                 url: 'decrement_cart',
//                 type: 'get',
//                 data: { id: id },
//                 success: function (data) {
//                     //alert(data);
//                    // show_cart();
//                     total();
//                     items();
//                 }
//             })
//         });
//     }
//     delete_cart();
//     function delete_cart()
//     {
//         $('.delete_cart').on('click', function (e) {
//             e.preventDefault();
//             var id = $(this).attr('cart_id');
//             // alert(id);
//             $.ajax({
//                 url: 'delete_cart',
//                 type: 'get',
//                 data: { id: id },
//                 success: function (data) {
//                    // alert(data);
//                     //show_cart();
//                     total();
//                     items();
//                 }
//             })
//         });
//     }
//     items();
//     function items()
//     {
//         $.ajax({
//             url:'cart_items',
//             type:'get',
//             success:function(data)
//             {
//               $('.items').html(data);
//             }
//         })
//     }
//     total();
//     function total() {
//         $.ajax({
//             url: 'cart_total',
//             type: 'get',
//             success: function (data) {
//                 $('.total').html(data);
//             }
//         })
//     }

});