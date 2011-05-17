<div id="content">
	<div><img src="<?php echo base_url(). 'images/banner.jpg';?>" alt="banner" width="760" height="220" /></div>
	
	<div class="boxed">
		<h1 class="title2">Add New Package</h1>
		<br/>
		
	<div id="form">
	<fieldset>
		<?php 

			echo form_open_multipart('packages/addPackage'); 

			echo '<p>';
			echo form_label('Package Name', 'name');
			echo form_input('packagename', set_value('packagename'));
			echo '</p>';
			
			echo '<p>';
			echo form_label('Description', 'description');
			echo form_textarea('description', set_value('description'));
			echo '</p>';
			
			echo '<p>';
			echo form_label('Location', 'location');
			echo form_input('location', set_value('location'));
			echo '</p>';
			
			echo '<p>';
			echo form_label('Price', 'price');
			echo form_input('price', set_value('price'));
			echo '</p>';
			
			echo '<p>';
			echo form_label('Image Upload', 'upload');
			echo form_upload('imagefile');
			echo '</p>';	
			
			echo '<p>';
			echo form_submit('submit', 'Add New Package');
			echo '</p>';
							
			echo validation_errors();
			
			echo form_close();	
		?>
		</fieldset>
	</div>
	<!-- end of .form -->	
	</div>
	<!-- end of .boxed -->
</div>
<!-- end of #content -->
