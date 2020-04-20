<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />

  <div class="container">
   <h3 align="center">Lista de Produtos</h3>
    <br />
   <div class="form-inline">
        <form id="excelForm" class="form-group" enctype="multipart/form-data">
        <input type="file" class="form-control"  name="import_file" />
        <button class="btn btn-success ml-3" type="submit" class="form-control">Importar Excel</button>
        <input type="hidden" id='route-import' value="{{ route('import') }}">
        </form>
    </div>
   <br />
   <p id="alert-queue"></p>
   <div class="panel panel-default">
   <div id="alert-queue"></div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Valor</th>
        <th>Descrição</th>
        <th>Ações</th>
       </tr>
       @foreach($data as $row)
       <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->quantity }}</td>
        <td>{{ $row->price }}</td>
        <td>{{ $row->description }}</td>
        <td></td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
   </div>
  </div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
  <script type="text/javascript">
     $(document).ready(function(){
     $('#excelForm').submit(function(event){
     event.preventDefault();
     var form = $('#excelForm')

     var formdata = new FormData(document.getElementById("excelForm"));

     $.ajax({
         url : $('#route-import').val(),
         type : 'post',
         data : formdata,
         processData: false,
         contentType: false
    }).done(function(response) {
        $("#alert-queue").append("<div class='alert alert-success' role='alert'>"+ response.msg+"</div>");
    });

    });
});
  </script>
 </body>
</html>

