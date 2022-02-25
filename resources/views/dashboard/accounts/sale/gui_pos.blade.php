@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
#myModalLabel{
    margin-left: 44%;
  }
  .modal-dialog {
      margin-left: 32%;
  }
  .product_field{
      width: 220px;
  }

</style>
@section('body')
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                                <div class="col-lg-2">
                                    <div><button class="btn btn-success btn-block">All</button></div>&nbsp;
                                    <div><button class="btn btn-success btn-block">Demo Category</button></div>&nbsp;
                                    <div><button class="btn btn-success btn-block">Drinks</button></div>
                                </div>
                                <div class="col-lg-5">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                            <button type="button" class="btn btn-white bg-white"><i class="fas fa-search"></i></button>
                                                        </span>
                                                    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <select class="select2 form-control mb-3 custom-select float-right" >
                                                        <option>Select option</option>
                                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                                            <option value="AK">Active</option>
                                                            <option value="HI">Inactive</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="card-group">

                                                <div class="card" >
                                                    <img class="card-img-top img-fluid w-75" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/1c2041394549a03ff9889a8a2e2e2963.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title">American </h4>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/4d9298c4e0dc822e4f63d04386303837.jpg" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title mt-0">Cappy</h4>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/0e0a90c1533e97b581a4521744570af8.png" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title mt-0">Cappy </h4>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/1d1c30ba346ec497908930dd4521ac5e.png" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title mt-0">Coca</h4>
                                                    </div>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/4f8655e83b6863fe019d2ca9b3b5fb5f.png" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h4 class="card-title mt-0">Coke</h4>
                                                    </div>
                                                </div>

                                                <!--end card-->

                                            </div>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <div class="card-group">

                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/1c2041394549a03ff9889a8a2e2e2963.jpg" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h4 class="card-title mt-0">American</h4>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;
                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/4d9298c4e0dc822e4f63d04386303837.jpg" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h4 class="card-title mt-0">Cappy</h4>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;
                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/0e0a90c1533e97b581a4521744570af8.png" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h4 class="card-title mt-0">Cappy</h4>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;
                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/1d1c30ba346ec497908930dd4521ac5e.png" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h4 class="card-title mt-0">Coca</h4>
                                                            </div>
                                                        </div>
                                                        &nbsp;&nbsp;
                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="http://acc.theoptimumtech.com/my-assets/image/product/2021-04-06/4f8655e83b6863fe019d2ca9b3b5fb5f.png" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h4 class="card-title mt-0">Coke</h4>
                                                            </div>
                                                        </div>

                                                        <!--end card-->

                                                    </div>
                                                    <!--end card-group-->

                                        </div><!--end col-->
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <form action="">

                                         <div class="form-group row">
                                                <div class="col-md-4">
                                                    <div class="input-group mb-2 mb-md-0">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div col-lg-4></div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
                                                            <span class="input-group-append">
                                                                   {{-- Modal Popup --}}
                                                                   <form>
                                                                    <div class=" text-center">
                                                                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-xl"> <i class="ti-plus m-r-2"></i></button>
                                                                    </div>
                                                                    <!-- sample modal content -->
                                                                    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl ">
                                                                            <div class="modal-content w-50 " >
                                                                                <div class="modal-header bg-success">
                                                                                    <h5 class="modal-title mt-0 text-light" id="myModalLabel">Add New Customer</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="general-label">

                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-4">
                                                                                                <label for="horizontalInput1" class=" col-form-label">Customer Name</label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" id="horizontalInput1" placeholder="Customer Name">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-4">
                                                                                                <label for="horizontalInput1" class="col-form-label">Customer Email</label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="email" class="form-control" id="horizontalInput1" placeholder="Customer Name">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-4">
                                                                                                <label for="horizontalInput1" class="col-form-label">Customer Mobile</label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="number" class="form-control" id="horizontalInput1" placeholder="Customer Name">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-4">
                                                                                                <label for="horizontalInput1" class="col-form-label">Customer Address</label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" class="form-control" id="horizontalInput1" placeholder="Customer Name">
                                                                                                </div>
                                                                                            </div>



                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-success waves-effect waves-light">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->

                                                                        <div class="fixedclasspos">
                                                                            <div class="bottomarea">
                                                                                <div class="row">

                                                                                    <div class="col-lg-8 col-xl-8">
                                                                                        <div class="calculation d-lg-flex">
                                                                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                                                                <label for="" class="cal-label mr-2 mb-0">Net Total:</label>
                                                                                                <span class="amount" id="net_total_text">0.00</span>
                                                                                                <input type="hidden" class="form-control text-right guifooterfixedinput" value="0.00" name="" id="" readonly>
                                                                                            </div>

                                                                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                                                                <div class="form-inline d-inline-flex align-items-center">
                                                                                                    <label for="" class="cal-label mr-2 mb-0">Paid Amount:</label>
                                                                                                    <span class="amount" id="net_total_text">0.00</span>
                                                                                                    <input type="hidden" class="form-control text-right guifooterfixedinput" value="0.00" name="" id="" readonly>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="cal-box d-lg-flex align-items-lg-center mr-4">
                                                                                                <label for="" class="cal-label mr-2 mb-0">Due:</label>
                                                                                                <span class="amount" id="net_total_text">0.00</span>
                                                                                                <input type="hidden" class="form-control text-right guifooterfixedinput" value="0.00" name="" id="" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                            </form>
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mt-2">
                                                       <label class="mr-2 ">Invoice No - </label>
                                                       <div class="invoice-no" id="gui_invoice_no" >1012</div>
                                                       <input type="hidden" class="form-control" name="invoice_no" id="invoice_no" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="table-rep-plugin">
                                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                        <table id="addinvoice" class="table table-bordered table-hover table-sm nowrap gui-products-table">
                                                            <thead>

                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center gui_productname">Item Information <i class="text-danger">*</i></th>
                                                                    <th class="text-center">Serial</th>
                                                                    <th class="text-center">Av. Qnty.</th>
                                                                    <th class="text-center">Qnty  <i class="text-danger">*</i></th>
                                                                    <th class="text-center">Rate <i class="text-danger">*</i></th>
                                                                    <th class="text-center">Dis %   </th>
                                                                    <th class="text-center">Total	</th>
                                                                    <th class="text-center">Action</th>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-5"> </div>

                                                <div class="col-lg-7">
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput1" class=" col-form-label">Sale Discount:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput1" placeholder="0.00">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Total Discount:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Total Tax:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Shipping Cost:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Grand Total:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Previous:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-2">
                                                        <div class="col-sm-6">
                                                        <label for="horizontalInput2" class=" col-form-label">Change:</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control w-100" id="horizontalInput2" placeholder="0.00">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>



                                    </form>


                                </div>




                        </div>

                        </div><!-- container -->

                       {{-- @include('includes.dashboard-footer') --}}
                    </div>

        @endsection
        @endsection
