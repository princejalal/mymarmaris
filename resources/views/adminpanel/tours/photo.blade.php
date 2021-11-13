@extends('adminpanel.layouts.app')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/css/portfolio.css') }}" rel="stylesheet"/>
@endsection

@section('script')
    <script src="{{ asset('admin/js/jquery.mixitup.min.js') }}"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
        $('input[type=radio].gifcheck').change(function () {
            if ($(this).prop("checked")) {
                var str = "#" + this.id;
                var res = str.replace("gif", "order");
                $(res).addClass('gif');
                $.post("/adminpanel/tours/doGif", {
                    gifId: this.id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (output) {
                    var item = '#order_' + output;
                    $(item).removeClass('gif');
                });
                return;
            }
            //Here do the stuff you want to do when 'unchecked'
        });
        $('input[type=radio].covercheck').change(function () {
            if ($(this).prop("checked")) {
                var str = "#" + this.id;
                var res = str.replace("cover", "order");
                $(res).addClass('cover');
                $.post("/adminpanel/tours/doCover", {
                    coverId: this.id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (output) {
                    var item = '#order_' + output;
                    $(item).removeClass('cover');
                }, "json");
                return;
            }
            //Here do the stuff you want to do when 'unchecked'
        });

        $('button.delete').click(function () {
            var checkstr = confirm('are you sure you want to delete this photo?');
            if (checkstr == true) {
                var e = this.id;
                $.post("/adminpanel/tours/deletePhoto", {
                    photoId: e,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (output) {
                    $('li#' + output).remove();
                }, "json")
            } else {
                return false;
            }
            return;
        });

    </script>
@endsection
@section('content')
    <div class="col-12">
        <div class="white-box">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                </div>
                <div class="col">
                    <form enctype="multipart/form-data" action="{{ route('tour.upload.photo',$id) }}" method="POST">
                        @csrf
                        <input type="file" multiple="multiple" required accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff"
                               name="tourPhoto[]"/><br/>
                        <input type="hidden" value="{{ $id }}" name="tour_id">
                        <input type="submit" class="btn btn-default" value="upload"/>
                    </form>
                </div>
                <div class="col">
                    <a class="btn btn-success" href="/adminpanel/tours">
                        {{ __('Back') }}
                    </a>
                    <button type="button" id="deleteall" class="btn btn-danger deleteall"
                            onclick='deleteItem("{{ __('message.DeleteItem') }}","{{ route('photo.all.destroy',$id ) }}","{{ $id  }}")'
                            >

                        {{ __('Delete All Photos') }}
                    </button>
                </div>
            </div>
            <hr/>
            <div id="content">
                <ul class="row panel-photos" id="sortable">
                    @foreach($photos as $photo)
                        @if($photo->cover == 1)
                            @php($classOne = 'cover' )
                            @php($coverChecked = 'checked')
                        @else
                            @php($classOne = '')
                            @php($coverChecked = '')
                        @endif
                        @if($photo->gif == 1)
                            @php($classTwo = 'gif')
                            @php($gifChecked = 'checked')
                        @else
                            @php($classTwo = '')
                            @php($gifChecked = '')
                        @endif
                        <li id="order_{{ $photo->photo_id }}"
                            class="col-sm-4 col-md-3 col-lg-2 col-xs-6 {{ $classOne }} {{ $classTwo }}">
                            <img src="{{ asset('content/images/Tours/' . $id . '/' . $photo->photo_path) }}"
                                 class=" img-responsive"/>
                            <div class="">
                                <div class="text-center" style="color:#06003c; background-color:#fff;">

                                </div>
                                <div class="form-check">
                                    <input {{ $gifChecked }} class="form-check-input gifcheck" type="radio" name="gif_radio"
                                           id="gif_{{ $photo->photo_id }}">
                                    <label class="form-check-label" for="gif_{{ $photo->photo_id }}">
                                        {{ __('Set as GIF') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input {{ $coverChecked }} class="form-check-input covercheck" type="radio" name="cover_radio"
                                           id="cover_{{ $photo->photo_id }}">
                                    <label class="form-check-label" for="cover_{{ $photo->photo_id }}">
                                        {{ __('Set as Cover') }}
                                    </label>
                                </div>
                                <button type="button"
                                        id="delete_{{ $photo->photo_id }}"
                                        class="btn btn-danger btn-block delete">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection
