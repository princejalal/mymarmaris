<div class="my-2">
    <section class="mt-2">
        <div class="card btn-secondary">
            <h4 class="s-head text-center">{{ $tourInfo->tour_header. ' ' .locale_words('Diff') }}</h4>
            <div class="card-body text-center">
                <p class="h6">{{ check_property($tourInfo,'tour_difference') }}</p>
            </div>
        </div>
    </section>
</div>