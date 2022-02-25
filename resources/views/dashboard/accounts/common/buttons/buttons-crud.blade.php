{{--
    AVAILABLE BUTTONS

    'save' => 'true',
    'save_print' => 'true',
    'save_new' => 'true',

    'update' => 'true',
    'update_print' => 'true',
    'update_now' => 'true',

    'reset' => 'true',

    'cancel' => 'true', 'cancel_route' => 'ROUTE_NAME',

    'full_paid' => 'true, 'paid_field' => 'ID_OF_PAID_AMOUNT_FIELD', 'total_field' => 'ID_OF_TOTAL_AMOUNT_FIELD',

    'form_id' => 'FORM_ID_TO_SUBMIT',
    this should be added if using save_print, update_print or save_new
--}}
<div class="row">
    <div class="col-md-12 text-right">
        @isset($save_print)
        {!! Form::hidden('doPrint','0', ['id' => 'doPrint']) !!}
        <button type="button" class="btn btn-info waves-effect waves-light w-md"
                onclick="SubmitAndPrint('{{ $form_id }}');" id="btn_save_print">
            {{ __('accounts.general.save_print') }}
        </button>
        @endisset
        @isset($update_print)
            {!! Form::hidden('doPrint','0', ['id' => 'doPrint']) !!}
            <button type="button" class="btn btn-info waves-effect waves-light w-md"
                    onclick="SubmitAndPrint('{{ $form_id }}');" id="btn_update_print">
                {{ __('accounts.general.update_print') }}
            </button>
        @endisset
        @isset($save_new)
            {!! Form::hidden('saveNew','0', ['id' => 'saveNew']) !!}
            <button type="button" class="btn btn-primary waves-effect waves-light w-md"
                    onclick="SubmitAndNew('{{ $form_id }}');" id="btn_save_new">
                {{ __('accounts.general.save_new') }}
            </button>
        @endisset
        @isset($save)
            {!! Form::submit(__('accounts.general.save'), ['id' => 'btn_save', 'class' => 'btn btn-success waves-effect waves-light w-md']) !!}
        @endisset
        @isset($update)
            {!! Form::submit(__('accounts.general.update'), ['id' => 'btn_update', 'class' => 'btn btn-success waves-effect waves-light w-md']) !!}
        @endisset
        @isset($full_paid)
            <button type="button" class="btn btn-dark waves-effect waves-light w-md"
                    onclick="FullPayForm('{{ $paid_field }}', '{{ $total_field }}');" id="btn_full_paid">
                {{ __('accounts.general.full_paid') }}
            </button>
        @endisset
        @isset($reset)
            <a href="javascript:void(0);" class="btn btn-danger waves-effect waves-light w-md" onclick="ResetForm('{{ \Request::fullUrl() }}');"  id="btn_reset">{{ __('accounts.general.reset_form') }}</a>
        @endisset
        @isset($cancel)
            <a href="{{ route($cancel_route) }}" class="btn btn-warning waves-effect waves-light w-md" id="btn_cancel">{{ __('accounts.general.cancel') }}</a>
        @endisset
    </div>
</div>
