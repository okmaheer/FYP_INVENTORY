@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="toolbar hidden-print">
                                <div class="text-end">
                                    <button type="button" class="btn btn-info" id="printBtn"><i
                                            class="fa fa-print"></i> Print</button>
                                    @if ($data->has('cancelRoute'))
                                    <a href="{{ route($data->get('cancelRoute')) }}" class="btn btn-danger"><i
                                            class="fa fa-file-pdf-o"></i>Cancel</a>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div id="printArea" style="background-color: #fff !important;">
                            <div class="card-body" style="background-color: #fff !important;">
                                @include('includes.company-detail-header')
                                <div id="invoice">
                                    <main>
                                        <div class="row contacts" style="padding: 15px">
                                            <div class="col invoice-to">
                                                <div class="text-gray-light"></div>
                                                <h2 class="to">
                                                    {{ $data->get('partyName') }}</h2>
                                                <div class="address"></div>
                                                <div class="email">
                                                </div>
                                            </div>
                                            <div class="col invoice-details" style="text-align: right">
                                                <h1 class="invoice-id" style="margin-top: 0;
                                                    color: #0d6efd;">{{ $data->get('VNo') }}</h1>
                                                <div class="date">Date: {{ $data->get('VDate') }}</div>
                                            </div>
                                        </div>
                                        @if ($data->has('CR'))
                                            <table width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                        <th class="text-left" width="70%"
                                                            style="padding: 15px; background: #eee;">REMARKS</th>
                                                        <th class="text-right" width="20%"
                                                            style="padding: 15px; background: #eee;">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%"
                                                            style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            01</td>
                                                        <td class="text-left" width="70%"
                                                            style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $data->get('transactions')->Narration }}</td>
                                                        <td class="total" width="20%"
                                                            style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Credit ) }}</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                        <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                        <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('PM'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%"
                                                        style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%"
                                                        style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01</td>
                                                    <td class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}</td>
                                                    <td class="total" width="20%"
                                                        style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>DR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Debit ) }}</td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Paid By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('JV'))
                                            <table width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                        <th class="text-left" width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                        <th class="text-right" width="20%" style="padding: 15px; background: #eee;">DEBIT</th>
                                                        <th class="text-right" width="20%" style="padding: 15px; background: #eee;">CREDIT</th>
                                                        <th class="text-left" width="30%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->get('transactions') as $key => $transaction)
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            0{{ $key+1 }}
                                                        </td>
                                                        <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->accountHead->HeadName }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #ddd;">
                                                            <small>DR </small>{{ \AccountHelper::number_format( $transaction->Debit ) }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #eee;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $transaction->Credit ) }}
                                                        </td>
                                                        <td class="text-left" width="30%" style="padding: 15px; background: #0d6efd; color: #fff; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->Narration }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')[0]->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Opening'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-left" width="50%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01
                                                    </td>
                                                    <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->accountHead->HeadName }}
                                                    </td>
                                                    <td class="text-left" width="50%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}
                                                    </td>
                                                    <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>DR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Debit ) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('AD'))
                                            <table width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                        <th width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                        <th class="text-left" width="50%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                        <th class="text-right" width="20%" style="padding: 15px; background: #eee;">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            01
                                                        </td>
                                                        <td class="no" width="20%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            {{ $data->get('transactions')->accountHead->HeadName }}
                                                        </td>
                                                        <td class="text-left" width="50%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $data->get('transactions')->Narration }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            @if ($data->get('transactions')->Credit > 0)
                                                                <small>CR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Credit ) }}
                                                            @else
                                                                <small>DR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Debit ) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                        <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                        <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('DV'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">DEBIT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">CREDIT</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->get('transactions') as $key => $transaction)
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            0{{ $key+1 }}
                                                        </td>
                                                        <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->accountHead->HeadName }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #ddd;">
                                                            <small>DR </small>{{ \AccountHelper::number_format( $transaction->Debit ) }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #eee;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $transaction->Credit ) }}
                                                        </td>
                                                        <td class="text-left" width="30%" style="padding: 15px; background: #0d6efd; color: #fff; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->Narration }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')[0]->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('CV'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">DEBIT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">CREDIT</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->get('transactions') as $key => $transaction)
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            0{{ $key+1 }}
                                                        </td>
                                                        <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->accountHead->HeadName }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #ddd;">
                                                            <small>DR </small>{{ \AccountHelper::number_format( $transaction->Debit ) }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #eee;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $transaction->Credit ) }}
                                                        </td>
                                                        <td class="text-left" width="30%" style="padding: 15px; background: #0d6efd; color: #fff; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->Narration }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')[0]->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Contra'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">DEBIT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">CREDIT</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->get('transactions') as $key => $transaction)
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            0{{ $key+1 }}
                                                        </td>
                                                        <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->accountHead->HeadName }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #ddd;">
                                                            <small>DR </small>{{ \AccountHelper::number_format( $transaction->Debit ) }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #eee;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $transaction->Credit ) }}
                                                        </td>
                                                        <td class="text-left" width="30%" style="padding: 15px; background: #0d6efd; color: #fff; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->Narration }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')[0]->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Expense'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-left" width="40%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01
                                                    </td>
                                                    <td class="text-left" width="30%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->expense->accountHead->HeadName }}
                                                    </td>
                                                    <td class="text-left" width="40%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}
                                                    </td>
                                                    <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>DR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Debit ) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Loan'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-left" width="40%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01
                                                    </td>
                                                    <td class="text-left" width="30%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->accountHead->HeadName }}
                                                    </td>
                                                    <td class="text-left" width="40%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}
                                                    </td>
                                                    <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>CR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Credit ) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('LoanPay'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-left" width="40%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01
                                                    </td>
                                                    <td class="text-left" width="30%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->accountHead->HeadName }}
                                                    </td>
                                                    <td class="text-left" width="40%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}
                                                    </td>
                                                    <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>DR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Debit ) }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Paid By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Other'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="20%" style="padding: 15px; background: #eee;">ACCOUNT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">DEBIT</th>
                                                    <th class="text-right" width="20%" style="padding: 15px; background: #eee;">CREDIT</th>
                                                    <th class="text-left" width="30%" style="padding: 15px; background: #eee;">REMARKS</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data->get('transactions') as $key => $transaction)
                                                    <tr style="border-top: white 1px solid">
                                                        <td class="no" width="10%" style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            {{ $key < 10 ? ('0' . ($key+1)) : $key }}
                                                        </td>
                                                        <td class="text-left" width="20%" style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->accountHead->HeadName }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #ddd;">
                                                            <small>DR </small>{{ \AccountHelper::number_format( $transaction->Debit ) }}
                                                        </td>
                                                        <td class="total" width="20%" style="padding: 15px; text-align: right; font-size: 1.2em; background: #eee;">
                                                            <small>CR </small>{{ \AccountHelper::number_format( $transaction->Credit ) }}
                                                        </td>
                                                        <td class="text-left" width="30%" style="padding: 15px; background: #0d6efd; color: #fff; text-align: right; font-size: 1.2em">
                                                            {{ $transaction->Narration }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">User:</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')[0]->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Booking'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%"
                                                        style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%"
                                                        style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01</td>
                                                    <td class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}</td>
                                                    <td class="total" width="20%"
                                                        style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>CR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Credit ) }}</td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                        @if ($data->has('Stage'))
                                            <table width="100%">
                                                <thead>
                                                <tr>
                                                    <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                    <th class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee;">REMARKS</th>
                                                    <th class="text-right" width="20%"
                                                        style="padding: 15px; background: #eee;">AMOUNT</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr style="border-top: white 1px solid">
                                                    <td class="no" width="10%"
                                                        style="padding: 15px; text-align: center; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        01</td>
                                                    <td class="text-left" width="70%"
                                                        style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                        {{ $data->get('transactions')->Narration }}</td>
                                                    <td class="total" width="20%"
                                                        style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                        <small>CR </small>{{ \AccountHelper::number_format( $data->get('transactions')->Credit ) }}</td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Received By :</td>
                                                    <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">{{ $data->get('transactions')->createdBy->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                    <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                    </main>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->

                                    <div class="border-top text-center text-sm-left p-3 ">
                                        &copy; {{ date('Y') }}
                                        Deskbook ERP<span
                                            class="d-sm-inline-block float-right">Crafted with <i
                                                class="mdi mdi-heart text-danger"></i> by Optimum Tech - 0313-6650965</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.dashboard-footer')
    </div>
@endsection
@endsection

@section('innerScriptFiles')
@endsection
@section('innerScript')
@endsection
