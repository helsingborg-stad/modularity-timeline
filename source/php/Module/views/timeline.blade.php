<div class="{{ $classes }}" {!! $attributes !!}>
    @if (!$hideTitle && !empty($post_title))
        <h4>{!! apply_filters('the_title', $post_title) !!}</h4>
    @endif

    <ul class="timeline">
        @foreach ($events as $event)
            <li class="timeline__event">
                <div class="timeline__date u-visibility--hidden@sm u-visibility--hidden@xs">
                    {!! $event['timelineDate'] !!}
                </div>
                <div class="timeline__marker">
                    <div class="timeline__date u-visibility--hidden@md u-visibility--hidden@lg">
                        {!! $event['timelineDate'] !!}
                    </div>
                </div>

                @card([
                    'classList' => ['timeline__event__card'],
                    'context' => 'module.timeline.card',
                    'link' => $event['link']
                ])
                    @if (isset($event['imageSrc']))
                        <div class="c-card__image">
                            <div class="c-card__image-background u-ratio-16-9" alt="{{ $event['title'] }}"
                                style="background-image:url('{{ $event['imageSrc'][0] }}');"></div>
                        </div>
                    @endif

                    <div class="c-card__body">
                        <h3 class="timeline__title">{{ $event['title'] }}</h3>
                        {!! $event['content'] !!}
                    </div>
                @endcard
            </li>
        @endforeach
    </ul>
</div>
