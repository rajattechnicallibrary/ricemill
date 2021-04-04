
		<?php
$uri1 = @uri_segment(1);
$uri2 = @uri_segment(2);
$uri3 = @uri_segment(3);

if(!empty($_SESSION['user_type'])){
	if($_SESSION['user_type'] == 1){
		
?>
<ul class="sidebar-menu scrollable pos-r">
	<li class="nav-item mT-30 hide"><a class="sidebar-link" href="<?= base_url('admin/dashboard')?>" default><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
	<li class="nav-item dropdown hide <?php if($uri1 == 'master'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Masters</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'state'){echo 'btn_active';} ?>" href="<?= base_url('master/state')?>">State Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'city'){echo 'btn_active';} ?>" href="<?= base_url('master/city')?>">City Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'quality'){echo 'btn_active';} ?>" href="<?= base_url('master/quality')?>">Quality Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'purchaser'){echo 'btn_active';} ?>" href="<?= base_url('master/purchaser')?>">Purchaser Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'site'){echo 'btn_active';} ?>" href="<?= base_url('master/site')?>">Site Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'seller'){echo 'btn_active';} ?>" href="<?= base_url('master/seller')?>">Seller Master</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'reason'){echo 'btn_active';} ?>" href="<?= base_url('master/reason')?>">Account Reason</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'master' && $uri2 == 'tax'){echo 'btn_active';} ?>" href="<?= base_url('master/tax')?>">Tax Setting</a></li>
		
		</ul>
	</li>

	<li class="nav-item dropdown <?php if($uri1 == 'admin' && $uri2 == 'account'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">खर्च & जमा</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'account'&& $uri3 == 'deposite'){echo 'btn_active';} ?>" href="<?= base_url('admin/account/deposite')?>">नाम</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'account'&& $uri3 == 'expenditure'){echo 'btn_active';} ?>" href="<?= base_url('admin/account/expenditure')?>">जमा</a></li>
		
		</ul>
	</li>
	<li class="nav-item dropdown <?php if($uri1 == 'admin' && $uri2 == 'billing'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">बाजार खरीद</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'billing'&& $uri3 == 'add'){echo 'btn_active';} ?>" href="<?= base_url('admin/billing/add')?>">बाजार खरीद पर्चा</a></li>
		<!-- <li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'billing'&& $uri3 == 'listing'){echo 'btn_active';} ?>" href="<?= base_url('admin/billing/listing')?>">List Billing</a></li> -->
		
		</ul>
	</li>
	</li>
	<li class="nav-item dropdown <?php if($uri1 == 'admin' && $uri2 == 'report'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">रिपोर्ट</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'search'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/search')?>">खाता नाम</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'byaccount_name'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/byaccount_name')?>">खाता नाम सूची</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'rokad_parcha'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/rokad_parcha')?>">रोकड़ पर्चा</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'searchbycondition'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/searchbycondition')?>">Search By Condition</a></li>
		
		</ul>
	</li>
	
	
	<ul class="sidebar-menu scrollable pos-r">
	<li class="nav-item dropdown  <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">मैपिंग किसान बही</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'&& $uri3 == 'account_mapping'){echo 'btn_active';} ?>" href="<?= base_url('admin/accountMapping/account_mapping')?>">किसान खाता नक्शा</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'&& $uri3 == 'add_Kisan_Vahi'){echo 'btn_active';} ?>" href="<?= base_url('admin/accountMapping/add_Kisan_Vahi')?>">ऐड किसान वही</a></li>
		</ul>
	</li>

	<li class="nav-item dropdown  <?php if($uri1 == 'admin' && $uri2 == 'setting'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">सेटिंग</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'setting'&& $uri3 == 'change_fy'){echo 'btn_active';} ?>" href="<?= base_url('admin/setting/change_fy')?>">वित्तीय वर्ष बदलें</a></li>
		</ul>
	</li>
	
	</ul>

	

	
	
	
	
</ul>



<?php
	}
}
?>
<?php

if(!empty($_SESSION['user_type'])){
	
	if($_SESSION['user_type'] == 3){
		
?>
<ul class="sidebar-menu scrollable pos-r">
<li class="nav-item dropdown <?php if($uri1 == 'admin' && $uri2 == 'report'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">रिपोर्ट</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'search'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/search')?>">खाता नाम</a></li>
		<!-- <li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'byaccount_name'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/byaccount_name')?>">खाता नाम सूची</a></li> -->
		<!-- <li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'rokad_parcha'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/rokad_parcha')?>">रोकड़ पर्चा</a></li> -->
		<!-- <li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'report'&& $uri3 == 'searchbycondition'){echo 'btn_active';} ?>" href="<?= base_url('admin/report/searchbycondition')?>">शर्त के आधार पर खोजें	</a></li> -->
		
		</ul>
	</li>
	

	<li class="nav-item dropdown  <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'){echo 'open';} ?>">
		<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">मैपिंग किसान बही</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
		<ul class="dropdown-menu">
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'&& $uri3 == 'add_Kisan_Vahi'){echo 'btn_active';} ?>" href="<?= base_url('admin/accountMapping/add_Kisan_Vahi')?>">ऐड किसान वही</a></li>
		<li><a class="sidebar-link <?php if($uri1 == 'admin' && $uri2 == 'accountMapping'&& $uri3 == 'account_mapping'){echo 'btn_active';} ?>" href="<?= base_url('admin/accountMapping/account_mapping')?>">किसान खाता नक्शा</a></li>
		</ul>
	</li>
	
</ul>
<?php
	}
}
?>
