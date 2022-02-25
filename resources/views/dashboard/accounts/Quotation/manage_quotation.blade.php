@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-dark">Manage Category</h4>
                                </div>
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Customer Name</th>
                                                    <th>Quotation No</th>
                                                    <th>Address</th>
                                                    <th>Quotation Date</th>
                                                    <th>Mobile</th>
                                                    <th>Expiry Date</th>
                                                    <th>Details</th>
                                                    <th>Product Name</th>
                                                    <th>Desc</th>
                                                    <th>Available Quantity</th>
                                                    <th>Product Quantity</th>
                                                    <th>Product Rate</th>
                                                    <th>Discount</th>
                                                    <th>Total Price</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>

                                            </thead>

                                            <tbody>
                                                @php $i = 0; @endphp
                                                @forelse($quotation as $data)
                                                    @php $i++; @endphp
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$data->customer_id}}</td>
                                                        <td>{{$data->quotation_no}}</td>
                                                        <td>{{$data->address}}</td>
                                                        <td>{{$data->qdate}}</td>
                                                        <td>{{$data->mobile}}</td>
                                                        <td>{{$data->expiry_date}}</td>
                                                        <td>{{$data->details}}</td>
                                                        <td>{{$data->product_name}}</td>
                                                        <td>{{$data->desc}}</td>
                                                        <td>{{$data->available_quantity}}</td>
                                                        <td>{{$data->product_quantity}}</td>
                                                        <td>{{$data->product_rate}}</td>
                                                        <td>{{$data->discount}}</td>
                                                        <td>{{$data->total_price}}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('dashboard.accounts.quotation.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{ route('dashboard.accounts.quotation.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-right" colspan="3" align="right">no data found</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>

                                        </table>
                                        <!--end /table-->
                                    </div>
                                    <!--end /tableresponsive-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>

                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

