<!-- main-section -->
<div class="container">
	<div class="row">
		<div class="visible-lg col-lg-2">
			{!! Theme::partial('home-leftbar',compact('trending_tags')) !!}
		</div>
		<div class="col-md-10">
			@include('flash::message')
			<div class="album-panel" id="allPhotos">
				<div class="panel panel-default">
					<div class="panel-heading no-bg panel-settings">
						@if(Auth::user()->username == $album->timeline->username)
						<div class="side-right">
							
							<a href="{{ url('/'.Auth::user()->username.'/album/'.$album->id.'/edit') }}" class="btn btn-success">
								{{ trans('common.edit_album') }}
							</a>
							<a href="{{ url('/'.Auth::user()->username.'/album/'.$album->id.'/delete') }}" class="btn btn-danger">
								{{ trans('common.delete_album') }}
							</a>
						</div>
						@endif
						<h3 class="panel-title">
							{{ $album->name }}
							<span class="label label-info">{{ $album->privacy }}</span>
						</h3>
						<p>
							{{ $album->about }}
						</p><hr>
						@if((Auth::user()->username != $album->timeline->username) && $album->privacy == 'private')
							<div class="alert alert-warning">
								You can't view this album as its private
							</div>
						@else

						@if((Auth::user()->username == $album->timeline->username))
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
							</form>
						</div>
						@endif
					</div>
					<div class="panel-body">
						<ul id="video-thumbnails" class="list-unstyled grid-photos light-album row draggablePanelList">
							<?php $i = 1; ?>
							@foreach($album->photos as $photo)
								@if($photo->type == 'image')
									<li class="col-xs-12 col-sm-3 col-md-3" id="{{ $photo->id }}">
										<div class="panel panel-default checkbox-panel">
											@if((Auth::user()->username == $album->timeline->username))
											<div class="checkbox widget-checkbox">
											      <input class="checkbox-input" type="checkbox" id="{{ $photo->id }}" value="{{ $photo->id }}" name="{{ $photo->id }}" v-model="selectedPhotos">
											       <label class="input-label checkbox-label" for="{{ $photo->id }}"></label>
											</div>
											@endif
											<div class="panel-body nopadding">
												<div class="widget-card preview @if(Auth::user()->username != $album->timeline->username) hide-edit-remove @endif with-slim">
													<div class="widget-card-bg">	
														
														@if($album->preview_id != $photo->id && ((Auth::user()->username == $album->timeline->username)))
															<div class="photo_options">
																<a href="{{ url('/'.Auth::user()->username.'/album-preview/'.$album->id.'/'.$photo->id) }}" class="btn btn-success btn-sm">
																	{{ trans('common.set_as_preview') }}
																</a>
																<a href="{!! url('/album/'.$photo->source) !!}" class="btn btn-sm btn-lightgallery btn-primary">{{ trans('common.view_image') }}</a>
															</div>
															<img src="{!! url('/album/'.$photo->source) !!}"  class="btn btn-default btn-sm">
														@else
															<div class="photo_options">
																<a href="{!! url('/album/'.$photo->source) !!}" class="btn btn-sm btn-primary btn-lightgallery">{{ trans('common.view_image') }}</a>
															</div>
															<img src="{!! url('/album/'.$photo->source) !!}"  class="btn btn-default btn-sm">
														@endif
													
													</div>
												</div>
											</div>
										</div>
			          				</li>
								@else
									<li class="col-xs-12 col-sm-4 col-md-4">
										<div class="panel panel-default checkbox-panel">
											@if((Auth::user()->username == $album->timeline->username))
											<div class="checkbox widget-checkbox">
											      <input class="checkbox-input" type="checkbox" id="{{ $photo->id }}" value="{{ $photo->id }}" name="{{ $photo->id }}" v-model="selectedPhotos">
											       <label class="checkbox-label input-label" for="{{ $photo->id }}"></label>
											</div>
											@endif
											<div class="panel-body nopadding">
												<div class="widget-card preview @if(Auth::user()->username != $album->timeline->username) hide-edit-remove @endif with-slim">
													<div class="widget-card-bg">	
														<div class="photo_options">
															<a href="https://www.youtube.com/watch?v={{ $photo->source }}" class="btn-lightgallery"><i class="fa fa-search"></i></a>
														</div>
														<img src="https://www.youtube.com/watch?v={{ $photo->source }}"  class="btn btn-default btn-sm">
													</div>
												</div>
	               							</div>
	               						</div>
	                        		</li>
								@endif
                        	@endforeach
                    	</ul>
                    	
					</div><!-- /panel-body -->
				</div>
				@endif
			</div>
		</div><!-- /col-md-10 -->
	</div>

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