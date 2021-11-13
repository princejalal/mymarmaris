@extends('adminpanel.layouts.app')

@section('content')
    <h4>{{ locale_words('Manage') }} {{ locale_words('Users') }}</h4>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Name') }}
            </th>
            <th>
                 {{ locale_words('Email') }}
            </th>
            <th>
                {{ locale_words('Role') }}
            </th>
            <th> {{ locale_words('Operations') }} </th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                   {{ $user->user_role }}
                </td>
                <td width="500px">
                    <a class="btn btn-outline-success"
                       href="{{ route('manageUser.edit',$user->id) }}">{{ locale_words('Edit') }}</a>
                    <button class="btn btn-outline-danger"
                            onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('manageUser.destroy',$user->id) }}","{{ $user->id }}")'>{{ __('message.Delete') }}</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
