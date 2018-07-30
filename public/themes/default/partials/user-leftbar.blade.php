<div class="user-profile-buttons">
	<div class="row follow-links pagelike-links">
		<!-- This [if-1] is for checking current user timeline or diff user timeline -->	
		@if(Auth::user()->username != $timeline->username)
		<?php 
					//php code is for checking user's follow_privacy settings
		$user_follow ="";
		$confirm_follow ="";
		$message_privacy ="";						
		$othersSettings = $user->getOthersSettings($timeline->username);
		if($othersSettings)
		{
						//follow_privacy checking
			if ($othersSettings->follow_privacy == "only_follow") {
				$user_follow = "only_follow";
			}elseif ($othersSettings->follow_privacy == "everyone") {
				$user_follow = "everyone";
			}

						//confirm_follow checking
			if ($othersSettings->confirm_follow == "yes") {
				$confirm_follow = "yes";
			}elseif ($othersSettings->confirm_follow == "no") {
				$confirm_follow = "no";
			}

			//message_privacy checking
			if ($othersSettings->message_privacy == "only_follow") {
				$message_privacy = "only_follow";
			}elseif ($othersSettings->message_privacy == "everyone") {
				$message_privacy = "everyone";
			}
		}

		?>
		<!-- This [if-2] is for checking usersettings follow_privacy showing follow/following || message button -->
		@if($confirm_follow == "no")

			<!-- This [if-3] is for checking usersettings follow_privacy showing follow/following || message button -->
			@if(($user->followers->contains(Auth::user()->id) && $user_follow == "only_follow") || ($user_follow == "everyone"))

				@if(!$user->followers->contains(Auth::user()->id))
					
					@if($message_privacy == "everyone")
						<div class="col-md-6 col-sm-6 col-xs-6 left-col">
							<a href="#" class="btn btn-options btn-block follow-user btn-default follow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-heart"></i> {{ trans('common.follow') }}
							</a>
						</div>
					@else
						<div class="col-md-12 col-sm-6 col-xs-6">
							<a href="#" class="btn btn-options btn-block follow-user btn-default follow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-heart"></i> {{ trans('common.follow') }}
							</a>
						</div>
					@endif	
					
					@if($message_privacy == "everyone")
						<div class="col-md-6 col-sm-6 col-xs-6 hidden">
							<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-check"></i> {{ trans('common.following') }}
							</a>
						</div>
					@else
						<div class="col-md-12 col-sm-6 col-xs-6 hidden">
							<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-check"></i> {{ trans('common.following') }}
							</a>
						</div>
					@endif	
				@else

					<div class="col-md-6 col-sm-6 col-xs-6 hidden">
						<a href="#" class="btn btn-options btn-block follow-user btn-default follow " data-timeline-id="{{ $timeline->id }}">
							<i class="fa fa-heart"></i> {{ trans('common.follow') }}
						</a>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-6 left-col">
						<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">	<i class="fa fa-check"></i> {{ trans('common.following') }}
						</a>
					</div>
				@endif
			@elseif(($user->following->contains(Auth::user()->id) && $user_follow == "only_follow") || ($user_follow == "everyone"))

				@if(!$user->followers->contains(Auth::user()->id))
					@if($message_privacy == "everyone")	
						<div class="col-md-6 col-sm-6 col-xs-6 left-col">
							<a href="#" class="btn btn-options btn-block follow-user btn-default follow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-heart"></i> {{ trans('common.follow') }}
							</a>
						</div>
					@else
						<div class="col-md-12 col-sm-6 col-xs-6 left-col">
						<a href="#" class="btn btn-options btn-block follow-user btn-default follow" data-timeline-id="{{ $timeline->id }}">
							<i class="fa fa-heart"></i> {{ trans('common.follow') }}
						</a>
					</div>
					@endif
					
					@if($message_privacy == "everyone")
						<div class="col-md-6 col-sm-6 col-xs-6 hidden">
							<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-check"></i> {{ trans('common.following') }}
							</a>
						</div>
					@else
						<div class="col-md-12 col-sm-6 col-xs-6 hidden">
							<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">
								<i class="fa fa-check"></i> {{ trans('common.following') }}
							</a>
						</div>
					@endif

				@else							
					<div class="col-md-6 col-sm-6 col-xs-6 hidden">
						<a href="#" class="btn btn-options btn-block follow-user btn-default follow " data-timeline-id="{{ $timeline->id }}">
							<i class="fa fa-heart"></i> {{ trans('common.follow') }}
						</a>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-6 left-col">
						<a href="#" class="btn btn-options btn-block follow-user btn-success unfollow" data-timeline-id="{{ $timeline->id }}">	<i class="fa fa-heart"></i> {{ trans('common.following') }}
						</a>
					</div>
				@endif
			@endif	<!-- End of [if-3]-->

			@elseif($confirm_follow == "yes")
			<!-- This [if-4] is for checking usersettings follow_privacy showing follow/following || message button -->
				@if(($user->followers->contains(Auth::user()->id) && $user_follow == "only_follow") || ($user_follow == "everyone"))
					@if(!$user->followers->contains(Auth::user()->id))
						@if($message_privacy == "everyone")
							<div class="col-md-6 col-sm-6 col-xs-6 left-col">
								<a href="#" class="btn btn-options btn-block btn-default follow-user-confirm follow" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
									<i class="fa fa-heart"></i> {{ trans('common.follow') }}
								</a>
							</div>
						@else
							<div class="col-md-12 col-sm-6 col-xs-6">
								<a href="#" class="btn btn-options btn-block btn-default follow-user-confirm follow" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
									<i class="fa fa-heart"></i> {{ trans('common.follow') }}
								</a>
							</div>
						@endif
						
						@if($message_privacy == "everyone")
							<div class="col-md-6 col-sm-6 col-xs-6 hidden">
								<a href="#" class="btn btn-options btn-block follow-user-confirm btn-warning followrequest" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
									<i class="fa fa-check"></i> {{ trans('common.requested') }}
								</a>
							</div>
						@else
							<div class="col-md-12 col-sm-6 col-xs-6 hidden">
								<a href="#" class="btn btn-options btn-block follow-user-confirm btn-warning followrequest" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
									<i class="fa fa-check"></i> {{ trans('common.requested') }}
								</a>
							</div>
						@endif	
					@else
						<div class="col-md-6 col-sm-6 col-xs-6 hidden">
							<a href="#" class="btn btn-options btn-block btn-default follow-user-confirm  follow " data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
								<i class="fa fa-heart"></i> {{ trans('common.follow') }}
							</a>
						</div>

					@if($follow_user_status == "pending")
					<div class="col-md-6 col-sm-6 col-xs-6 left-col">
						<a href="#" class="btn btn-options btn-block follow-user-confirm btn-warning followrequest" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
							<i class="fa fa-check"></i> {{ trans('common.requested') }}
						</a>
					</div>
					@endif
					@if($follow_user_status == "approved")
					<div class="col-md-6 col-sm-6 col-xs-6 left-col">
						<a href="#" class="btn btn-options btn-block follow-user-confirm btn-primary unfollow" data-timeline-id="{{ $timeline->id }}-{{ $follow_user_status }}">
							<i class="fa fa-check"></i> {{ trans('common.following') }}
						</a>
					</div>
					@endif
				@endif
			@endif	<!-- End of [if-4]-->
		@endif	<!-- End of [if-2]-->
			@if(($user->followers->contains(Auth::user()->id) && $message_privacy == "only_follow") || ($message_privacy == "everyone"))	
				<div class="col-md-6 col-sm-6 col-xs-6 right-col">
					<a href="#" class="btn btn-options btn-block btn-default" onClick="chatBoxes.sendMessage({{ $timeline->user->id }})">
						<i class="fa fa-inbox"></i> {{ trans('common.message') }}
					</a>
				</div>
			@endif
		@else
		<div class="col-md-12"><a href="{{ url('/'.Auth::user()->username.'/settings/general') }}" class="btn btn-profile"><i class="fa fa-pencil-square-o"></i>{{ trans('common.edit_profile') }}</a></div>
		@endif <!-- End of [if-1]-->

	</div>
</div>

@if (        
        ($timeline->type == 'user' && $timeline->id == Auth::user()->timeline_id) ||
        ($timeline->type == 'page' && $timeline->page->is_admin(Auth::user()->id) == true) ||
        ($timeline->type == 'group' && $timeline->groups->is_admin(Auth::user()->id) == true)
        )
<br>
<div class="user-profile-buttons">
	<div class="row">
		<div class="col-md-12"><a href="{{ url('/'.Auth::user()->username.'/settings/wallpaper') }}" class="btn btn-profile"><i class="fa fa-image"></i>{{ trans('common.set_wallpaper') }}</a></div>
	</div>
</div>
@endif

<div class="user-bio-block">
	<div class="bio-header">{{ trans('common.bio') }}</div>
	<div class="bio-description">
		{{ ($user->about != NULL) ? $user->about : trans('messages.no_description') }}
		<ul class="list-unstyled list-details">
			@if($user->hobbies != NULL)
				<li>{!! '<b>'.trans('common.hobbies').': </b>'!!} {{ $user->hobbies }}</li>
			@endif
			@if($user->interests != NULL)
				<li>{!! '<b>'.trans('common.interests').': </b>'!!} {{ $user->interests }}</li>
			@endif
			@if($user->custom_option1 != NULL && Setting::get('custom_option1') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option1').': </b>'!!} {{ $user->custom_option1 }}</li>
			@endif
			@if($user->custom_option2 != NULL && Setting::get('custom_option2') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option2').': </b>'!!} {{ $user->custom_option2 }}</li>
			@endif
			@if($user->custom_option3 != NULL && Setting::get('custom_option3') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option3').': </b>'!!} {{ $user->custom_option3 }}</li>
			@endif
			@if($user->custom_option4 != NULL && Setting::get('custom_option4') != NULL)
				<li>{!! '<b>'.Setting::get('custom_option4').': </b>'!!} {{ $user->custom_option4 }}</li>
			@endif
		</ul>
	</div>
	
	<ul class="bio-list list-unstyled">
		@if($user->designation != NULL)
			<li><i class="fa fa-thumb-tack"></i> <span>{{ $user->designation }}</span></li>
		@endif
		@if($user->country != NULL)
		<li>
			<i class="fa fa-map-marker" aria-hidden="true"></i><span>{{ trans('common.lives_in').' '.$user->country }}</span>
		</li>
		@endif

		@if($user->city != NULL)
		<li><i class="fa fa-building-o"></i><span>{{ trans('common.from').' '.$user->city }}</span></li>
		@endif

		@if($user->birthday != '1970-01-01')
		<li><i class="fa fa-calendar"></i><span>

			{{ trans('common.born_on').' '.date('F d', strtotime($user->birthday)) }}

		</span></li>
		@endif
	</ul>
	<ul class="list-inline list-unstyled social-links-list">
		@if($user->facebook_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->facebook_link }}" class="btn btn-facebook"><i class="fa fa-facebook"></i></a>
			</li>
		@endif
		@if($user->twitter_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->twitter_link }}" class="btn btn-twitter"><i class="fa fa-twitter"></i></a>
			</li>
		@endif
		@if($user->dribbble_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->dribbble_link }}" class="btn btn-dribbble"><i class="fa fa-dribbble"></i></a>
			</li>
		@endif
		@if($user->youtube_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->youtube_link }}" class="btn btn-youtube"><i class="fa fa-youtube"></i></a>
			</li>
		@endif
		@if($user->instagram_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->instagram_link }}" class="btn btn-instagram"><i class="fa fa-instagram"></i></a>
			</li>
		@endif
		@if($user->linkedin_link != NULL)
			<li>
				<a target="_blank" href="{{ $user->linkedin_link }}" class="btn btn-linkedin"><i class="fa fa-linkedin"></i></a>
			</li>
		@endif
	</ul>
</div>

<!-- Albums Widget -->
@if((Auth::user()->username == $timeline->username) ||
	(Auth::user()->username != $timeline->username) && count($timeline->albums()->get()) > 0)
		
		<div class="widget-pictures widget-best-pictures all-groups">
			<div class="picture side-left">
				<span class="font-15"><i class="fa fa-film"></i> &nbsp;{{ ' '.trans('common.albums') }}</span>
			</div>

			<div class="clearfix"></div>

			<div class="best-pictures my-best-pictures">
				@if(count($timeline->albums()->get()) != NULL)
					<div class="row">
						@foreach($timeline->albums()->take(4)->get() as $album)
							<div class="col-md-6 col-sm-6 col-xs-6 best-pics">
								<a href="{{ url($timeline->username.'/album/show/'.$album->id) }}" class="image-hover" title="{{ $album->name }}" data-toggle="tooltip" data-placement="top">
									@if($album->previewImage()->first() != null) 
									<span class="image-holder">
										<img src="{!! url('/album/'.$album->previewImage()->first()['source']) !!}" alt="{{ $album->name }}" title="{{ $album->name }}">
										<span class="search"></span>
										<i class="fa fa-search-plus"></i>
									</span>
									@else
									<span class="image-holder">
										<img src="{{ url('/album/'.$album->photos()->first()['source']) }}" alt="{{ $album->name }}" title="{{ $album->name }}">
										<span class="search"></span>
										<i class="fa fa-search-plus"></i>
									</span>
									@endif
								</a>
							</div>
						@endforeach
					</div>
					<div>
						<div class="pull-right">
							<a href="{{ url($timeline->username.'/albums') }}" class="">{{ trans('common.show_all') }}</a>&nbsp;&nbsp;&nbsp;
						</div>
						<div class="clearfix"></div>
					</div>
				@else
					<div class="alert alert-warning">{{ trans('messages.no_albums') }}</div>
				@endif
			</div><!-- /best-pictures -->
		</div>
	@endif

		

<!-- /Albums Widget -->

<!-- Change avatar form -->
<form class="change-avatar-form hidden" action="{{ url('ajax/change-avatar') }}" method="post" enctype="multipart/form-data">
	<input name="timeline_id" value="{{ $timeline->id }}" type="hidden">
	<input name="timeline_type" value="{{ $timeline->type }}" type="hidden">
	<input class="change-avatar-input hidden" accept="image/jpeg,image/png" type="file" name="change_avatar" >
</form>

<!-- Change cover form -->
<form class="change-cover-form hidden" action="{{ url('ajax/change-cover') }}" method="post" enctype="multipart/form-data">
	<input name="timeline_id" value="{{ $timeline->id }}" type="hidden">
	<input name="timeline_type" value="{{ $timeline->type }}" type="hidden">
	<input class="change-cover-input hidden" accept="image/jpeg,image/png" type="file" name="change_cover" >
</form>

	<!-- my-pages -->
	<div class="widget-pictures widget-best-pictures all-groups">
		<div class="picture side-left">
			{{ trans('common.pages') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($own_pages) > 0)
				@foreach($own_pages as $own_page)
				<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
					<a href="{{ url($own_page->username) }}" class="image-hover" title="{{ $own_page->name }}" data-toggle="tooltip" data-placement="top">
						<img src="@if($own_page->avatar != NULL) {{ url('page/avatar/'.$own_page->avatar) }} @else {{ url('page/avatar/default-page-avatar.png')}} @endif" alt="{{ $own_page->name }}" title="{{ $own_page->name }}">
					</a>
				</div>
				@endforeach
				@else
				<div class="alert alert-warning">{{ trans('messages.no_pages') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="show-more-options text-center">
			@if(count($own_pages) > 12)
				<a href="#" class="show-all-pages"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-pages"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my pages -->

	<!-- my-groups -->
	<div class="widget-pictures widget-best-pictures all-groups">
		<div class="picture side-left">
			{{ trans('common.groups') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($own_groups) > 0)					
					@foreach($own_groups as $own_group)
					<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
						<a href="{{ url($own_group->username) }}" class="image-hover" title="{{ $own_group->name }}" data-toggle="tooltip" data-placement="top">
							<img src=" @if($own_group->avatar != NULL) {{ url('group/avatar/'.$own_group->avatar) }} @else {{ url('group/avatar/default-group-avatar.png') }} @endif " alt="{{ $own_group->name }}" title="{{ $own_group->name }}" >
						</a>
					</div>
					@endforeach					
				@else
					<div class="alert alert-warning">{{ trans('messages.no_groups') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="see-more-options text-center">
			@if(count($own_groups) > 12)
				<a href="#" class="show-all-groups"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-groups"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my pages -->

	<!-- my-events -->
	<div class="widget-pictures widget-best-pictures all-groups">

		<div class="picture pull-left">
			{{ trans('common.events') }}
		</div>
		<div class="clearfix"></div>
		<div class="best-pictures my-best-pictures scrollable">
			<div class="row">
				@if(count($user_events) > 0)
					@foreach($user_events as $user_event)
					<div class="col-md-2 col-sm-2 col-xs-2 best-pics">
						<a href="{{ url($user_event->timeline->username) }}" class="image-hover" title="{{ $user_event->timeline->name }}" data-toggle="tooltip" data-placement="top">
							<img src="{{ $user_event->user->picture }}" alt="{{ $user_event->timeline->name }}" title="{{ $user_event->timeline->name }}" >						
						</a>
					</div>
					@endforeach
				@else
					<div class="alert alert-warning">{{ trans('messages.no_events') }}</div>
				@endif
			</div><!-- /row -->
		</div>
		<div class="see-more-options text-center">
			@if(count($user_events) > 12)
				<a href="#" class="show-all-events"><i class="fa fa-plus-square-o"></i> {{ trans('common.show_more') }}</a>
				<a href="#" class="less-all-events"><i class="fa fa-minus-square-o"></i> {{ trans('common.show_less') }}</a>
			@endif
		</div>
	</div>
	<!-- /my events -->

	@if(Setting::get('timeline_ad') != NULL)
	<div id="link_other" class="post-filters">
		{!! htmlspecialchars_decode(Setting::get('timeline_ad')) !!} 
	</div>	
	@endif
















