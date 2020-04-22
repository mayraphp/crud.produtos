@extends('layouts.app') @section('content')

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
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->quantity }}</td>
                            <td>{{ $row->price }}</td>
                            <td>{{ $row->description }}</td>
                            <td>
                                <button data-route="{{ route('show') }}" data-product="{{ $row->id }}" type="button" class="btn btn-primary show-button" data-toggle="modal" data-target="#showProductModal">
                                    Visualizar
                                </button>
                                <a href="{{ route('destroy', ['product' => $row->id]) }}" class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{$data->links()}}


@endsection

<div class="modal fade" id="showProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <li class="list-group-item description-product"></li>
                    <li class="list-group-item price-product"></li>
                    <li class="list-group-item quantity-product"></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
