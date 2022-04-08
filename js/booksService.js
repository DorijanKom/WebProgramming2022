var BookService = {
    init: function(){
        $('#addBooksForm').validate({
            submitHandler: function(form){ 
              var books = Object.fromEntries((new FormData(form)).entries())
              BookService.add(books);
            }
          });
          BookService.list();
    },

    list: function(){
        $.get('rest/books',function(data){
            $("#book-list").html("");
      
            var html="";
            for(let i=0;i<data.length;i++){
      
                html+=`
                <div class="col-lg-4">
                    <h2>`+data[i].Book_Name+`</h2>
                    <p>`+data[i].Date_of_Publishing+`</p>
                    <p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary books-button" onclick="BookService.get(`+data[i].id+`)">View Info</button>
                            <button type="button" class="btn btn-danger books-button" onclick="BookService.delete(`+data[i].id+`)">Delete</button>
                        </div>
                </p>
                </div>`;
            }
            $("#book-list").html(html);
        });
    },

    get: function(id){
        $(".books-button").attr("disabled",true);
        $.get('rest/books/'+id,function(data){
            console.log(data);
            //$("#exampleModal .modal-body").html(id);
            $("#id").val(data.id);
            $("#bookName").val(data.Book_Name);
            $("#writerid").val(data.Writer_ID);
            $("#dateofPublishing").val(data.Date_of_Publishing);
            $("#price").val(data.Book_price);
            $("#exampleModal").modal("show")
            $(".books-button").attr("disabled",false);
        })
    },

    add: function(books){
        $.ajax({
            url:'rest/books',
            type:'POST',
            data:JSON.stringify(books),
            contentType:'application/json',
            dataType:'json',
            success:function(result){
              $('#book-list').html(`<div id="book-list" class="row">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                          <span class="sr-only"></span>
                        </div>
                    </div>
                </div>`);
              $("#addElement").modal("hide");
              BookService.list();
              console.log(result);
            }
          })
    },

    delete: function(id){
     $(".books-button").attr("disabled",true);
    $.ajax({
      url:'rest/books/'+id,
      type:'DELETE',
      success: function(result){
        $('#book-list').html(`<div id="book-list" class="row">
              <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                  </div>
              </div>
          </div>`)
          BookService.list();
      }
    })
    },

    update: function(id){
        $(".books-button").attr("disabled",true);
        var books={};
        books.Book_Name=$("#bookName").val();
        books.Writer_ID=$("#writerid").val();
        books.Date_of_Publishing=$("#dateofPublishing").val();
        books.Book_price=$("#price").val();
    
        $.ajax({
          url:'rest/books/'+$("#id").val(),
          type:'PUT',
          data:JSON.stringify(books),
          contentType:'application/json',
          dataType:'json',
          success: function(result){
            $("#exampleModal").modal("hide");
            $(".books-button").attr("disabled",false);
            $('#book-list').html(`<div id="book-list" class="row">
                  <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                      </div>
                  </div>
              </div>`)
              BookService.list();
          }
        })
    }
}