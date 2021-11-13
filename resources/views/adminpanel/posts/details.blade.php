@extends('adminpanel.layouts.app')

@section('content')

    <div>

        <dl class="dl-horizontal">
            <dt>
                {{ __('message.Name') }}
            </dt>

            <dd>
                {{ $post->name }}
            </dd>

            <dt>
                {{ __('message.email') }}
            </dt>

            <dd>
                {{ $post->email }}
            </dd>

            <dt>
                {{ __('message.Phone') }}
            </dt>

            <dd>
                {{ $post->phone }}
            </dd>
            <dt>
                {{ __('message.Message') }}
            </dt>
            <dd>
                {{ $post->message }}
            </dd>

            <dt>
                {{ __('message.UserWebLang') }}
            </dt>

            <dd>
                {{ $post->user_lang }}
            </dd>
            <dt>
                {{ __('message.IpLocationInformations') }}
            </dt>

            <dd>
                <?php $info = (array) json_decode($ipdat); ?>
                @foreach($info as $key => $value)
                {{ $key }}  : {{ $value }} <br>
                @endforeach
            </dd>


        </dl>
    </div>
    <p>
        <a href="/adminpanel/posts">{{ __('message.Back') }}</a>
    </p>


@endsection
