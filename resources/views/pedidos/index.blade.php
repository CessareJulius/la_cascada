@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="content-header">
            <h3 class="title">Pedidos</h3>
        </div>
        <div class="dt-responsive">
            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap" style="width: 96%;">
                <thead>
                    <tr>
                        <th>NRO</th>
                        <th>CLIENTE</th>
                        <th>PEDIDO</th>
                        <th>CANT</th>
                        <th>STATUS ACTUAL</th>
                        <th>HORA</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $index => $pedido)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}</td>
                            <td>{{ $pedido->menu->nombre }}</td>
                            <td>{{ $pedido->cantidad }}</td>
                            <td>{{ $pedido->status }}</td>
                            <td>
                                {{ explode(' ', $pedido->created_at)[1] }}
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" title="Editar">
                                    Iniciar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            /*  */
        })
        setTimeout(() => {
            $("#alt-pg-dt_length").children('label')[0].firstChild.nodeValue = "Mostrar "
            $("#alt-pg-dt_length").children('label')[0].lastChild.nodeValue = " registros"
            $("#alt-pg-dt_filter").children('label')[0].firstChild.nodeValue = "Buscar:"
        }, 1000);
    </script>
@endpush