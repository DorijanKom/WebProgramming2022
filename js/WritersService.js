var WritersService = {
    init: function(){
        $('#addWritersForm').validate({
            submitHandler: function(form){ 
                var writers = Object.fromEntries((new FormData(form)).entries())
                WritersService.add(writers);
              }
        })
    },

    add: function(writers){
        $.ajax({
            url:'rest/writers',
            type:'POST',
            data:JSON.stringify(writers),
            contentType:'application/json',
            dataType:'json',
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(result){
                $('#addElementWriter').modal("hide");
                console.log(result);
            }
        })
    }
}