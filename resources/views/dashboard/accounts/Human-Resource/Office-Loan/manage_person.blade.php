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
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Person
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Loan
                            </a>
                            <a href="#" class="btn btn-success m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Payemnet
                            </a>

                        </div>
                    </div>

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title">
                                    <span class="p-3">

                                        <div class="penal-tilte  border-grey border-bottom">
                                            <h4 class="p-3 text-dark">{{__('accounts.office.manage')}}</h4>
                                            </div>
                                    </span>


                                </div>
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" >
                                        <thead>
                                                <tr>
                                                    <th>{{__('accounts.office.name')}}</th>
                                                    <th>{{__('accounts.office.address')}}</th>
                                                    <th>{{__('accounts.office.phone')}}</th>
                                                    <th class="text-right">{{__('accounts.office.balance')}}</th>
                                                    <th>{{__('accounts.office.action')}}</th>
                                                </tr>


                                        </thead>
                                        <tbody>
                                            @php $i = 0; @endphp
                                            @forelse($person as $data)
                                                @php $i++; @endphp
                                                <tr>
                                                    <td class="text-center">{{$i}}</td>
                                                    <td class="text-center">{{$data->person_name}}</td>
                                                    <td class="text-center">{{$data->person_phone}}</td>
                                                    <td class="text-center">{{$data->person_address}}</td>

                                                    <td class="text-center">
                                                        <form action="{{ route('dashboard.accounts.person.destroy', $data->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('dashboard.accounts.person.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-right" colspan="3" align="right">no data found</td>
                                                </tr>
                                            @endforelse

                                            <tr>
                                                <td colspan="3" class="text-center">Total</td>
                                                <td class="text-right">$0.00</td>
                                                <td></td>
                                            </tr>
                                            </tbody>



                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
        @endsection

