@extends('layouts.main')

@push('css')
    <style>
        .content-wrapper {
            width: 66%;
        }
        @media (min-width: 1200px){
            .col-xl-4 {
                max-width: 29.333333%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content" id="main">
        <div class="content-header">
            <h3 class="title">Menú</h3>
            @if(Auth::user()->role == 'admin')
            <button type="button"
                    class="btn btn-info table-custom-btn"
                    data-toggle="modal"
                    data-target="#modal_new_item"><i class="ik ik-share"></i>New Item</button>
            <button type="button"
                    class="btn btn-success table-custom-btn"
                    data-toggle="modal"
                    data-target="#modal_new_categoria"><i class="ik ik-share"></i>Categorias</button>
            @endif
        </div>
        <div class="form-group col-md-4">
                <label for=""> Categorias:</label>
                <select name="categoria" id="categoria" class="form-control" @change="pre_load_menu">
                    <option value="none">Seleccione una categoria</option>
                    @foreach ($categorias as $index => $categoria)
                        @if($index == 0)
                            <option value="{{$categoria->id}}" selected>{{ $categoria->nombre }}</option>
                        @else 
                            <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        <div class="row">
            <div class="col-xl-4 col-md-4" v-for="item in menu">
                <div class="card comp-card" {{-- onclick="open_pedido(item)" --}} @click="open_pedido(item)" style="cursor: pointer !important;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col" style="padding-right:0">
                                <h6 class="fz-17" v-text="item.nombre"></h6>
                                <h3 class="fw-700 text-blue" v-text="item.precio"></h3>
                                <p class="mb-0" v-if="item.cantidad != null" v-text="'Cant disp: '+item.cantidad"></p>
                                <p class="mb-0" v-else v-text="item.status"></p>
                            </div>
                            <div class="col-auto img-menu-item">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p v-show="menu.length == 0" class="text-center" style="width:100%">No existen items dentro del menú</p>
        </div>
        <div class="modal fade" id="modal_new_item" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="demoModalLabel">Regitrar nuevo Item para el Menú</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('menu.item.store') }}">
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
                                            <input type="text"
                                                    class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}"
                                                    name="codigo"
                                                    value="{{ old('codigo') }}"
                                                    placeholder="Código del item"
                                                    required
                                                    autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <input type="text"
                                                    class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                                    name="nombre"
                                                    value="{{ old('nombre') }}"
                                                    placeholder="Nombre"
                                                    required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="flex-wrap:nowrap">
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <input type="text"
                                                    class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}"
                                                    name="precio"
                                                    value="{{ old('precio') }}"
                                                    placeholder="Precio"
                                                    required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <input type="time"
                                                    title="Especifique el tiempo en formato HH:MM"
                                                    class="form-control{{ $errors->has('tiempo_preparacion') ? ' is-invalid' : '' }}"
                                                    name="tiempo_preparacion"
                                                    value="{{ old('tiempo_preparacion') }}"
                                                    placeholder="Tiempo de preparacion"
                                                    required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="flex-wrap:nowrap">
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="none">Seleccione un status</option>
                                                <option value="disponible" selected>Disponible</option>
                                                <option value="disponible">Agotado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <input type="number"
                                                    class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}"
                                                    name="cantidad"
                                                    value="{{ old('cantidad') }}"
                                                    placeholder="cantidad">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="flex-wrap:nowrap">
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <textarea name="descripcion" id="descripcion" cols="34" rows="2" placeholder="Descripción del item"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ajust">
                                        <div class="form-group">
                                            <select name="categoria" id="categorias" class="form-control">
                                                <option value="none">Seleccione una categoria</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Nuevo Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MODAL PARA PROCESAR PEDIDOS --}}
            <div class="modal fade" id="modal_new_pedido" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="demoModalLabel">Regitrar nuevo Pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
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
                                        <h5><span style="font-weight: 800;">@{{ item.categoria.nombre }}</span>: @{{ item.nombre }}</h5>
                                        <h5><span style="font-weight: 800;">Costo:</span> @{{ item.precio }}</h5>
                                        <p><span style="font-weight: 800;">Descripcion: </span>@{{ item.descripcion }}</p>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <input type="text"
                                                    class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}"
                                                    v-model="cantidad_item"
                                                    value="{{ old('cantidad') }}"
                                                    placeholder="cantidad"
                                                    required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" @click.prevent="save_pedido" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Pedido</button>
                            </div>
                    </div>
                </div>
            </div>
            {{-- FIN MODAL --}}

    </div>
    <div class="modal fade" id="modal_new_categoria" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="demoModalLabel">Regitrar nueva Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('menu.categoria.store') }}">
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
                                        <input type="text"
                                                class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                                name="nombre"
                                                value="{{ old('nombre') }}"
                                                placeholder="Nombre de la categoria"
                                                required
                                                autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="ik ik-user"></i> Registrar Categoria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/menus.js') }}"></script>
@endpush