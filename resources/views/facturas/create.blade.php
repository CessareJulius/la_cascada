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
                        <p class="lead">Amount Due 10/11/2018</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>$250.30</td>
                                </tr>
                                <tr>
                                    <th>Tax (9.3%)</th>
                                    <td>$10.34</td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <td>$5.80</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                            </tbody></table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection