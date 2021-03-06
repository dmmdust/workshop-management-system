@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Edit Estimate</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('estimates')}}" type="button" class="page-header btn btn-primary">All Estimates</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Estimate Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->any())
                        <div class="form-group">
                            <div class="col-sm-12 alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {!! Form::model($estimate, ['action' => ['EstimatesController@update', $estimate->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'estimateEditForm', 'class'=>'form-horizontal']) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('customer', 'Customer', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                    {!! Form::select('customer_id', ['' => 'Select a customer'] + $customer_list ,null , array('class' => 'form-control', 'id' => 'customer', 'required')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('vehicle', 'Vehicle', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                    {!! Form::select('vehicle_id', ['' => 'Select a vehicle'] + $vehicles, null , array('class' => 'form-control', 'id' => 'vehicle')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mileage_in', 'Mileage In', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::text('mileage_in', null, ['class' => 'form-control', 'placeholder' => 'Mileage In']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('department', 'Department', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('department', $departments, null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-6">

                                <div class="form-group">
                                    {!! Form::label('sales_rep', 'Sales Rep', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('sales_rep', ['' => 'Select a sales rep'] + $sales_rep, null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('estimate_type', 'Estimate Type', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('estimate_type', $est_type, null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('insurance', 'Insurance', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-9">
                                        {!! Form::select('insurance_company', ['' => 'Select a vehicle'] + $insurance_company, null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row add-estimate-item-section">
                            <div class="col-lg-12" id="estmate-items-wrapper">
                                <table class="table table-bordered" id="dynamic-tbl">
                                    <thead>
                                    <th class="item-select">Item</th>
                                    <th class="item-desc">Description</th>
                                    <th class="item-qty">Number</th>
                                    <th class="item-rate">Rate</th>
                                    <th class="item-amount">Amount</th>
                                    <th class="item-approved-amount">Approved Amount</th>
                                    <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    @foreach($estimate_details as $detail)
                                    <tr id="1">
                                        <td>
                                            {!! Form::select('item_id[]', ['' => 'Select an item'] + $items, $detail->item_id, array('class' => 'form-control itemId estimateEditItem', 'id' => 'itemId', 'required')) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('item_description[]', $detail->item_description, ['class' => 'form-control item_description', 'id' => 'item_description', 'placeholder' => 'Not Required | Optional']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('units[]', $detail->units, ['class' => 'form-control', 'placeholder' => 'Add Number', 'id' => 'units', 'required']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('rate[]', $detail->rate, ['class' => 'form-control', 'placeholder' => 'Add Rate', 'id' => 'rate', 'required']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('amount[]', $detail->initial_amount, ['class' => 'form-control amount', 'id' => 'amount', 'placeholder' => 'Add Hrs and Rate']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('approved_amount[]', $detail->approved_amount, ['class' => 'form-control approved_amount', 'id' => 'approved_amount', 'placeholder' => 'Approved Amount']) !!}
                                        </td>
                                        <td class="text-center actions"><a id="delete-row" href="#"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary" type="button" class="addRow" id="addEditEstimateRow">Add row</button>
                            </div>
                            <div class="col-lg-3">
                                {!! Form::submit('Save Estimate', ['class' => 'btn btn-success']) !!}
                            </div>
                            <div class="col-lg-1 text-right">
                                <p class="estimate-total"><strong>Total: </strong></p>
                            </div>
                            <div class="col-lg-2">
                                {!! Form::text('net_amount', null, ['class' => 'form-control text-right total', 'id' => 'total', 'readonly']) !!}
                            </div>
                            <div class="col-lg-1">
                            </div>
                            <div class="col-lg-2">
                            </div>

                        </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


@endsection