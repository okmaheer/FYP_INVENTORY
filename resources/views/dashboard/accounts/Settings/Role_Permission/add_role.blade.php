@extends('layouts.dashboard')
@section('page_title')
@section('content')
    @include('includes.dashboard-breadcrumbs')
<style>
    .form-control{
        width: 70% !important;

    }
    .form-group{
        margin-bottom: 60px;
    }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">

                    </div>

                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-success">Add Role</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <form action=""> --}}
                                        {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                        {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('name' ,'Role Name <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'First Name']) !!}

                                            </div>
                                        </div>
                                    </form>
                                    <h2>Sale</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>New Sale</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Manage Sale</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>POS Sale</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <h2>Customer</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Customer</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Customer</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Credit Customer</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Paid Customer</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Customer Ledger</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Customer Advance</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <h2>Product</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Category</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Category</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Unit</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Manage Unit</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Add Product</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Import product (CSV)</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Manage Product</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <h2>Supplier</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Supplier</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Supplier </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Supplier Ledger</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Supplier Advance</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Purchase</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Purchase</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Purchase </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Stock</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Stock Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Return</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Return</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Stock Return List </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Supplier Return List</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Wastage Return List </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>



                                    <h2>Report</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Closing</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Closing Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Todays Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Todays Customer Receipt </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Sales Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Due Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Purchase Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Purchase Report (Category wise)</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Sales Report (Product Wise) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Sales Report (Category wise) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>11</td>
                                                    <td>Shipping Cost Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>User Wise Sales Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Sales Return </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>Supplier Return </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Tax Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Profit Report (Sale Wise) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Accounts</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Chart of Account</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Supplier Payment</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Customer Receive</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Opening Balance </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Debit Voucher </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Credit Voucher </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Vouchar Approval</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Contra Voucher</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Journal Voucher </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>11</td>
                                                    <td>Cash Book</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Inventory Ledger </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Bank Book </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>General Ledger</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Trial Balance </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Cash Flow </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>17</td>
                                                    <td>Coa Print </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Bank</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add New Bank</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Bank</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>	Bank Transaction</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Bank Ledger </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Tax</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Tax Settings</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Add Income Tax</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Manage Income Tax</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Tax Report </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>4</td>
                                                    <td>Invoice Wise Tax Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Human Resource</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Designation</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Designation</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Add Employee</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Manage Employee </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Attendance</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Manage Attendance </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Attendance Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Add Benefits</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Manage Benefits</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Add Salary Setup</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>11</td>
                                                    <td>Manage Salary Setup</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Salary Generate </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Manage Salary Generate</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>Salary Payment</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Add Expense Item </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Manage Expense Item </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>17</td>
                                                    <td>Add Expense </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>19</td>
                                                    <td>Expense Statement</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>20</td>
                                                    <td>Add Person (Office Loan) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Add Loan (Office Loan) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>22</td>
                                                    <td>Add Payment (Office Loan)</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>23</td>
                                                    <td>Manage Loan (Office Loan)</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>24</td>
                                                    <td>Add Person (Personal Loan) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>25</td>
                                                    <td>Add Loan (Personal Loan) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>26</td>
                                                    <td>Add Payment (Personal Loan)</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>27</td>
                                                    <td>Manage Loan (Personal) </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Service</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Service</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Service</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Service Invoice</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Manage Service Invoice</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>4</td>
                                                    <td>Invoice Wise Tax Report</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Commission</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Generate Commssion</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Setting</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Manage Company</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Add User</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Manage Users </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Language </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Currency</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Setting </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Print Setting</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Mail Setting</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Add Role</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Role List</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>

                                                <tr>
                                                    <td>11</td>
                                                    <td>User Assign Role</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Permission </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>SMS Configure</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>Backup</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Import </td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Restore</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <h2>Quotation</h2>
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Menu Name</th>
                                                    <th>Create (<input type="checkbox" name="" id=""> All)</th>
                                                    <th>Read ( <input type="checkbox" name="" id=""> all)</th>
                                                    <th>Update (<input type="checkbox" name="" id=""> all)</th>
                                                    <th>Delete (<input type="checkbox" name="" id=""> all)</th>


                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Add Quotation</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Manage Quotation</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Add To Invoice</td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                    <td class="text-center"><input type="checkbox" name="" id=""></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary w-md m-b-5" >Reset</button>
                                        <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                                    </div>
                                </div>
                            </div>

                </div><!-- container -->
               &nbsp;
               &nbsp;
               &nbsp;
               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection
