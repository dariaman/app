
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-share"></i>
								<?php echo $headline; ?>
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav aqi-nav">
					
						<li class="aqi">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								Welcome, <?php echo $this->Session->read('Auth.User.name'); ?>					

								<i class="fa fa-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo $this->Html->url(array('controller'=>'adm','action'=>'logout')); ?>">
										<i class="fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		