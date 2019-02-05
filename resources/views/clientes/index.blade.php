@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="content-header">
            <h3 class="title">Clientes</h3>
            <button type="button" class="btn btn-info table-custom-btn" data-toggle="modal" data-target="#modal_validate_client">
                <i class="ik ik-share"></i>Nuevo
            </button>
        </div>
        <div class="dt-responsive">
            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap" style="width: 96%;">
                <thead>
                    <tr>
                        <th>CEDULA</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>TELEFONO</th>
                        <th>MESA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->dni }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>
                                @foreach ($cliente->mesas as $mesa)
                                {{ $mesa->nro }}
                                @endforeach
                            </td>
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

    <div class="modal fade" id="modal_validate_client" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Verificación de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('assoc.client') }}">
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
                                <button type="button" class="btn btn-success" id="client_verify">
                                    <i class="ik ik-check-circle"></i> Verificar
                                </button>
                            </div>
                        </div>
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="client_fullname" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <select name="mesa" id="mesas_verify" class="form-control">
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
                        <button type="submit" class="btn btn-primary" id="btn_register_cl" disabled>
                            <i class="ik ik-user-check"></i> Agregar Cliente a la mesa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_new_client" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Regitrar nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('clientes.store') }}">
                    <div class="modal-body">
                        @csrf
                        @if ($errors->any())
                            <div class="errors">
                                <ul style="margin-bottom:0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Correo Electrónico"
                                            required
                                            autofocus>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password"
                                            value="{{ old('password') }}"
                                            placeholder="Contraseña"
                                            required>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="number"
                                            id="dni_non_verify"
                                            class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}"
                                            name="dni"
                                            value="{{ old('dni') }}"
                                            placeholder="Cédula"
                                            required>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="text"
                                            class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                            name="nombre"
                                            value="{{ old('nombre') }}"
                                            placeholder="Nombres"
                                            required>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="text"
                                            class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}"
                                            name="apellido"
                                            value="{{ old('apellido') }}"
                                            placeholder="Apellidos"
                                            required>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="number"
                                            class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                            name="telefono"
                                            value="{{ old('telefono') }}"
                                            placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="flex-wrap:nowrap">
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <textarea name="direccion" id="direccion" cols="34" rows="2" placeholder="&nbsp;Dirección"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <select name="mesa" id="mesas" class="form-control">
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
                        <button type="submit" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#mesas").select()
            $("#dni_verify").on('keyup', () => {
                $("#btn_register_cl").attr('disabled', true)
            })
            $("#client_verify").click(() => {
                let dni_verify = $("#dni_verify").val()
                if(dni_verify.length > 0){
                    let url_verify = route + '/clients/verify/' + dni_verify 
                    axios.get(url_verify).then(response => {
                        console.log(response.data)
                        let cliente = response.data.cliente
                        if(cliente != null){
                            toastr.info('Cliente encontrado!.')
                            $("#client_fullname").val(cliente.nombre + ' ' + cliente.apellido)
                            $("#btn_register_cl").removeAttr('disabled')
                        } else {
                            $("#dni_non_verify").val(dni_verify)
                            toastr.warning('El cliente no se encuentra registrado!', 'Disculpe!')
                            $("#modal_validate_client").modal('hide')
                            $("#modal_new_client").modal('show')
                        }
                    }).catch(error => {
                        console.log(error)
                        console.log(error.response)
                    })
                } else {
                    toastr.warning('Debe ingresar un nro de cedula', 'Disculpe!.')
                }
            })
        })
        setTimeout(() => {
            $("#alt-pg-dt_length").children('label')[0].firstChild.nodeValue = "Mostrar "
            $("#alt-pg-dt_length").children('label')[0].lastChild.nodeValue = " registros"
            $("#alt-pg-dt_filter").children('label')[0].firstChild.nodeValue = "Buscar:"
        }, 1000);
    </script>
@endpush