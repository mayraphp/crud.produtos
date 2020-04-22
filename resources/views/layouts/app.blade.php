<!DOCTYPE html>
<html>

<head>
    <title>Import Excel File in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        @yield('content')
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
                        "id": $(this).attr('data-product'),
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
