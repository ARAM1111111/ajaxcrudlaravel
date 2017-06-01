<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>AJAX CRUD LARAVEL 5.3</title>

    <!-- Bootstrap -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <div class="container">
      @yield('content')
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/JavaScript">
      //-----------------------EDIT -----------------

      $(document).on('click', '.edit-modal', function(event) {
        $('#footer_action_button').text('Update').addClass('glyphicon-check').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success').removeClass('btn-danger').addClass('edit');
        $('.modal-title').text('EDIT');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#t').val($(this).data('title'));
        $('#d').val($(this).data('description'));
        $('#myModal').modal('show');
      });
      $('.modal-footer').on('click', '.edit', function(event) {
        $.ajax({
          type:'POST',
          url:'/editItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    'id':$('#fid').val(),
                    'title':$('#t').val(),
                    'description':$('#d').val()
              },
          success:function(data) {
            $('.item'+ data.id).replaceWith("<tr class='item'"+data.id+"><td>"+data.id+"</td></td>"+data.title+"</td><td>"+data.description+"</td><button class='edit-modal btn btn-info' data-id="+data.id+"data-title="+data.title+"data-description"+data.description+"><span class='glyphicon glyphicon-edit'></span>EDIT</button><button class='delete-modal btn btn-danger' data-id="+data.id+"data-title="+data.title+"data-description="+data.description+"><span class='glyphicon glyphicon-trash'></span>DELETE</button></td></tr>");

              location.reload();
          }
        });
      });

      // ============== ADD =============================

      $('#add').click(function(){
          $.ajax({
          type:'POST',
          url:'/addItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    
                    'title':$('input[name=title]').val(),
                    'description':$('input[name=description]').val(),
              },
          success:function(data) {
              if((data.errors)){
                $('.error').removeClass('hidden').text(data.errors.title).text(data.errors.description);
              }
              else{
                $('.error').remove();
                $('#table').append('.item'+ data.id).replaceWith("<tr class='item'"+data.id+"><td>"+data.id+"</td></td>"+data.title+"</td><td>"+data.description+"</td><button class='edit-modal btn btn-info' data-id="+data.id+"data-title="+data.title+"data-description"+data.description+"><span class='glyphicon glyphicon-edit'></span>EDIT</button><button class='delete-modal btn btn-danger' data-id="+data.id+"data-title="+data.title+"data-description="+data.description+"><span class='glyphicon glyphicon-trash'></span>DELETE</button></td></tr>");
              }

              location.reload();
          }
        });
          $('#title').val('');
          $('#description').val('');


      });

      // ====================== DELETE ========================

      $(document).on('click', '.delete-modal', function(event) {
        $('#footer_action_button').text('DELETE').removeClass('glyphicon-check').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success').addClass('btn-danger').addClass('delete');
        $('.modal-title').text('DELETE');
        $('.id').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.title').val($(this).data('title'));
        $('#myModal').modal('show');
      });
      $('.modal-footer').on('click', '.delete', function(event) {
        $.ajax({
          type:'POST',
          url:'/delItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    'id':$('.id').text(),
                    
              },
          success:function(data) {
            $('.item'+ $('.id').text()).remove();

              location.reload();
          }
        });
      });

    </script>
  </body>
</html>	