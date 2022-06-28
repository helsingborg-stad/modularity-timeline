<div class="{{ $classes }}" {!! $attributes  !!}>
    @if (!$hideTitle && !empty($post_title))
    <h4 class="box-title">{!! apply_filters('the_title', $post_title) !!}</h4>
    @endif
    <div class="box-content">
	    <ul class="timeline">
	    	@foreach($events as $event)
		        <li class="timeline__event">
					{!! !empty($event['link']) ? '<a href="' . $event['link'] . '" alt="' . $event['title'] . '">' : '' !!}
					<?php $eventTimeDate =  ($event['format']) ? substr($event['timestamp'], 0, -3) :  $event['date'];  ?>
					<div class="timeline__date hidden-xs hidden-sm">
							{!! \ModularityTimeline\Module::timelineDate($ID, $eventTimeDate) !!}
						</div>
						<div class="timeline__marker">
							<div class="timeline__date hidden-md hidden-lg">
								{!! \ModularityTimeline\Module::timelineDate($ID, $eventTimeDate) !!}
							</div>
						</div>
						<div class="timeline__content timeline__{{ $event['image_position'] }}">

							<div class="grid">

								@if(!empty($event['image']['ID']))
									<div class="{{ $event['image_grid'] }}">
										{!! $event['image_markup'] !!}
									</div>
								@endif

								<div class="{{ $event['content_grid'] }}">
									<div class="timeline__content__date">
										{!! \ModularityTimeline\Module::timelineDate($ID, $eventTimeDate) !!}
									</div>
									<h3 class="timeline__title">{{ $event['title'] }}</h3>
									{!! $event['content'] !!}
								</div>
							</div>
						</div>
                    {!! !empty($event['link']) ? '</a>' : '' !!}
		        </li>
	        @endforeach
	    </ul>
    </div>
</div>
