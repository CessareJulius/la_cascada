@extends('layouts.main')

@push('css')
    <style>
        
        @media (min-width: 768px){
            #alt-pg-dt{
                width: 93%;
            }
            .content-wrapper {
                width: 40%;
            }
            .col-md-6 {
                max-width: 38%;
            }
            .table-custom-btn {
                margin-top: -7.3%;
            }
            div.row > .col-md-7{
                max-width: 38.33333333%;
            }
        }
        @media (min-width: 1025px){
            #alt-pg-dt{
                width: 94%;
            }
            .content-wrapper {
                width: 35%;
            }
            .col-md-6 {
                max-width: 33.5%;
            }
            .table-custom-btn {
                margin-top: -6.3%;
            }
            div.row > .col-md-7{
                max-width: 33.33333333%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="content-header">
            <h3 class="title">Mesas</h3>
            <button type="button"
                    class="btn btn-info table-custom-btn"
                    data-toggle="modal"
                    data-target="#modal_new_mesa"><i class="ik ik-share"></i>Nueva</button>
        </div>
        <div class="dt-responsive">
            <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>NRO DE MESA</th>
                        <th>STATUS</th>
                        {{-- <th>ACCIONES</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mesas as $mesa)
                        <tr>
                            <td>{{ $mesa->nro }}</td>
                            <td>{{ $mesa->status }}</td>
                            {{-- <td>
                                <button class="btn btn-sm btn-warning">Editar</button>
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal_new_mesa" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Regitrar nueva Mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('mesas.store') }}">
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
                                    <input type="number"
                                            class="form-control{{ $errors->has('nro') ? ' is-invalid' : '' }}"
                                            name="nro"
                                            value="{{ old('nro') }}"
                                            placeholder="Nro de la mesa"
                                            required
                                            autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Mesa</button>
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