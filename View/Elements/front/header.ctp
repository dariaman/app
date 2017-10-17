
<header >
	<!-- <div class="top-blue">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
          <img src="<?php echo $this->Html->url("/"); ?>img/hubungi-kami-header.png" alt="header" class="img-responsive hub-cs-header" />
                    <!--<ul class="list-inline hidden-xs hidden-sm">
                      <li><img src="<?php echo $this->Html->url("/"); ?>img/blank-header.png" alt="header" class="img-responsive" /></li>
                      <li><img src="<?php echo $this->Html->url("/"); ?>img/hubungi-kami-header.png" alt="header" class="img-responsive" /></li>
                    </ul>
                    <center><img src="<?php echo $this->Html->url("/"); ?>img/hubungi-kami-header.png" alt="header" class="img-responsive visible-xs visible-sm" /></center>-->
                    <!--<ul class="list-inline socmedtop hidden-xs hidden-sm">
                        <li><a href="https://www.facebook.com/jagadiri.id" target="_blank"><img src="<?php echo $this->Html->url("/"); ?>img/fbtop.png" /></a></li>
                        <li><a href="https://twitter.com/jagadiri_id" target="_blank"><img src="<?php echo $this->Html->url("/"); ?>img/twtop.png" /></a></li>
                        <li><a href="https://www.linkedin.com/company/central-asia-financial-jagadiri-?trk=top_nav_home" target="_blank"><img src="<?php echo $this->Html->url("/"); ?>img/linktop.png" /></a></li>
                        <li><a href="https://plus.google.com/u/0/101306468770870955346/posts" target="_blank"><img src="<?php echo $this->Html->url("/"); ?>img/g+top.png" /></a></li>
                        <li><a href="https://www.youtube.com/channel/UCQowOi2neuZgNH4sBaznajg" target="_blank"><img src="<?php echo $this->Html->url("/"); ?>img/youtop.png" /></a></li>
                    </ul>
                </div> 
			</div>
		</div>
	</div> -->
	<div class="container paddingtop">
		<div class="col-md-3">
			<div class="logo">
				<center><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>"><img src="<?php echo $this->Html->url("/");?>img/logo.png" alt="Asuransi Jaga Diri" class="logo img-responsive" /></a></center>
			</div>
		</div>
		<div class="col-sm-12 col-md-9">
			<!-- Extra components navbar -->
			<div class="navbar yamm">
				<div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					<a class="navbar-brand hidden-sm hidden-md hidden-lg">MENU</a>
				</div>
				<div id="navbar-collapse-grid" class="navbar-collapse collapse">
					<ul class="log nav navbar-nav navbar-right">
						<li>
							<?php if($this->Session->check('Auth.User')): ?>
							<h2 class="title-akses text-center">
								Welcome, <?php echo $this->Session->read('Auth.User.CustomerName'); ?>
							</h2>
							<center>
								<a class="btn btn-default" href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'logout')); ?>">
								Logout
								</a>
							</center>
							<?php else: ?>
								<center><a href="http://system.jagadiri.co.id/Selfcare" target="_blank" class="btn btn-default" id="loginbtn">LOGIN Selfcare</a></center>
							<?php endif; ?>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'home'))?>"><br /><span class="peach-color">Beranda</span>
							</a>
						</li>
						<li class="hidden-xs dropdown yamm-fw">
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product')) ?>" class="dropdown-toggle">Pilihan <br /><span class="peach-color">Produk<b class="caret"></b></span></a>
							<ul class="dropdown-menu multi-level">

								<!--<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'general'))?>" class="drop-plus dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="Plus" /> List</a>
									<ul class="dropdown-menu">
													<li class="dropdown-submenu">
															<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>" class="drop-kes dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" alt="Kesehatan" /> Kesehatan</a>
															<ul class="dropdown-menu">
																<li>
																	<ul class="productname">
																		<div class="dmenu-kes">
																			<ul>
																			<?php if(isset($_menu)): foreach ($_menu['health'] as $p3): ?>
																				<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p3['Product']['seo']))?>"><?php echo $p3['Product']['name'] ?></a></li>
																			<?php endforeach; endif; ?>
																			</ul>
																		</div>
																	</ul>
																</li>
															</ul>
														</li>
														<li class="dropdown-submenu">
															<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>" class="drop-jiwa dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/jiwa.png" alt="Jiwa" /> Jiwa</a>
															<ul class="dropdown-menu">
																<li>
																	<ul class="productname">
																		<div class="dmenu-jiwa">
																			<ul>
																			<?php if(isset($_menu)): foreach ($_menu['life'] as $p2): ?>
																				<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p2['Product']['seo']))?>"><?php echo $p2['Product']['name'] ?></a>
																				</li>
																			<?php endforeach; endif;?>
																			</ul>
																		</div>
																	</ul>
																</li>
															</ul>
														</li>
														<li class="dropdown-submenu">
															<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>" class="drop-kec dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kecelakaan.png" alt="Kecelakaan" /> Kecelakaan</a>
															<ul class="dropdown-menu">
																<li>
																	<ul class="productname">
																		<div class="dmenu-kec">
																			<ul>
																			<?php if(isset($_menu)): foreach ($_menu['accidental'] as $p1): ?>
																				<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p1['Product']['seo']))?>"><?php echo $p1['Product']['name'] ?></a></li>
																			<?php endforeach; endif;?>
																			</ul>
																		</div>
																	</ul>
																</li>
															</ul>
														</li>
														<li class="dropdown-submenu">
															<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>" class="drop-plus dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="Plus" /> Plus Investasi</a>
															<ul class="dropdown-menu">
																<li>
																	<ul class="productname">
																		<div class="dmenu-plus">
																			<ul>
																			<?php if(isset($_menu)): foreach ($_menu['unitlink'] as $p4): ?>
																				<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p4['Product']['seo']))?>"><?php echo $p4['Product']['name'] ?></a></li>
																			<?php endforeach; endif;?>
																			</ul>
																		</div>
																	</ul>
																</li>
															</ul>
														</li>
												
												
									</ul>
								</li>-->
								

								<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>" class="drop-kes dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" alt="Kesehatan" /> Kesehatan</a>
									<ul class="dropdown-menu">
										<li>
											<ul class="productname">
												<div class="dmenu-kes">
													<ul>
													<?php if(isset($_menu)): foreach ($_menu['health'] as $p3): ?>
														<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p3['Product']['seo']))?>"><?php echo $p3['Product']['name'] ?></a></li>
													<?php endforeach; endif; ?>
													</ul>
												</div>
											</ul>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>" class="drop-jiwa dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/jiwa.png" alt="Jiwa" /> Jiwa</a>
									<ul class="dropdown-menu">
										<li>
											<ul class="productname">
												<div class="dmenu-jiwa">
													<ul>
													<?php if(isset($_menu)): foreach ($_menu['life'] as $p2): ?>
														<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p2['Product']['seo']))?>"><?php echo $p2['Product']['name'] ?></a>
														</li>
													<?php endforeach; endif;?>
													</ul>
												</div>
											</ul>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>" class="drop-kec dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/kecelakaan.png" alt="Kecelakaan" /> Kecelakaan</a>
									<ul class="dropdown-menu">
										<li>
											<ul class="productname">
												<div class="dmenu-kec">
													<ul>
													<?php if(isset($_menu)): foreach ($_menu['accidental'] as $p1): ?>
														<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p1['Product']['seo']))?>"><?php echo $p1['Product']['name'] ?></a></li>
													<?php endforeach; endif;?>
													</ul>
												</div>
											</ul>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>" class="drop-plus dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="Plus" /> Plus Investasi</a>
									<ul class="dropdown-menu">
										<li>
											<ul class="productname">
												<div class="dmenu-plus">
													<ul>
													<?php if(isset($_menu)): foreach ($_menu['unitlink'] as $p4): ?>
														<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p4['Product']['seo']))?>"><?php echo $p4['Product']['name'] ?></a></li>
													<?php endforeach; endif;?>
													</ul>
												</div>
											</ul>
										</li>
									</ul>
								</li>

								<!--<li class="dropdown-submenu">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'general'))?>" class="drop-plus dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" alt="Plus" /> Umum</a>
									<ul class="dropdown-menu">
										<li>
											<ul class="productname">
												<div class="dmenu-plus">
													<ul>
													<?php if(isset($_menu)): foreach ($_menu['general'] as $p5): ?>
														<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p5['Product']['seo']))?>"><?php echo $p5['Product']['name'] ?></a></li>
													<?php endforeach; endif;?>
													</ul>
												</div>
											</ul>
										</li>
									</ul>
								</li>-->

							</ul>
						</li>
						<!-- Thumbnails demo -->
						<!-- 
						<li class="hidden-xs dropdown yamm-fw">
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product')) ?>" class="dropdown-toggle">Pilihan <br /><span class="peach-color">Produk<b class="caret"></b></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="yamm-content">
										<div class="row">
											<div class="col-sm-3">
												<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/acciden-icon.png" /></center>
													<h3 class="dorp-title">Accidental <b class="hidden-sm caret"></b></h3>
												</a>
												<ul class="productname">

													<?php if(isset($_menu)): foreach ($_menu['accidental'] as $p1): ?>
													<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p1['Product']['seo']))?>"><?php echo $p1['Product']['name'] ?></a></li>
												<?php endforeach; endif;?>
											</ul>
										</div>
										<div class="col-sm-3">
											<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>"> <center><img src="<?php echo $this->Html->url("/");?>img/life-icon.png" /></center>
												<h3 class="dorp-title">Life <b class="hidden-sm caret"></b></h3>
											</a>
											<ul class="productname">
												<?php if(isset($_menu)): foreach ($_menu['life'] as $p2): ?>
												<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p2['Product']['seo']))?>"><?php echo $p2['Product']['name'] ?></a>
												</li>
											<?php endforeach; endif;?>
										</ul>
									</div>
									<div class="col-sm-3">
										<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/health-icon.png" /></center>
											<h3 class="dorp-title">Health <b class="hidden-sm caret"></b></h3>
										</a>
										<ul class="productname">
											<?php if(isset($_menu)): foreach ($_menu['health'] as $p3): ?>
											<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p3['Product']['seo']))?>"><?php echo $p3['Product']['name'] ?></a></li>
										<?php endforeach; endif; ?>
									</ul>
								</div>
								<div class="col-sm-3">
									<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/link-icon.png" /></center>
										<h3 class="dorp-title">Unit Link <b class="hidden-sm caret"></b></h3>
									</a>
									<ul class="productname">
										<?php if(isset($_menu)): foreach ($_menu['unitlink'] as $p4): ?>
										<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p4['Product']['seo']))?>"><?php echo $p4['Product']['name'] ?></a></li>
									<?php endforeach; endif;?>
								</ul>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</li>-->
					<li class="hidden-sm hidden-md hidden-lg">
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product')) ?>">Pilihan <br /><span class="peach-color">Produk<b class="caret"></b></span></a>
					</li>
					<li class="hidden-sm hidden-md hidden-lg">
								
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'health'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/icon-product/kesehatan.png" /></center>
								<h3 class="dorp-title">Kesehatan <b class="hidden-sm caret"></b></h3>
							</a>
							<ul class="productname">
								<?php if(isset($_menu)): foreach ($_menu['health'] as $p3): ?>
								<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p3['Product']['seo']))?>"><?php echo $p3['Product']['name'] ?></a></li>
								<?php endforeach; endif; ?>
							</ul>
													
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'life'))?>"> <center><img src="<?php echo $this->Html->url("/");?>img/icon-product/jiwa.png" /></center>
								<h3 class="dorp-title">Jiwa <b class="hidden-sm caret"></b></h3>
							</a>
							<ul class="productname">
								<?php if(isset($_menu)): foreach ($_menu['life'] as $p2): ?>
								<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p2['Product']['seo']))?>"><?php echo $p2['Product']['name'] ?></a>
								</li>
								<?php endforeach; endif;?>
							</ul>
							
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'accidental'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/icon-product/kecelakaan.png" /></center>
									<h3 class="dorp-title">Kecelakaan <b class="hidden-sm caret"></b></h3>
							</a>
							<ul class="productname">
								<?php if(isset($_menu)): foreach ($_menu['accidental'] as $p1): ?>
								<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p1['Product']['seo']))?>"><?php echo $p1['Product']['name'] ?></a></li>
								<?php endforeach; endif;?>
							</ul>
											
							<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product','#'=>'unit'))?>"><center><img src="<?php echo $this->Html->url("/");?>img/icon-product/plus.png" /></center>
								<h3 class="dorp-title">Plus Investasi <b class="hidden-sm caret"></b></h3>
							</a>
							<ul class="productname">
								<?php if(isset($_menu)): foreach ($_menu['unitlink'] as $p4): ?>
								<li><a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'productdetail','id'=>$p4['Product']['seo']))?>"><?php echo $p4['Product']['name'] ?></a></li>
								<?php endforeach; endif;?>
							</ul>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'temukansolusi'))?>">Temukan <br /><span class="peach-color">Solusi</span></a>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'tentangjagadiri'))?>">Tentang <br /><span class="peach-color">Kami</span></a>
					</li>
					<li>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi'))?>">Tentang <br /><span class="peach-color">Asuransi</span></a>
					</li>
					<!--<li>
						<a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'serbaserbi'))?>"><br /><span class="peach-color">Promo</span></a>
					</li>-->
					
						<li class="hidden-xs dropdown yamm-fw">
							<a href="#" class="dropdown-toggle"><br /><span class="peach-color">Unduh<b class="caret"></b></span></a>
							<!-- <a href="<?php echo $this->Html->url(array('controller'=>'front','action'=>'product')) ?>" class="dropdown-toggle"> <br /><span class="peach-color">News<b class="caret"></b></span></a> -->
							<ul class="downdownload dropdown-menu multi-level" style="padding:5px">
								<li><a href="<?php echo $this->Html->url("/download/Daftar_RS_Rekanan.pdf"); ?>">Daftar RS Rekanan JSP</a></li>
								<li><a href="<?php echo $this->Html->url("/download/Daftar_RS_Rekanan_JSK.pdf"); ?>">Daftar RS Rekanan JSK</a></li>
		                        <li><a href="<?php echo $this->Html->url("/download/Merchant_List.pdf"); ?>">Daftar Program Diskon</a></li>		                        
		                        <li><a href="<?php echo $this->Html->url("/download/FORM_KLAIM_MENINGGAL.pdf"); ?>">Form Klaim Meninggal</a></li>
		                        <li><a href="<?php echo $this->Html->url("/download/FORM_KLAIM_RUMAH_SAKIT.pdf"); ?>">Form Klaim Rumah Sakit</a></li>
		                        <li><a href="<?php echo $this->Html->url("/download/FORM_KLAIM_JAGA_MOTORKU.pdf"); ?>">Form Klaim Jaga MotorKu</a></li>
								<li><a href="<?php echo $this->Html->url("/download/CAF_Pengumuman_LK_Q2_2017.pdf"); ?>">Laporan Keuangan Triwulan</a></li>
		                        <li><a href="<?php echo $this->Html->url("/download/CAF_Pengumuman_LK_2015.pdf"); ?>">Laporan Keuangan Tahunan</a></li>
								<!-- <?php 
									if(isset($_news)): foreach ($_news as $news): ?> 
									<li>
										<div class="news-list">
											<div class="date-news">
												<?php $day = date("d",strtotime($news['News']['created'])); ?>
												<?php $month = date("m",strtotime($news['News']['created'])); 
														$mon = $_mons[(int)$month];
														$remp = array("<p>","</p>");
												?>
												<h4><?php echo $day ; ?></h4>
												<h5><?php echo $mon; ?></h5>
											</div>
											<div class="title-news">
												<a href="<?php echo str_replace($remp, "", $news['News']['content']) ; ?>" target="_blank"><?php echo $news['News']['title'] ; ?></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
								<?php endforeach; endif;?> -->
							</ul>
						</li>
					<li class="mob-log">
							<?php if($this->Session->check('Auth.User')): ?>
							<h2 class="title-akses text-center">
								Welcome, <?php echo $this->Session->read('Auth.User.CustomerName'); ?>
							</h2>
							<center>
								<a class="btn btn-default" href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'logout')); ?>">
								Logout
								</a>
							</center>
							<?php else: ?>
								<center><a href="http://system.jagadiri.co.id/Selfcare" target="_blank" class="btn btn-default" id="loginbtn">LOGIN<br>Selfcare</a></center>
							<?php endif; ?>
						</li>
				</ul>
</div>
</div>
</div>
<!--<div class="col-sm-2 col-md-2">
	<?php if($this->Session->check('Auth.User')): ?>
	
		
			<h2 class="title-akses text-center">
				Welcome, <?php echo $this->Session->read('Auth.User.CustomerName'); ?>
			</h2>
		<center>
		<a class="btn btn-default" href="<?php echo $this->Html->url(array('controller' => 'front', 'action' => 'logout')); ?>">
		Logout
		</a>
		
	</center>
<?php else: ?>
	<center><a href="http://system.jagadiri.co.id/Selfcare" target="_blank" class="btn btn-default" id="loginbtn">LOGIN</a></center>
<?php endif; ?>
</div>-->
</div>
</header>
<script>
	// jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if($('header').offset().top > 80) {
			$("header").addClass("hide-m");
		} else {
			$("header").removeClass("hide-m");
		}	
	});
</script>
