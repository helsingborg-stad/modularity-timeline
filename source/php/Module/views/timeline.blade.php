<div class="{{ $classes }}" {!! $attributes !!}>
    @if (!$hideTitle && !empty($post_title))
        <h4>{!! apply_filters('the_title', $post_title) !!}</h4>
    @endif

	@timeline(['events' => $events])
	@endtimeline
</div>
