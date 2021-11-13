<div class="col-sm-12 tspcfc">
    <div class="t-spec">
        <div class="ozellik">
            <span>{{ __('message.Tourdays') }}</span>{{ check_property($tourProgram,'tour_days')  }}
        </div>
        <div class="ozellik"><span>{{ __('message.tourhours') }}</span>
            <div class="saat">{{ check_property($tourProgram,'tour_hours') }}</div>
        </div>
        <div class="ozellik">
            <span>{{ __('message.Includes') }}</span>{{ check_property($tourProgram,'tour_includes') }}
        </div>
        <div class="ozellik">
            <span>{{ __('message.excludes') }}</span>{{ check_property($tourProgram,'tour_excludes') }}
        </div>
        <div class="ozellik">
            <span>{{ __('message.dontForgets') }}</span>{{ check_property($tourProgram,'dont_forget') }}
        </div>
    </div>
</div>