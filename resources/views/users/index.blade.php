@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="content-header">
            <h3 class="title">Usuarios</h3>
            <button type="button" class="btn btn-info table-custom-btn"
                    data-toggle="modal" data-target="#modal_new_user"><i class="ik ik-share"></i>Nuevo</button>
        </div>
        <div class="dt-responsive">
            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap" style="width: 96%;">
                <thead>
                    <tr>
                        <th>EMAIL</th>
                        <th>TIPO</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->role }}
                            </td>
                            @isset($user->cliente)
                            <td>{{ $user->cliente->nombre }}</td>
                            <td>{{ $user->cliente->apellido }}</td>
                            @else
                            <td></td>
                            <td></td>
                            @endisset
                            
                            <td>
                                <button class="btn btn-sm btn-warning">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- email, password, dni, nombre, apellido, telefono, direccion --}}

    <div class="modal fade" id="modal_new_user" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Regitrar nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('users.store') }}">
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
                                    <select name="role" id="roles" class="form-control">
                                        <option value="none">Seleccione un role</option>
                                        <option value="cliente">Cliente</option>
                                        <option value="cajero">Cajero</option>
                                    </select>
                                </div>
                            </div>
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
                        </div>
                        <div class="row" style="flex-wrap:nowrap">
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
                            <div class="col-md-6 ajust">
                                <div class="form-group">
                                    <input type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                            value="{{ old('password-confirm') }}"
                                            placeholder="Confirmar Contraseña"
                                            required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#mesas").select();
        })
        setTimeout(() => {
            $("#alt-pg-dt_length").children('label')[0].firstChild.nodeValue = "Mostrar "
            $("#alt-pg-dt_length").children('label')[0].lastChild.nodeValue = " registros"
            $("#alt-pg-dt_filter").children('label')[0].firstChild.nodeValue = "Buscar:"
        }, 1000);
    </script>
@endpush