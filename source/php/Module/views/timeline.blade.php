<div class="{{ $classes }}" {!! $attributes !!}>
    @if (!$hideTitle && !empty($post_title))
		@typography([
			'element' => 'h4',
			'variant' => 'h4'
		])
			{!! apply_filters('the_title', $post_title) !!}
		@endtypography
    @endif

	@timeline([
		'events' => $events,
		'sequential' => $sequential
	])
	@endtimeline
</div>
