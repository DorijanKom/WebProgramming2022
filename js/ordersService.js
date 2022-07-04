var OrdersService = {
    init: function(){

    },

    list: function(){
        $.ajax({
            url: "rest/orders",
            type: "GET",
            beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data){
                SPApp.handleSectionVisibility("#view_orders");
                var html=`<table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Book</th>
                    <th scope="col">Order amount</th>
                    <th scope="col">Order price</th>
                    <th scope="col">Date of order</th>
                    <th scope="col">Date of delivery</th>
                    <th scope="col">Ordered by</th>
                  </tr>
                </thead>
                <tbody>`;
                for(let i=0;i<data.length;i++){
                    html+=`<tr>
                    <th scope="row">`+data[i].id+`</th>
                    <td>`+data[i].Book_Name+`</td>
                    <td>`+data[i].Order_Amount+`</td>
                    <td>`+data[i].Order_price+`</td>
                    <td>`+data[i].Date_of_Order+`</td>
                    <td>`+data[i].Date_of_Delivery+`</td>
                    <td>`+data[i].User_Name+` `+data[i].User_Last_Name+`</td>
                  </tr>`
                }
                html+=`</tbody>
                        </table>`;
              $("#view_orders").html(html);
            },
        })
    }
}