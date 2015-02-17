<body>
<div class="navbar main hidden-print">
	
		<div class="container">
			<div class="row">
				<div class="span12 relativeWrap">
				
					<button type="button" class="btn btn-navbar visible-phone">
						<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
					</button>
		
					<ul id="menu" class="hidden-phone">
						<li <?php if('nasabah'==$this->uri->segment(2)) echo 'class="active"';?>>
							<a href="<?php echo site_url('main/nasabah')?>" class="menuToggle">Anggota</a>
						</li>
						<li <?php if('simpanan'==$this->uri->segment(2)) echo 'class="active"';?>>
							<a href="<?php echo site_url('main/simpanan')?>" class="menuToggle">Simpanan</a>
						</li>
						<li <?php if('pinjaman'==$this->uri->segment(2)) echo 'class="active"';?>>
							<a href="<?php echo site_url('main/pinjaman')?>" class="menuToggle">Pinjaman</a>
						</li>
						<!-- <li <?php if('payroll'==$this->uri->segment(2)) echo 'class="active"';?>>
							<a href="<?php echo site_url('main/payroll')?>" class="menuToggle">Adjust Payroll</a>
						</li> -->
						<?php if($this->session->userdata('level')=="admin"){?>
						<li <?php if('user'==$this->uri->segment(2)) echo 'class="active"';?>><a href="<?php echo site_url('main/user')?>"><span>Admin</span></a></li>
						<?php } ?>
						<!-- <li>
							<a href="#" class="menuToggle">Pengaturan</a>
							<ul class="menu hide">
								<li class=""><a href="<?php echo site_url('main/kelas')?>"><span>Kelas</span></a></li>
								<li class=""><a href="<?php echo site_url('main/akunting')?>"><span>Akunting</span></a></li>
								<li class=""><a href="<?php echo site_url('main/kop')?>"><span>Kop Profil</span></a></li>
								<?php if($this->session->userdata('level')=="admin"){?><li class=""><a href="<?php echo site_url('main/user')?>"><span>Admin</span></a></li>
								<?php } ?>
							</ul>
						</li> -->
						<!-- <li class="hidden-phone">
							<a href="#themer" data-toggle="collapse"><span>Tema</span></a>
							<div id="themer" class="collapse">
								<div class="wrapper">
									<span class="close2">&times; close</span>
									<h4>Themer <span>color</span></h4>
									<ul>
										<li>Theme: <select id="themer-theme" class="pull-right"></select><div class="clearfix"></div></li>
										<li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" /><div class="clearfix"></div></li>
										<li>
											<span class="link" id="themer-custom-reset">reset theme</span>
											<span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
										</li>
									</ul>
									<div id="themer-getcode" class="hide">
										<div class="separator"></div>
										<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
										<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</li> -->
					</ul>
					
					<span class="profile">
						<span>
							<strong><?php echo $this->session->userdata('nama')?></strong>
							<a href="<?php echo site_url('main/logout')?>">Keluar</a>
						</span>
						<!-- <a class="img" href="form_demo.html"><img src="http://www.placehold.it/74x74/232323&text=photo" alt="Mr. Awesome" /></a> -->
					</span>
					
				</div>
			</div>
		</div>
	</div>
