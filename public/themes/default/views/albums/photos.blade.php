<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="visible-lg col-lg-2">
			<br>
			{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}
		</div>

		<div class="col-md-10" id="allPhotos">
			@include('flash::message')
			<div class="panel panel-default">
				<div class="panel-heading no-bg user-pages no-paddingbottom navbars">
					<div class="page-heading header-text">
						{{ trans('common.all_photos') }}
					</div>
					<div class="pull-right">
						<a href="{{ url('/'.Auth::user()->username.'/album/create') }}" class="btn btn-success btn-downloadreport">{{ trans('common.create_album') }}</a>
					</div>
					<div class="clearfix"></div>
					<div class="divider"></div> 
					<ul class="nav nav-pills pull-left performance-list">
						<li>
							<a href="{{ url('/'.$timeline->username.'/albums') }}" >{{ trans('common.albums') }}</a>
						</li>
						<li class="active">
							<a href="{{ url('/'.$timeline->username.'/photos') }}">{{ trans('common.photos') }}</a>
						</li>
						<li>
							<a href="{{ url('/'.$timeline->username.'/videos') }}">{{ trans('common.videos') }}</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="move_photos">
					<div class="alert alert-info" v-show="selectedPhotos.length == 0">
						Select photos to move from one album to another
					</div>
					<form action="{{ url('/'.Auth::user()->username.'/delete-photos') }}" method="POST" v-show="selectedPhotos.length != 0" v-cloak class="pull-right">
						{{ csrf_field() }}
						<input type="hidden" name="photos" value="@{{ selectedPhotos }}">
						<button type="submit" class="btn btn-danger">Delete Selected Photos</button>
					</form>
					<form action="{{ url('/'.Auth::user()->username.'/move-photos') }}" method="POST" v-show="selectedPhotos.length != 0" v-cloak>
						
						{{ csrf_field() }}
						<label for="">Select Album to move:</label>
						<?php $userAlbums = App\Album::where('timeline_id', Auth::user()->timeline_id)->pluck('name','id'); ?>
						
						@if($userAlbums->count() != 0)
							<select v-model="selectedAlbum" placeholder="Select Album">
								<option value="">Select Album</option>
								@foreach($userAlbums as $key => $user_album)
								<option v-bind:value="{{ $key }}">{{ $user_album }}</option>
								@endforeach
							</select>
						@endif

						<input type="hidden" name="album_id" value="@{{ selectedAlbum }}">
						<input type="hidden" name="photos" value="@{{ selectedPhotos }}">
						<button type="submit" class="btn btn-default">Confirm</button>
					</form><br>
				</div>

				<div class="container-fluid">
					<ul id="video-thumbnails" class="list-unstyled grid-photos row">
					
					@if(isset($images))
					@if(count($images) > 0)
					@foreach($images as $image)
					<li class="col-xs-6 col-sm-4 col-md-4">
						<div class="panel panel-default checkbox-panel photos">
							<div class="checkbox widget-checkbox">
							    <input class="checkbox-input" type="checkbox" id="{{ $image->id }}" value="{{ $image->id }}" name="{{ $image->id }}" v-model="selectedPhotos">
							    <label class="checkbox-label input-label" for="{{ $image->id }}"></label>
							</div>

							<div class="panel-body nopadding">
								<div class="widget-card preview">
									<div class="widget-card-bg">	
										<div class="photo-holder">
											<img src="{!! url('/album/'.$image->source) !!}" alt="{{ $image->name }}">
										</div>	
									</div>
									<div class="widget-card-project">
										<div class="bridge-text text-center ">
											<a data-sub-html="<h4>{{ $image->title }}</h4>" href="{!! url('/album/'.$image->source) !!}"  class="btn lightgallery-item btn-info btn-preview btn-sm"><i class="fa fa-search"></i> View Image</a>
										</div>
									</div>{{-- /widget-card-project --}}
								</div>
							</div>
						</div><!-- /panel -->
					</li>
					@endforeach
					@else
					<div class="alert alert-warning">
						{{ trans('messages.no_photos') }}
					</div>	
					@endif
					@else
					<div class="alert alert-warning">
						{{ trans('messages.no_photos') }}
					</div>	
					@endif
				</ul>
				</div>
		</div><!-- /col-md-10 -->
		
	</div>
</div><!-- /container -->
<script type="text/javascript">
	var photos = new Vue({
		el : '#allPhotos',
		data : {
			selectedPhotos : [],
			selectedAlbum: ''
		}
	});
</script>

<!-- /main-section -->