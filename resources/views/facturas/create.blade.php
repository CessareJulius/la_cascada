@extends('layouts.main')

@push('css')
    <style>
        @media (min-width: 1025px){
            .content-wrapper {
                width: 68%;
            }
            .invoice-col{
                max-width: 29.33333333%
            }
        }
    </style>
@endpush

@section('content')
<form action="{{ route('facturas.store') }}" method="POST">
    @csrf
    <div class="main-content">
        <div class="card" style="margin-bottom:0;">
            <div class="card-header">
                <h5 class="d-block w-100">Factura por Consumo
                    <small class="float-right">Fecha: {{ date('d-m-Y') }}</small>
                </h5>
            </div>
            <div class="card-body">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        De:
                        <address>
                            <strong>La Cascada,</strong><br>#5 Bolivar Ave, Edif #54 <br>San Juan de Los Morros, Guarico <br>Telefono: (424) 123-4567<br>Email: info@lacascada.com
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        Para:
                        <address>
                            <input type="hidden" name="dni" value="{{ $dni }}">
                            <input type="hidden" name="mesa" value="{{ $mesa }}">
                            <strong>{{ $cliente->nombre }} {{ $cliente->apellido }}</strong>
                            <br>
                            @if($cliente->direccion != null){{ $cliente->direccion }}<br>@endif
                            @if($cliente->telefono != null)Telefono: {{ $cliente->telefono }}<br>@endif
                            Email: {{ $cliente->user->email }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Factura #0{{ $factura_id }}</b><br>
                        <br>
                        <b>Nro Orden:</b> {{ $invoice_code }}
                        <input type="hidden" name="codigo" value="{{ $invoice_code }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cant</th>
                                    <th>Nro Orden</th>
                                    <th>Producto</th>
                                    <th>Codigo #</th>
                                    <th>Descripcion</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->cantidad }}</td>
                                        <td>{{ $pedido->nro_orden }}</td>
                                        <td>{{ $pedido->menu->nombre }}</td>
                                        <td>{{ $pedido->menu->codigo }}</td>
                                        <td>{{ $pedido->menu->descripcion}}</td>
                                        <td>{{ $pedido->cantidad * intval($pedido->menu->precio) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="lead">Cuenta a pagar:</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    @php
                                        $sub = 0;
                                        foreach ($pedidos as $pedido):
                                            $sub += $pedido->cantidad * intval($pedido->menu->precio);
                                        endforeach;
                                    @endphp
                                    <td>${{ $sub }}</td>
                                    <input type="hidden" name="subtotal" value="{{ $sub }}">
                                </tr>
                                <tr>
                                    <th>Iva ({{ $conf->iva }}%)</th>
                                    <td>${{ $sum_iva = ($sub * $conf->iva)/100 }}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>${{ $total = $sub + $sum_iva }}</td>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                </tr>
                            </tbody></table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success pull-right">
                            <i class="fa fa-credit-card"></i> Pagar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection