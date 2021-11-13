@if(isset($tourProgram))
    <div class="col-sm-12 t-prog mt-sm-4">
        <h3 class="s-head mb-0">{{ $tourInfo->tour_header. ' ' . locale_words('Program') }}</h3>
        @php $prog = str_replace('<ul>','<ul class="list-group list-group-flush">',$tourProgram->tour_program) @endphp
        {!! str_replace('<li>','<li><i class="fas fa-caret-right"></i>',$prog) !!}
    </div>
@endif