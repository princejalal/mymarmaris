@extends('adminpanel.layouts.app')

@section('content')
    <p>
        <a class="btn btn-outline-primary" href="{{ route('contact.create') }}">{{ locale_words('Create') }} {{ locale_words('New') }} {{ locale_words('Contact') }}</a>
        <a class="btn btn-outline-primary" href="{{ route('contact.shows') }}">{{ locale_words('SocialMedia') }}</a>
    </p>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ locale_words('Contact') }} {{ locale_words('Id') }}
            </th>
            <th>
                {{ locale_words('Contact') }} {{ locale_words('Name') }}
            </th>
            <th>
                {{ locale_words('Value') }} {{ locale_words('Of') }} {{ locale_words('Contact') }}
            </th>
            <th>
                {{ locale_words('Languages') }}
            </th>
            <th>
                {{ locale_words('showOnTop') }}
            </th>
            <th>
                {{ locale_words('ShowOnFooter') }}
            </th>
            <th>
                {{ locale_words('Icon') }}
            </th>
            <th>
                {{ locale_words('Kind') }} {{ locale_words('Of') }} {{ locale_words('Contact') }}
            </th>
            <th> {{ locale_words('Operations') }}</th>
        </tr>
        @foreach($contacts as $contact)
            <tr>
                <td>
                    {{ $contact->contact_id }}
                </td>
                <td>
                    {{ $contact->name }}
                </td>
                <td>
                    {{ $contact->contact_value }}
                </td>
                <td>
                    {{ $contact->lang_short_name }}
                </td>
                <td>
                    @php ($contact->showOnTop == 1)? $checked = 'checked':$checked = '' @endphp
                    <input {{ $checked }} class="check-box" disabled="disabled" type="checkbox">
                </td>
                <td>
                    @php ($contact->ShowOnFooter == 1)? $checked = 'checked':$checked = '' @endphp
                    <input {{ $checked }} class="check-box" disabled="disabled" type="checkbox">
                </td>
                <td>
                    <i class="{{ $contact->icon }}"></i>
                </td>
                <td>
                    {{ $contact->kind }}
                </td>
                <td width="500px">
                    <a class="btn btn-outline-success"
                       href="{{ route('contact.edit',$contact->contact_id) }}">{{ locale_words('Edit') }}</a>
                    <button class="btn btn-outline-danger"
                            onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('contact.destroy',$contact->contact_id) }}","{{ $contact->contact_id }}")'>{{ __('message.Delete') }}</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $contacts->links() }}
@endsection
