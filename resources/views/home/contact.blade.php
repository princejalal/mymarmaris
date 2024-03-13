@extends('layouts.app')

@section('content')
    <h1 class="m-head2">{{ locale_words('Contact') }}</h1>
    <div class="container my-bg">
        <div class="row">
            <div class="col-sm-12 border p-2 my-2">
                <div class="contact-tb">
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 clft">{{ locale_words('Address') }}</div>
                        @foreach($address as $add)
                            <div class="col-8 sag"> {{ $add->contact_value }}</div>
                        @endforeach
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 sol">
                            <div class="phone-icon"><i class="fa fa-phone"></i>{{ locale_words('Phone') }}</div>
                            <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i>Whatsapp</div>
                            <div class="viber-icon"><i class="fab fa-viber"></i>Viber</div>
                        </div>
                        <div class="col-8 sag">
                            <ul>
                                <li dir="ltr">{{ $phone->contact_value }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 sol">{{ locale_words('Email') }}</div>
                        @foreach($emailes as $em)
                            <div class="col-8 sag mt-1">{{ $em->contact_value }}</div>
                        @endforeach
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 sol">{{ locale_words('LICENSENUMBER') }}</div>
                        <div class="col-8 sag mt-1">14568</div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-4 sol">{{ locale_words('SocialWeAre') }}</div>
                        <div class="col-8 sag mt-1">
                            @foreach($contactSocial as $media)
                                @if(isset($socialLink[$media->name]) && $media->name != 'telegram' && $media->name != 'whatsapp')
                                    <a target="_blank" href="{{ $socialLink[$media->name] }}{{ $media->contact_value }}"
                                       class="icon-button {{ $media->name }}"><i
                                            class="{{ $media->icon }} fa-2x"></i><span></span></a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 form-container">
                {!! Form::open(['url' => route('post.store',app()->getLocale()),'method'=>'POST','id'=>'contactform','class'=>'res-round']) !!}
                <h2 class="s-head mb-0">{{ locale_words('ALANYA TOURS CONTACT FORM') }}</h2>
                <br/>
                <input type="hidden" value="{{ app()->getLocale() }}" name="user_lang">
                <input type="hidden" value="{{ \Request::ip() }}" name="ip_address">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>locale_words('YourName')]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::text('email',null,['class'=>'form-control','required','placeholder'=>locale_words('YourEmail')]) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::text('phone',null,['class'=>'form-control','required','placeholder'=>locale_words('YourPhone')]) !!}
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::textarea('message',null,['class'=>'form-control','required','rows'=>2,'placeholder'=>locale_words('YourMessage')]) !!}
                    </div>
                    <div class="form-group col-md-12 mt-2">
                        {!! app('captcha')->display($attributes = [], $options = ['lang'=> app()->getLocale()]) !!}
                        @error('g-recaptcha-response')
                        <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-12 text-right">
                    <button id="send" type="submit" class="btn btn-secondary">{{ locale_words('Send') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
