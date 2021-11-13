<table class="table table-inverse table-bordered price-table w-100 text-center mt-2">
    <caption style="caption-side: top">
        <h2 class="s-head mb-0">
            <strong>{{ $tourInfo->tour_header . ' ' .locale_words('price for excursion') }}</strong>
        </h2>
    </caption>
    <thead>
    <tr>
        <th>{{ locale_words('Age Range') }}</th>
        <th>{{ locale_words('tour Price') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prices as $price)
        <tr>
            <td class="p-1">
                <strong>
                    &nbsp;1 {{ __('message.'.$price->age_range) }}
                    @if(isset($tour->min_child) && isset($tour->max_child) && $price->age_range == 'child')
                        ({{ $tour->min_child .'-' .  $tour->max_child}})
                    @endif
                    @if(isset($tour->min_child) && isset($tour->max_child) && $price->age_range == 'infants')
                        (0-{{  $tour->min_child-1}})
                    @endif
                </strong>
            </td>
            <td><strong>{{ $price->price }}{{ $tourCurrency->currency_icon }}</strong></td>
        </tr>
    @endforeach
    </tbody>
</table>