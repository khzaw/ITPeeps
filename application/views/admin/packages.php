<?php 
	
	function briefInfo($content)
	{
		$dot = ".";
		$position = stripos($content, $dot);	// find first dot position
		
		if($position)	// if there is a dot in description
		{
			$offset = $position + 1;	// prepare offset
			$position2 = stripos($content, $dot, $offset);	// find second dot using offset
			$offset = $position2 + 1;
			$position3 = stripos($content, $dot, $offset);
			$offset = $position3 + 1;
			$position4 = stripos($content, $dot, $offset);
			$first_four = substr($content, 0, $position4);	// put two first sentences under $first_two
			
			
			return $first_four . '.'; // add a dot
		}
		
		return '';
	}
	
?>


<div id="content">
	<div><img src="<?php echo base_url(). 'images/banner.jpg';?>" alt="banner" width="760" height="220" /></div>
	
	<div class="boxed">
		<h1 class="title2">Travel Packages</h1><br/><br/>
		
		<div id="addPackageButton"><?php echo anchor('packages/addPackage', 'Add Package');?></div>
		
		<?php foreach($packages as $package): ?>
		
			<div class="package">
				<h3 class="packageTitle"><?php echo anchor("packages/details/". $package['id'], $package['name']); ?></h3>
				<div class="image"><img src=<?php echo base_url(). 'images/packages/' . $package['image'] ;?> width="600" height="350"/></div>
				<div class="description">
					<p>
						<?php echo briefInfo($package['description']); ?>
						<br/>
						<?php echo anchor("packages/details/".$package['id'], 'Read More'); ?>
					</p>
				</div>
				<!-- end of .description -->
			</div>
			<!-- end .package -->
		
		<?php endforeach; ?>
		
		


<?php echo $this->pagination->create_links(); ?>

	</div>	
	<!-- end of .boxed -->
</div>
<!-- end of #content -->
<div style="clear :both;">&nbsp;</div>








