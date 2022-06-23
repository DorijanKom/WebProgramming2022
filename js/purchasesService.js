var purchasesService = {
    init: function(){
    },

    list: function(){
        $.ajax({
            url:"rest/purchases",
            type:"GET",
            beforeSend: function(xhr){
                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data){
                SPApp.handleSectionVisibility("#view_purchases");
                var html=`<table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Book</th>
                    <th scope="col">Time of purchase</th>
                    <th scope="col">Date of purchase</th>
                    <th scope="col">Sold by</th>
                  </tr>
                </thead>
                <tbody>`;
                for(let i=0;i<data.length;i++){
                    html+=`<tr>
                    <th scope="row">`+i+`</th>
                    <td>`+data[i].id+`</td>
                    <td>`+data[i].Book_Name+`</td>
                    <td>`+data[i].Time_of_Purchase+`</td>
                    <td>`+data[i].Date_of_Purchase+`</td>
                    <td>`+data[i].User_Name+` `+data[i].User_Last_Name+`</td>
                  </tr>`
                }
                html+=`</tbody>
                        </table>`;
              $("#view_purchases").html(html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.message);
                //usersService.logout();
              }
        })
    },

}