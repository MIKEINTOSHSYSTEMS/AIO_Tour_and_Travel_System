<div class="sidebar border border-color-1 rounded-xs">
    <div class="p-4 mb-1">
        <form action="{{ route("tour.search") }}" class="bravo_form" method="get">
            @php $tour_search_fields = setting_item_array('tour_search_fields');
            $tour_search_fields = array_values(\Illuminate\Support\Arr::sort($tour_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($tour_search_fields))
                @foreach($tour_search_fields as $field)
                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp

                    @switch($field['field'])
                        @case ('service_name')
                            @include('Tour::frontend.layouts.search.fields.service_name')
                        @break
                        @case ('location')
                            @include('Tour::frontend.layouts.search.fields.location')
                        @break
                        @case ('date')
                            @include('Tour::frontend.layouts.search.fields.date')
                        @break
                        @case ('category')
                            @include('Tour::frontend.layouts.search.fields.category')
                        @break
                        @case ('attr')
                            @include('Tour::frontend.layouts.search.fields.attr')
                        @break
                    @endswitch
                @endforeach
            @endif
            <div class="text-center">
                <button type="submit" class="btn btn-primary height-60 w-100 font-weight-bold mb-xl-0 mb-lg-1 transition-3d-hover"><i class="flaticon-magnifying-glass mr-2 font-size-17"></i>Search</button>
            </div>
        </form>
    </div>
</div>