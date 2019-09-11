<?php
$group_id = $this->session->userdata('group_id');
if (isset($userrecord))
{
	foreach($userrecord AS $row)
	{
		?>
	<!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
			<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 296px;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
            <!--li class="header"></li-->
            	<?php
			if($group_id == '10' OR $group_id == '11' )
			{
			?>
			<li>
              <a href="<?php echo base_url();?>production">
                <i class="fa fa-dashboard"></i> <span>Production</span>
              </a>
            </li>
			<?php
			}

			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '99')
			{
			?>
			<li>
              <a href="<?php echo base_url();?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Beranda</span>
              </a>
            </li>
			<?php
			}
			if($group_id == '12' OR $group_id == '13')
			{
				if($this->session->userdata('open_shift') == '' AND $this->session->userdata('closed_shift') == '')
				{
			?>
            <li>
              <a href="<?php echo base_url();?>cashier/mbarang">
                <i class="fa fa-credit-card"></i> <span>Barang</span>
              </a>
            </li>
						<li>
              <a href="<?php echo base_url();?>cashier/transaksi">
                <i class="fa fa-credit-card"></i> <span>Transaksi</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>cashier/laptransaksi">
                <i class="fa fa-credit-card"></i> <span>Laporan</span>
              </a>
            </li>
			<?php
				}
			}
			if($group_id == '15' or $group_id == '14' or $group_id == '17' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '7' OR $group_id == '99')
			{
				if($this->session->userdata('open_shift') == '' AND $this->session->userdata('closed_shift') == '')
				{
                ?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-credit-card"></i> <span>Transaksi</span>
								<i class="fa fa-angle-left pull-right"></i>
              </a>
							<ul class="treeview-menu">
									<li>
										<a href="<?php echo base_url();?>order">
											<i class="fa fa-circle-o"></i> <span>Pesanan Baru</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>transaction">
											<i class="fa fa-circle-o"></i> <span>Riwayat Transaksi</span>
										</a>
									</li>
									<?php
									if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '99')
									{
									?>
									<li>
										<a href="<?php echo base_url();?>report/transaction">
											<i class="fa fa-circle-o"></i> <span>Laporan Transaksi</span>
										</a>
									</li>
									<?php
									}
									?>
							</ul>
            </li>
            <li>
              <a href="<?php echo base_url();?>customer/all">
                <i class="fa fa-user"></i> <span>Pelanggan</span>
              </a>
			 </li>
			<?php
				}
			}
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99' OR $group_id == '14' OR $group_id == '15' OR $group_id == '16' OR $group_id == '18')
			{
				if($this->session->userdata('open_shift') == '' AND $this->session->userdata('closed_shift') == '')
				{
			?>
            <li>
              <a href="<?php echo base_url();?>product">
                <i class="fa fa-list-ul"></i> <span>Produk</span>
              </a>
            </li>
			<?php
				}
			}
			?>
			<?php
			if($group_id == '18' or $group_id == '11' or $group_id == '10' or $group_id == '16' or $group_id == '14' OR $group_id == '15' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99')
			{
			?>
			<li class="treeview" id='pch'>
				<a href="#">
					<i class="fa fa-th"></i> <span>Pembelian</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php
					if($group_id == '18' or $group_id == '11' or $group_id == '10' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99')
					{
					?>
					<?php
					}
					if($group_id == '18' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' or $group_id == '4' OR $group_id == '8' OR $group_id == '99')
					{
					?>
					<li class="treeview">
						<a href="<?php echo base_url();?>purchase/po_list">
							<i class="fa fa-circle-o"></i> <span>PO</span>
						</a>
					</li>
					<?php
					}
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '99')
					{
					?>
					<li class="treeview">
						<a href="<?php echo base_url();?>supplier">
							<i class="fa fa-circle-o"></i> <span>Pemasok</span>
						</a>
					</li>
					<?php
					}
					if($group_id == '18' or $group_id == '16' or $group_id == '14' OR $group_id == '15' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
					{
					?>
					<li class="treeview" id="mt">
						<a href="<?php echo base_url();?>material">
							<i class="fa fa-circle-o"></i> <span>Material</span>
						</a>
					</li>
					<?php }?>
					<?php
					if($group_id == '14' OR $group_id == '16' OR $group_id == '18' or $group_id == '10' or $group_id == '11' or $group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99')
					{
					?>
		        <li>
		          <a href="<?php echo base_url();?>logistic">
		          	<i class="fa fa-circle-o"></i> <span>Inventori</span>
		          </a>
		        </li>
					<?php
					}
					?>
				</ul>
      </li>
			<?php
			}
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '8' OR $group_id == '18' OR $group_id == '99')
			{
			?>
			<?php
			}
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '18' OR $group_id == '99')
			{
			?>
			<li class="treeview<?php if ($this->uri->segment(1) == 'hr') echo " active";?>">
              <a href="#">
                <i class="fa fa-users"></i> <span>Kepegawaian</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
			  <ul class="treeview-menu">
                <?php
                if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
                {
                ?>
				<li class="treeview">
					<a href="<?php echo base_url();?>hr/employee">
						<i class="fa fa-circle-o"></i><span>Karyawan</span>
					</a>
				</li>
				<li class="treeview">
					<a href="<?php echo base_url();?>hr/salary">
						<i class="fa fa-circle-o"></i> <span>Gaji</span>
					</a>
				</li>
                <?php }?>
                <?php
                if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '18' OR $group_id == '99')
                {
                ?>
				<li class="treeview">
					<a href="<?php echo base_url();?>hr/attendance_all">
						<i class="fa fa-circle-o"></i> <span>Absensi</span>
					</a>
				</li>
                <?php }?>
                <?php
                if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
                {
                ?>
				<li class="treeview">
					<a href="<?php echo base_url();?>hr/config">
						<i class="fa fa-circle-o"></i> <span>Pengaturan</span>
					</a>
				</li>
                <?php }?>
              </ul>
            </li>
			<?php
			}
			if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
			{
			?>
			<li class="treeview<?php if ($this->uri->segment(1) == 'finance') echo " active";?>">
              <a href="#">
                <i class="glyphicon glyphicon-usd"></i> <span>Keuangan</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
			  <ul class="treeview-menu">
					<li>
					  <a href="<?php echo base_url();?>finance/se_summary">
						<i class="glyphicon glyphicon-check"></i> <span>Rekap Kasir</span>
					  </a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url();?>finance/general_journal">
							<i class="fa fa-circle-o"></i> <span>Jurnal Umum</span>
						</a>
					</li>
					<!--li class="treeview">
						<a href="<?php echo base_url();?>finance/adjusting_journal">
							<i class="fa fa-circle-o"></i> <span>Jurnal Penyesuaian</span>
						</a>
					</li-->
					<li class="treeview">
						<a href="<?php echo base_url();?>finance/balance_sheet">
							<i class="fa fa-circle-o"></i> <span>Buku Besar</span>
						</a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url();?>finance/account">
							<i class="fa fa-circle-o"></i> <span>Daftar Akun</span>
						</a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url();?>finance/balance_start">
							<i class="fa fa-circle-o"></i> <span>Saldo Awal</span>
						</a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url();?>finance/tax_profile">
							<i class="fa fa-circle-o"></i> <span>Data Wajib Pajak</span>
						</a>
					</li>
				</ul>
      </li>
		<?php } ?>
			<?php if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8'
			OR $group_id == '9' OR $group_id == '99' OR $group_id == '18' OR $group_id=='16' or $group_id =='14')
			{
			?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-line-chart"></i> <span>Laporan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
					{
					?>
					<?php
					}
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '8' OR $group_id == '9' OR $group_id == '99' )
					{
					?>
					<li>
						<a href="<?php echo base_url();?>report/sales">
							<i class="fa fa-circle-o"></i> <span>Penjualan</span>
						</a>
					</li>
					<?php
					}
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
					{
					?>
					<li>
						<a href="<?php echo base_url();?>transaction/services_time">
							<i class="fa fa-circle-o"></i> <span>Layanan</span>
						</a>
					</li>
					<?php
					}
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99' OR $group_id == '18' or $group_id=='14' or $group_id=='16')
					{
					?>
                    	<li>
						<a href="<?php echo base_url();?>material/persediaan">
							<i class="fa fa-circle-o"></i> <span>Persediaan</span>
						</a>
					</li>
					<?php
					}
					if($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '99')
					{
					?>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-circle-o"></i> <span>Keuangan</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="<?php echo base_url();?>finance/profit_loss">
									<i class="fa fa-circle-o"></i> <span>Laba Rugi</span>
								</a>
							</li>
							<li class="treeview">
								<a href="<?php echo base_url();?>finance/balance">
									<i class="fa fa-circle-o"></i> <span>Neraca</span>
								</a>
							</li>
						</ul>
					</li>
					<?php
					}?>
				</ul>
			</li>
			<?php
			}
			if ($group_id == '1' OR $group_id == '2' OR $group_id == '3' OR $group_id == '4' OR $group_id == '5' OR $group_id == '6' OR $group_id == '12' OR $group_id == '13' OR $group_id == '99')
			{
				if ($this->session->userdata('capital_money') != '')
				{
			?>
			<li>
				<a href="<?php echo base_url() . 'cashier/closed_shift'?>">
					<i class="fa fa-credit-card"></i> <span>Tutup Kasir </span>
				</a>
			</li>
			<?php
				}
			}
			if($group_id == '1' OR $group_id == '2' or $group_id == '3'or $group_id == '4'or $group_id == '5')
			{
			?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Pengaturan</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
			   <ul class="treeview-menu">
               <?
               if ($group_id <= '5')
               {
                ?>
                <li>
					<a href="<?php echo base_url();?>setting/table"><i class="fa fa-circle-o"></i> Manajemen Meja</a>
				</li>
                <?
                }
               
               if ($group_id <= '2' )
               {
                ?>
                <li>
					<a href="<?php echo base_url();?>account/all"><i class="fa fa-circle-o"></i> Pengguna</a>
				</li>
                <li>
					<a href="<?php echo base_url();?>setting"><i class="fa fa-circle-o"></i> Umum</a>
				</li>
				<li>
					<a href="<?php echo base_url();?>setting/production_devices"><i class="fa fa-circle-o"></i> Perangkat Produksi</a>
				</li>
				
                <?
               }             
                ?>
			   </ul>
            </li>
            <?php
			}
			?>
			</ul>
        </section>
				</div>
        <!-- /.sidebar -->
    </aside>

	<?php
	}
}
?>
