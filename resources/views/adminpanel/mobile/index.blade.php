@extends('adminpanel.layouts.app')

@section('content')
    <h4>{{ locale_words('Tour') }} {{ locale_words('Prices') }}</h4>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>
                {{ __("message.Language") }}  {{ __('message.Name') }}
            </th>
            <th>{{ locale_words('Content') }}</th>
        </tr>
        @foreach($langs as $lang)
            <tr>
                <td>
                    {{ $lang->lang_name }}
                </td>
                @php
                    $content = \App\Mobile_content::where('lang_id',$lang->lang_id)->first();
                @endphp
                @if($content)
                    <td width="500px">
                        <form action="{{ route('content.update',$content->id) }}" method="POST">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="input-group mb-3">
                                <textarea name="content" @if($lang->lang_short_name == 'fa' || $lang->lang_short_name == 'ar') style="direction: rtl;text-align: right;"  @endif id="content" cols="50" rows="10">
                                    {{ $content->content }}
                                </textarea>
                            </div>
                            <button class="btn btn-sm btn-block btn-outline-primary"
                                    type="submit">{{ locale_words('Edit') }}</button>
                        </form>
                    </td>
                @else
                    <td width="500px">
                        <form action="{{ route('content.store') }}" method="POST">
                            <input type="hidden" name="lang_id" value="{{ $lang->lang_id }}">
                            @csrf
                            <div class="input-group mb-3">
                                <textarea name="content" @if($lang->lang_short_name == 'fa' || $lang->lang_short_name == 'ar') style="direction: rtl;text-align: right;"  @endif id="content" cols="50" rows="10"></textarea>
                            </div>
                            <button class="btn btn-sm btn-block btn-outline-danger"
                                    type="submit">{{ locale_words('Save') }}</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
