@extends('adminpanel.layouts.app')

@section('content')
    <div class="row">
        @include('adminpanel.messenger.type.form')
        <div class="col-md-12">
            <div class="white-box">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Link
                        </th>
                        <th>
                            Icon
                        </th>
                        <th></th>
                    </tr>
                    @foreach($types as $type)
                        <form method="POST" action="{{ route('messenger-type.update',$type) }}">
                            @csrf
                            @method('PUT')
                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="'name" value="{{ $type->name }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="link" value="{{ $type->link }}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="icon" value="{{ $type->icon }}">
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-success" value="Update">
                                    <a class="btn btn-danger"
                                       onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('messenger-type.destroy',$type->id) }}","{{ $type->id }}")'
                                    >{{ __('message.Delete') }}</a>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
