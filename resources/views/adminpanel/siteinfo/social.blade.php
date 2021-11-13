@extends('adminpanel.layouts.app')

@section('content')
    <h4>{{ locale_words('SocialMedia') }}</h4>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>{{ locale_words('SocialMedia') }}</th>
            @foreach($language as $lng)
                <th>{{ $lng->lang_name }}</th>
            @endforeach
        </tr>
        @foreach($socialMedia as $key => $value)
            <tr>
                <td>
                    {{ $socialMedia[$key]['name'] }}
                </td>
                @foreach($language as $lang)
                    @php
                        $social = \App\Contact_info::where('kind','socialMedia')->where('name',$socialMedia[$key]['name'])->where('lang_id',$lang->lang_id)->first();
                    @endphp
                    @if($social)
                        <td>
                            <form action="{{ route('contact.update',$social->contact_id) }}" method="POST">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" name="lang_id" value="{{ $social->lang_id }}">
                                    <input type="hidden" name="name" value="{{ $social->name }}">
                                    <input type="hidden" name="icon" value="{{ $socialMedia[$key]['icon'] }}">
                                    <input type="text" required value="{{ $social->contact_value }}"
                                           name="contact_value" class="form-control"
                                           aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <button class="btn btn-sm btn-block btn-outline-primary"
                                        type="submit">{{ locale_words('Edit') }}</button>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{ route('contact.store') }}" method="POST">
                                <input type="hidden" name="lang_id" value="{{ $lang->lang_id }}">
                                <input type="hidden" name="name" value="{{ $socialMedia[$key]['name'] }}">
                                <input type="hidden" name="icon" value="{{ $socialMedia[$key]['icon'] }}">
                                <input type="hidden" name="kind" value="socialMedia">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" value="" required name="contact_value" class="form-control"
                                           aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <button class="btn btn-sm btn-block btn-outline-danger"
                                        type="submit">{{ locale_words('Save') }}</button>
                            </form>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
