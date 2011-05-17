<div id="content">
	<div><img src="<?php echo base_url(). 'images/banner.jpg'; ?>" alt="banner" width="760" height="220" /></div>
	
	<div class="boxed">
		<h1 class="title2">Package Details</h1>
		<br/>
		<strong><?php echo $package['name']; ?></strong>
		<div class="package">
			<img src="<?php echo base_url(). "images/packages/" . $package['image'] ;?>" alt="image" width="600" height="300"/>
			
			<div class ="description">
				<h3>Price : <?php echo $package['price']; ?></h3>
				<h3>Location : <?php echo $package['location'];?></h3>
				<p>
					<?php echo $package['description']; ?>
				</p>
			</div>
			<!-- end of .description -->
		</div>
		<!-- end of .package -->
	</div>
	<!-- end of .boxed -->
</div>
<!-- end of #content -->
<div style="clear :both;">&nbsp;</div>