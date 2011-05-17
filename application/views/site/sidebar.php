<div id="sidebar">
	<div id="logo">
		<h1><a href="<?php echo base_url();?>">ITPeeps</a></h1>
		<h2>Developed by <a href="http://www.twitter.com/emoosx">Kaung Htet Zaw</a></h2>
	</div>
	<!-- end of #logo -->
	<div id="sidebarwrapper">
	<div id="menu">
		<ul>
			<li><?php echo anchor('site/index', 'Home');?></li>
			<li><?php echo anchor('site/register', 'Register');?></li>
			<li><?php echo anchor('site/sitemap', 'Sitemap');?></li>
		</ul>
	</div>
	<!-- end of #menu -->
	
	<div id="login">
		<h2 class="title1">Member Login</h2>
		<?php
			echo form_open('site/index');
			
			echo form_fieldset();
			
			echo form_label('Email Address :', 'email');
			echo form_input(array('name' => 'email', 'value' => set_value('email'), 'id' => 'email'));
			
			echo form_label('Password:', 'password');
			echo form_password(array('name' => 'password', 'value' => '', 'id' => 'password'));
			
			echo form_label('Remember Me', 'remember');
		?>
			<input type="checkbox" name="remember" id="remember" /><br/><br/>
		<?php	
		
			echo form_submit(array('value' => 'Login', 'name' => 'submit', 'id' => 'submit'));
		?>
					<div id="forgotpassword"><?php echo anchor('site/forgotPassword', 'Forgot Password?');?></div><br/>
		<?php
			echo form_fieldset_close();
				
			echo validation_errors();
			
			echo form_close();
			
		?>			
	</div>
	<!-- end of #login -->
	</div>
	<!-- end of #sidebarwrapper -->
</div>
<!-- end of #sidebar -->