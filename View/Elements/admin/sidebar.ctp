	
	<?php if(!isset($menu)) $menu='customer' ; if(!isset($menu2)) $menu2=""?>
	<ul class="nav nav-list">
	
	                    
					 
						
						<?php if($this->Session->read('Auth.User.role')=='admin'): ?>
						
				
						
						<!--li  class="active"  >
							<a href="<?php echo $this->Html->url(array('action'=>'merk')) ?>">
								<i class="fa fa-list-alt fa-fw fa-lg"></i>
								<span class="menu-text"> Merk & Type </span>
							</a>
						 
							    <ul class="submenu">
								<li class="active">
									<a  href="#">Type</a>
								</li>
								</ul>
							 
						</li-->
						
						<li <?php if($menu=='banner'): ?>class="active" <?php endif; ?>>
							<a href="<?php echo $this->Html->url(array('action'=>'banner')) ?>">
								<i class="fa fa-desktop fa-fw fa-lg"></i>
								<span class="menu-text"> Banner</span>
							</a>
						</li>
						
						<li <?php if($menu=='products'): ?>class="active" <?php endif; ?>>
							<a href="<?php echo $this->Html->url(array('action'=>'products')) ?>">
								<i class="fa fa-list fa-fw fa-lg"></i>
								<span class="menu-text"> Products</span>
							</a>
						</li>
						
						<li <?php if($menu=='solution'): ?>class="active" <?php endif; ?>>
							<a href="<?php echo $this->Html->url(array('action'=>'solution')) ?>">
								<i class="fa fa-puzzle-piece fa-fw fa-lg"></i>
								<span class="menu-text"> Find Solution</span>
							</a>
						</li>
						
						<li <?php if($menu=='news'): ?>class="active" <?php endif; ?>>
							<a href="<?php echo $this->Html->url(array('action'=>'generalnews')) ?>">
								<i class="fa fa-pencil fa-fw fa-lg"></i>
								<span class="menu-text"> News</span>
							</a>
						</li>
            
            <li <?php if($menu=='promo'): ?>class="active" <?php endif; ?>>
              <a href="<?php echo $this->Html->url(array('action'=>'promo')) ?>">
                <i class="fa fa-list-alt fa-fw fa-lg"></i>
                <span class="menu-text"> Promo Management</span>
              </a>
            </li>
						
						<li <?php if($menu=='reportchat'): ?>class="active" <?php endif; ?>>
							<a href="<?php echo $this->Html->url(array('action'=>'reportchat')) ?>">
								<i class="fa fa-list-alt fa-fw fa-lg"></i>
								<span class="menu-text">Report LiveChat</span>
							</a>
						</li>


					
						
						
						<?php endif; ?>


						
		</ul>