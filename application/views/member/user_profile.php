<div id="content">
	<div><img src="<?php echo base_url(). "images/banner.jpg";?>" alt="banner" width="760" height="220" /></div>
	
	<div class="boxed">
	<h1 class="title2">User Profile Details</h1>
	<br/><br/>
	<div style="margin-left:20px"><img src="<?php echo base_url(). "/images/user.png";?>" /></div>

	<dl>
		<dt>Full Name :</dt>
		<dd><?php echo $usrArray['fullname'];?></dd>
	
		<dt>Email : </dt>
		<dd><?php echo $usrArray['email'];?></dd>
		
		<dt>Role :</dt>
		<dd><?php echo $usrArray['role']; ?></dd>
		
		<dt>Nationality :</dt>
		<dd><?php echo $usrArray['nationality']; ?></dd>
		
		<dt>Residential Address :</dt>
		<dd><?php echo $usrArray['res_address']; ?></dd>
		
		<dt>Postal Code :</dt>
		<dd><?php echo $usrArray['postal_code']; ?></dd>
		
		<dt>Country :</dt>
		<dd><?php echo $usrArray['country']; ?></dd>
		
		<dt>Contact No. :</dt>
		<dd><?php echo $usrArray['contact_no']; ?></dd>
	</dl>
	
	<br/><br/>
	<div id="addPackageButton"><?php echo anchor('users/changePassword', 'Change Password');?></div>
	</div>
	<!-- end of .boxed -->
	
	

</div>
<!-- end of #content -->
<div style="clear :both;">&nbsp;</div>