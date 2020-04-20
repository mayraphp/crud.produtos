<!DOCTYPE html>
<html>

<head>
    <title>Import Excel File in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <br />

    <div class="container">
        <h3 align="center">Lista de Produtos</h3>
        <br />
        <div class="form-inline">
            <form id="excelForm" class="form-group" enctype="multipart/form-data">
                <input type="file" class="form-control" name="import_file" />
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
                            <td>
                                <button data-route="{{ route('show') }}" data-product="{{ $row->id }}" type="button" class="btn btn-primary show-button" data-toggle="modal" data-target="#exampleModal">
                                    Visualizar
                                </button>
                                <button type="button" class="btn btn-danger">Deletar</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".show-button").click(function() {

                $.ajax({
                    url: $(this).attr('data-route'),
                    type: 'post',
                    data: {
                        "id" : $(this).attr('data-product'),
                    }
                }).done(function(response) {

                    $(".name-product-title").text(response.name)
                    $(".name-product").text("Nome: " + response.name)
                    $(".description-product").text("Descrição: " + response.description)
                    $(".price-product").text("Valor: " + response.price)
                    $(".quantity-product").text("Quantidade em estoque: " + response.quantity)

                });
            });

            $('#excelForm').submit(function(event) {
                event.preventDefault();
                var form = $('#excelForm')

                var formdata = new FormData(document.getElementById("excelForm"));

                $.ajax({
                    url: $('#route-import').val(),
                    type: 'post',
                    data: formdata,
                    processData: false,
                    contentType: false
                }).done(function(response) {
                    $("#alert-queue").append("<div class='alert alert-success' role='alert'>" + response.msg + "</div>");
                });

            });
        });
    </script>
</body>

</html>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title name-product-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item name-product"></li>
                    <li class="list-group-item description-product" ></li>
                    <li class="list-group-item price-product" ></li>
                    <li class="list-group-item quantity-product" ></li>
                  </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
