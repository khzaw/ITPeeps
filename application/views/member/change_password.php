<div id="content">
	<div><img src="<?php echo base_url(). 'images/banner.jpg';?>" alt="banner" width="760" height="220" /></div>
	
	<div class="boxed">
		<h1 class="title2">Change Password</h1>
		<br />
		<div id="form">
			<fieldset>
				<?php
					echo form_open('users/changePassword');
					
					echo '<p>';
					echo form_label('New Password', 'password');
					echo form_password('password');
					echo '</p>';
					
					echo '<p>';
					echo form_label('Confirm Password', 'confirm');
					echo form_password('confirm');
					echo '</p>';
					
					echo validation_errors();
					
					echo form_submit('submit', 'Change Password');
					
					echo form_close();
				?>
			</fieldset>
		</div>
	</div>
	<!-- .boxed -->
</div>
<!-- #content -->