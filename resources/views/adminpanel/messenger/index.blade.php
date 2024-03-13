@extends('adminpanel.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <p>
                    <a class="btn btn-success" href="{{ route('messenger.create') }}">Add New Messenger</a>
                    <a class="btn btn-info" href="{{ route('messenger-type.index') }}">Messenger Types</a>
                </p>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>
                            Value
                        </th>
                        <th>
                            language
                        </th>
                        <th>
                            Messenger Type
                        </th>
                        <th></th>
                    </tr>
                    @foreach($messengers as $messenger)
                        <tr>
                            <td>
                                {{ $messenger->value }}
                            </td>
                            <td>{{ $messenger->language->lang_short_name }}
                            </td>
                            <td>
                                {{ $messenger->type->name }}
                            </td>
                            <td>
                                <a href="{{ route('messenger.edit',$messenger->id) }}">{{ locale_words('Edit') }}</a> |
                                <a class="text-danger pointer-event"
                                   onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('messenger.destroy',$messenger->id) }}","{{ $messenger->id }}")'
                                >{{ __('message.Delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $messengers->links() }}
            </div>
        </div>
    </div>
@endsection
