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
            console.log(data);
            var html="";
            for(let i=0;i<data.length;i++){
      
                html+=`
                <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fbanner2.kisspng.com%2F20180422%2Fvzq%2Fkisspng-drawing-book-sketch-5adcf25816d295.9076212715244294000935.jpg&f=1&nofb=1" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">`+data[i].Writer_Name +` ` +data[i].Writer_Last_Name+`</h4>
                        <h5 class="card-title">`+data[i].Book_Name+`</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary books-button" onclick="BookService.get(`+data[i].id+`)">View Info</button>
                            <button type="button" class="btn btn-danger books-button" onclick="BookService.delete(`+data[i].id+`)">Delete</button>
                        </div>
                    </div>
                    </div>
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
            $("#writerName").val(data.Writer_Name);
            $("#writerLastName").val(data.Writer_Last_Name);
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