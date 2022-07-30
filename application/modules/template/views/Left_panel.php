<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <!-- <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>images/logo2.png" alt="Logo"></a> -->
        </div>
        <h3 class="menu-title">MENU</h3><!-- /.menu-title -->
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo base_url().'homepage/dashboard';?>"> 
                    <i class="menu-icon fa fa-dashboard"></i> Daftar Jembatan </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'jembatan/view/tambah_data';?>" > <i class="menu-icon fa fa-table"></i> Tambah Data Jembatan </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'jembatan/view/skor_prioritas';?>" > <i class="menu-icon fa fa-laptop"></i> Daftar Skor Prioritas </a>
                </li>
                <?php 
                /*if(($userlevel == '1') || ($userlevel == '2'))
                {
                ?>
                    <li>
                        <a href="<?php echo base_url().'marketing/dashboard';?>"> 
                        <i class="menu-icon fa fa-dashboard"></i> Marketing Dashboard </a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Create Acara</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="<?php echo base_url().'marketing/acara/create_seminar';?>">Seminar</a></li>
                            <li><a href="<?php echo base_url().'marketing/acara/create_talkshow';?>">Talkshow</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="<?php echo base_url().'marketing/acara/list_of_acara';?>" > <i class="menu-icon fa fa-table"></i> Daftar Acara</a>
                    </li>
                    
                <?php
                }
                ?>
            
                <?php
                if(($userlevel == '1') || ($userlevel == '3'))
                {
                ?>
                    <li class="active">
                        <a href="dashboard.html"> <i class="menu-icon fa fa-dashboard"></i> Support Dashboard </a>
                    </li>
                    <li>
                        <a href="list-of-distributors.html"> <i class="menu-icon fa fa-table"></i> Distributors Handled</a>                       
                    </li>
                    <li>
                        <a href="list-of-campaigns.html" > <i class="menu-icon fa fa-table"></i>Daftar Acara</a>
                    </li>
					<li>
                        <a href="create-conduct-training.html" > <i class="menu-icon fa fa-laptop"></i> Create Training</a>
                    </li>
					<li>
                        <a href="pendaftaran-training.html" > <i class="menu-icon fa fa-laptop"></i> Pendaftaran Training</a>
                    </li>
					<li>
                        <a href="list-of-conduct-training.html" > <i class="menu-icon fa fa-table"></i> List of Training</a>
                    </li>
					<li>
                        <a href="pencarian.html" > <i class="menu-icon fa fa-table"></i> Pencarian</a>
                    </li>
                <?php
                }
                ?>
                
                <?php
                if(($userlevel == '1') || ($userlevel == '4'))
                {
                ?>
                    <li class="active">
                        <a href="dashboard.html"> <i class="menu-icon fa fa-dashboard"></i> Order Dashboard </a>
                    </li>
                    <li>
                        <a href="penjualan-1.html"> <i class="menu-icon fa fa-laptop"></i> Penjualan</a>
					</li>
					<li>
                        <a href="invoice-pending.html" > <i class="menu-icon fa fa-table"></i> Invoice Pending</a>
                    </li>
                    <li>
                        <a href="buy-back.html" > <i class="menu-icon fa fa-table"></i> Buy Back</a>
                    </li>
					
					<li>
                        <a href="buy-back-pending.html" > <i class="menu-icon fa fa-table"></i> Buy Back Pending</a>
                    </li>
					<li>
                        <a href="po-jsg.html" > <i class="menu-icon fa fa-table"></i> PO ke JSG</a>
                    </li>
					<li>
                        <a href="po-jsg-pending.html" > <i class="menu-icon fa fa-table"></i> PO JSG Pending</a>
                    </li>
					<li>
                        <a href="list-titip.html" > <i class="menu-icon fa fa-table"></i> List Titip Emas</a>
                    </li>
					
                <?php
                }*/
                ?>
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->