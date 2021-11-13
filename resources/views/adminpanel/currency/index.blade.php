@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a href="{{ route('currency.create') }}">Create new</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                currency id
            </th>
            <th>
                currency name
            </th>
            <th>
                currency icon<span class="tooltipim" data-toggle="tooltip" title=""
                                   data-original-title="icon for money can find in https://fontawsome.com"></i></span>
            </th>
            <th> Operations</th>
        </tr>
        @foreach($currencies as $currency)
            <tr>
                <td>
                    {{ $currency->currency_id }}
                </td>
                <td>
                    {{ $currency->currency_name }}
                </td>
                <td>
                    <span class="{{ $currency->currency_icon }}"></span>
                </td>
                <td width="500px" class="disabled">
                    <a class="btn btn-outline-success" href="{{ route('currency.edit',$currency->currency_id) }}">{{ __('message.Edit') }}</a></span>
                    <button class="btn btn-outline-danger" onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('currency.destroy',$currency->currency_id) }}","{{ $currency->currenct_id}}")'>{{ __('message.Delete') }}</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
