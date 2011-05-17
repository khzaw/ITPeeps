<div id="content">
	<img src="<?php echo base_url(). "images/banner.jpg"; ?>" alt="Banner" width="760" height="220" />
	
	<div class="boxed">
		<h1 class="title2">Member Registeration</h1>
	
	</div>
	<div id="register-form" class="boxed">
	<?php
		
		echo form_open('site/createNewMember');
		
		echo form_fieldset('Login Information');
		
		echo '<p>';
		echo form_label('Full Name', 'fullname');
		echo form_input('fullname', set_value('fullname'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Email', 'email');
		echo form_input('email', set_value('email'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Password', 'password');
		echo form_password('password', set_value('password'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Confirm Password', 'confirm');
		echo form_password('confirm', set_value('confirm'));
		echo '</p>';
		
		echo form_fieldset_close();
		
		echo '<br/><br/>';
		
		echo form_fieldset('Personal Particulars');
		
		$options = array (
						'singaporean' => 'Singaporean',
						'burmese' => 'Burmese',
						'chinese' => 'Chinese',
						'malay' => 'Malay',
		
					);
		echo '<p>';
		echo form_label('Nationality', 'nationality');
		echo form_dropdown('nationality', $options, 'singaporean');
		echo '</p>';
		
		echo '<p>';
		echo form_label('Residential Address', 'res_address');
		echo form_textarea('res_address', set_value('res_address'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Postal Code', 'postal_code');
		echo form_input('postal_code', set_value('postal_code'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Country', 'country');
		echo form_input('country', set_value('country'));
		echo '</p>';
		
		echo '<p>';
		echo form_label('Contact Number', 'contact_number');
		echo form_input('contact_number', set_value('contact_number'));
		echo '</p>';
		
		echo form_submit('submit', 'Register');
		
		echo form_fieldset_close();
		
		echo validation_errors();
		
		echo form_close();
	?>
	</div>
</div>
<!-- end of #content -->
<div style="clear :both;">&nbsp;</div>