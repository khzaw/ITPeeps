<?=form_open('site/login'); ?>
<fieldset>
	<legend>Login Form</legend>
	<ul>
	<p>
			<label>Email</label>
			<?=form_input('email', set_value('email')); ?>
				</p>
	<p>
			<label>Password</label>
			<?=form_password('password'); ?>
			
	</p> 
			<?=form_submit('submit', 'Login');?>
			<?=validation_errors('<p class="errors">');?>
	</ul>
</fieldset>
<?=form_close()?>