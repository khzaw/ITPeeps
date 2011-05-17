<div id="content">
	<img src="<?php echo base_url(). 'images/banner.jpg';?>" alt="Banner" width="760" height="220" />
	
	<div class="boxed">
		<h1 class="title2">What is your email address?</h1>
		<p><strong>A new password</strong> will be sent to your provided email address.</p>
		
		<div id="passwordForm" class="boxed">
		<?php
			echo form_open('site/passwordProcess');
			
			echo form_label('Email Address', 'email');
			echo form_input('email', set_value('email'));
			
			echo form_submit('send', 'Send');
			echo form_close();
		?>
		</div>
	</div>
	<!-- end of .boxed -->
</div>
<!-- end of #content -->
<div style="clear :both;">&nbsp;</div>