@extends('layout.master')

@section('header')
<h1>Bills Table</h1>
@endsection

{{-- Main Content --}}
@section('content')

<!-- Add Company -->
<div class="modal fade" id="AddCompanyModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Company</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <form method='POST' action='{{ route('company.store') }}'>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
    
                        <div class="form-group row">
                            <label name="companyName" class="col-lg-4 col-form-label">Company Name</label>
                            <div class="col-lg-7">
                                <input name="companyName"  value='{{ old('companyName') }}' type="text" class="form-control input-sm companyName_input" />
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label name="companyAddress" class="col-lg-4 col-form-label">Company Address</label>
                            <div class="col-lg-7">
                                <textarea class="form-control" rows="3" name='companyAddress'></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Company -->

<!-- Add Bill Modal -->
<div class="modal fade" id="AddBillModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Bill</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <form method='POST' action='{{ route('bill.store') }}'>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group row">
                        <label name="billDate" class="col-lg-4 col-form-label">Bill Date</label>
                        <div class="col-lg-7">
                            <input name="billDate"  value='{{ old('billDate') }}' type="date" class="form-control input-sm billDate_input" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="companyName" class="col-lg-4 col-form-label">Company Name</label>
                        <div class="col-lg-7">
                            <select name="companyName" class="form-control input-sm companyName_input">
                                @foreach($companies as $company)
                                    <option value='{{ $company->id }}'>{{ $company->companyName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="billAmount" class="col-lg-4 col-form-label">Amount</label>
                        <div class="col-lg-7">
                            <input name="billAmount"  value='{{ old('billAmount') }}' type="number" class="form-control input-sm billAmount_input" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="billFee" class="col-lg-4 col-form-label">Fee (%)</label>
                        <div class="col-lg-4">
                            <input name="billFee"  value='{{ old('billFee') }}' type="number" class="form-control input-sm billFee_input" />
                        </div>
                        <div class='col-lg-1'>
                            <label style='margin-top:8px;' name="billFee" class="form-label"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Bill</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Bill Modal -->

<!-- Edit Bill Modal -->
<div class="modal fade" id="EditBill" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Bill</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method='POST' action='{{ route('bill.update', 'data') }}'>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <input style='display: none;' type='text' name='billID' id='billID' />

                    <div class="form-group row">
                        <label name="billDate" class="col-lg-4 col-form-label">Bill Date</label>
                        <div class="col-lg-7">
                            <input id='billDate' name="billDate"  value='{{ old('billDate') }}' type="date" class="form-control input-sm billDate_input" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="companyName" class="col-lg-4 col-form-label">Company Name</label>
                        <div class="col-lg-7">
                            <select name="companyName" class="form-control input-sm companyName_input">
                                @foreach($companies as $company)
                                    <option value='{{ $company->id }}'>{{ $company->companyName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="billNo" class="col-lg-4 col-form-label">Bill No.</label>
                        <div class="col-lg-7">
                            <input id='billNo' name="billNo" type="text" class="form-control input-sm billNo_input" disabled/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label name="billAmount" class="col-lg-4 col-form-label">Amount</label>
                        <div class="col-lg-4">
                            <input id="billAmount"  name="billAmount"  value='{{ old('billAmount') }}' type="text" class="form-control input-sm billAmount_input" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Edit Bill</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
<!-- Edit Bill Modal -->

<!-- Validation Messages -->
@if(session()->has('successMsg'))
    <div class="alert alert-success" id='successMsg'>
        {{ session()->get('successMsg') }}
    </div>
@elseif(count($errors) > 0)
    <div class="alert alert-danger" id='alertMsg'>
        Some fields are filled out incorrectly or missing data.
    </div>    
@endif
<!-- Validation Messages -->

<!-- Bill Datatable -->
<table id="data" class="table table-striped table-bordered" style="width:100%">
    <div class="form-group row">
        <div class="col-lg-4">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddBillModal">Add Bill</button>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddCompanyModal">Add Company</button>
        </div>
    </div> 
    <thead>
        <tr>
            <th>Actions</th>
            <th>Payment Date</th>
            <th>Company Name</th>
            <th>Bill No.</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companyBills as $companyBill)
        <tr>
            <td>
                <a href='#' data-bill_no='{{ $companyBill->id }}' data-bill_amount='{{ $companyBill->billAmount }}' data-date='{{ $companyBill->billDate }}' data-company_id='{{ $companyBill->companyID }}' data-toggle="modal" data-target="#EditBill" class='fa fa-edit'></a href='#'>
                <form id='bill-delete-form' action="{{ route('bill.destroy', 'data') }}" onclick="return confirm('Are you sure you want to delete?')" method='post' >
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <input type='text' style='display: none;' name='billID' value='{{ $companyBill->id }}' />
                    <button id='bill-delete' class='fas fa-window-close' data-toggle="tooltip" title="Delete Employee"></button></td>
                </form>
            </td>
            <td>{{ $companyBill->billDate }}</td>
            <td>{{ $companyBill->companyName }}</td>
            <td>{{ $companyBill->id }}</td>
            <td>{{ number_format($companyBill->billAmount, 2) }} €</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Actions</th>
            <th>Payment Date</th>
            <th>Customer No.</th>
            <th>Bill No.</th>
            <th>Amount</th>
        </tr>
    </tfoot>
</table>
<!-- Bill Datatable -->
@endsection
{{-- Main Content --}}