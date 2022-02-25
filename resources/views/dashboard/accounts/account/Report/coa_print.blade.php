@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

    .company-txt{
        font-size: 24px;
        font-weight: bold;
    }


</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="table-rep-plugin"  id="printArea">
                            @include('includes.company-detail-header')
                        <div class="card-body">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table class="table table-striped mb-0 table-bordered dt-responsive nowrap">
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td colspan="5">Assets</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>101</td>
                                            <td colspan="4">Non Current Assets</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>10107</td>
                                            <td colspan="4">Inventory</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>10108</td>
                                            <td colspan="4">Service Receive</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>101080001</td>
                                            <td colspan="4">knitting-1</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>101080002</td>
                                            <td colspan="4">processing-2</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>102</td>
                                            <td colspan="4">Current Asset</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>10201</td>
                                            <td colspan="4">Cash & Cash Equivalent</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>1020101 </td>
                                            <td colspan="4">Cash In Hand</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>1020102 </td>
                                            <td colspan="4">Cash At Bank</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>10203</td>
                                            <td colspan="4">Account Receivable</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td> </td>
                                            <td>102030000001 </td>
                                            <td>1-Walking Customer</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>1020301 </td>
                                            <td colspan="4">Customer Receivable</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>1020302 </td>
                                            <td colspan="4">Loan Receivable</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td colspan="5">Equity</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td colspan="5">Income</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>303</td>
                                            <td colspan="4">Product Sale</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>304</td>
                                            <td colspan="4">Service Income</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td colspan="5">Expence</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>401</td>
                                            <td colspan="4">Default expense</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>403</td>
                                            <td colspan="4">Employee Salary</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td colspan="5">Liabilities</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>501</td>
                                            <td colspan="4">Non Current Liabilities</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>502</td>
                                            <td colspan="4">Current Liabilities</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>502000001 </td>
                                            <td colspan="4">1-saim</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>50202</td>
                                            <td colspan="4">Account Payable</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>50203</td>
                                            <td colspan="4">Tax</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>50204</td>
                                            <td colspan="4">Employee Ledger</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="text-center mt-5 mb-3" id="print">
                        <button type="button" class="btn btn-primary w-sm" id="printBtn">Print</button>
                    </div>

                </div><!-- container -->
                &nbsp;
                &nbsp;
                &nbsp;
               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection




