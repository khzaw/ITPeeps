<div id="sidebar">
	<div id="logo">
		<h1><a href="#">ITPeeps</a></h1>
		<h2>Developed by <a href="http://www.twitter.com/emoosx">Kaung Htet Zaw</a></h2>
	</div>
	<!-- end of #logo -->
	
	<div id="menu">
		<ul>
			<li><?php echo anchor('dashboard/index', 'Home'); ?></li>
			<li><?php echo anchor('packages/index', 'Travel Packages'); ?></li>
			<li><?php echo anchor('users/profile', 'User Profile'); ?></li>
			<li><?php echo anchor('site/sitemap', 'Sitemap'); ?></li>
			<li><?php echo anchor('dashboard/logout', 'Logout'); ?></li>
		</ul>
	</div>
	<!-- end of #menu -->
	
	<div id="login">
		<h2 class="title1">Member Login</h2>
		<p>Logged in as :</p>
		<div style="margin-left:20px"><img src="<?php echo base_url(). "/images/user.png";?>" width="150" height="150"/></div>
		<p style="margin-left:30px;"><?php echo $fullname; ?></p>
		<p style="color: red; margin-left:50px;"><?php echo $role; ?></p>
	</div>
	<!-- end of #login -->
</div>
<!-- end of #sidebar -->