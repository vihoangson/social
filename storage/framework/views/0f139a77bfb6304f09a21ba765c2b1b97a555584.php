<!-- main-section -->

<div class="container">
	<div class="row">
		<div class="col-md-10">
			<?php echo Theme::partial('user-header',compact('timeline','user','followRequests','following_count',
			'followers_count','follow_confirm','user_post','joined_groups_count','guest_events')); ?>

			
			<div class="row">
				<div class=" timeline">
					<div class="col-md-4">
						<?php echo Theme::partial('user-leftbar',compact('timeline','user','follow_user_status','own_pages','own_groups','user_events')); ?>

					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading no-bg panel-settings">
								<h3 class="panel-title">
									<?php echo e(trans('common.pages_liked')); ?>

								</h3>
							</div>
							<div class="panel-body">

								<?php if(count($liked_pages) > 0): ?>
								<ul class="list-group page-likes">
									<?php $__currentLoopData = $liked_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="list-group-item holder">
										<div class="connect-list ">
											<div class="connect-link side-left">
												<a href="<?php echo e(url($page->username)); ?>">
													<?php if($page->avatar != NULL): ?>
													<img src="<?php echo e(url('page/avatar/'.$page->avatar)); ?>" alt="<?php echo e($page->name); ?>" title="<?php echo e($page->name); ?>">
													<?php else: ?>
													<img src="<?php echo e(url('page/avatar/default-page-avatar.png')); ?>" alt="<?php echo e($page->name); ?>" title="<?php echo e($page->name); ?>">
													<?php endif; ?>
													<?php echo e($page->name); ?>

												</a>
												<?php if($page->verified): ?>
									              <span class="verified-badge bg-success">
									                    <i class="fa fa-check"></i>
									                </span>
									            <?php endif; ?>
											</div>

											<?php if($timeline->id == Auth::user()->timeline_id): ?>
												<div class="page-links side-right">
													<?php if($page->likes->contains(Auth::user()->id)): ?>
													<div class="left-col">
														<a href="#" class="btn btn-success page-liked pageliked " data-timeline-id="<?php echo e($page->timeline_id); ?>">
															<i class="fa fa-check"></i> <?php echo e(trans('common.liked')); ?>

														</a>
													</div>

													<div class="left-col hidden">
														<a href="#" class="btn btn-default page-liked pagelike" data-timeline-id="<?php echo e($page->timeline_id); ?>">	<i class="fa fa-thumbs-up"></i> <?php echo e(trans('common.like')); ?>

														</a>
													</div>
													<?php endif; ?>

												</div>
											<?php endif; ?>
											<div class="clearfix"></div>
										</div>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>

								<?php else: ?>
								<div class="alert alert-warning"><?php echo e(trans('messages.no-liked-pages')); ?></div>
								<?php endif; ?>

							</div><!-- /panel-body -->
						</div>
					</div><!-- /col-md-8 -->
				</div><!-- /main-content -->
			</div><!-- /row -->
		</div><!-- /col-md-10 -->

		<div class="col-md-2">
			<?php echo Theme::partial('timeline-rightbar'); ?>

		</div>

	</div>
</div><!-- /container -->

