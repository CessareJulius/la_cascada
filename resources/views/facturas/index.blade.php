@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="content-header">
            <h3 class="title">Facturas</h3>
            <button type="button" class="btn btn-info table-custom-btn" data-toggle="modal" data-target="#modal_select_v_client">
                <i class="ik ik-share"></i>Nueva Factura
            </button>
        </div>
        <div class="dt-responsive">
            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap" style="width: 96%;">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>
                        <th>TOTAL</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td>{{ $factura->codigo }}</td>
                            <td>{{ $factura->cliente->nombre }} {{ $factura->cliente->apellido }}</td>
                            <td>{{ $factura->fecha }}</td>
                            <td>{{ $factura->total }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" title="Editar">
                                    <i class="ik ik-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="ik ik-trash-2"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal_select_v_client" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Verificación de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('facturas.crear') }}" id="form_verify_facturar">
                    <div class="modal-body">
                        @csrf
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="number"
                                            id="dni_verify"
                                            class="form-control{{ $errors->has('nro') ? ' is-invalid' : '' }}"
                                            name="dni"
                                            value="{{ old('dni') }}"
                                            placeholder="Ingrese la cédula"
                                            required
                                            autofocus>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <select name="mesa" id="mesa_verify" class="form-control">
                                        <option value="none">Seleccione una mesa</option>
                                        @foreach ($mesas as $mesa)
                                            <option value="{{$mesa->id}}">{{ $mesa->nro }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="client_verify">
                            <i class="ik ik-check-circle"></i> Facturar a Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#client_verify").click(() => {
                let dni = $("#dni_verify").val()
                let mesa = $("#mesa_verify").val()
                let url_verify = route + '/verify/client/facturar/' + dni + '/' + mesa
                
                if(dni.length == 0){
                    toastr.warning('Debe insertar una cedula en el campo!', 'Disculpe!')
                    return;
                }
                if(mesa == 'none'){
                    toastr.warning('Debe seleccionar una mesa!', 'Disculpe!')
                    return;
                }
                //console.log(mesa);
                //return;
                axios.get(url_verify).then(response => {
                    console.log(response.data)
                    if(response.data.cliente == null){
                        toastr.warning('El cliente que ha ingresado no se encuentra asignado a esa mesa', 'Disculpe!.')
                    } else if(response.data.pedidos.length == 0){
                        toastr.warning('No es posible facturar porque el cliente no ha realizado algún pedidos', 'Disculpe!.')
                    } else {
                        swal({
                            title: "Disculpe!.",
                            text: "¿Está seguro de que desea facturar los pedidos de esta mesa?",
                            icon: "warning",
                            buttons: {
                                cancel: "cancelar",
                                confirm: {
                                    text: "Continuar",
                                    value: true,
                                },
                            },
				            closeOnClickOutside: false,
				            closeOnEsc: false,
				            timer: 5000,
                        }).then(acepted => {
                            if(acepted){
                                $("#form_verify_facturar").submit()
                            }
                        })
                    }
                }).catch(error => {
                    console.log(error)
                    console.log(error.response)
                })
            })
        })
    </script>
@endpush