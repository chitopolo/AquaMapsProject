	
<!-- RP: Start Blue Space -->
	<div id="maincontainer" class="container-fluid" >
		<div class="row-fluid" style="min-height:250px; background-color:  #2298C6; margin-top: 40px; box-shadow: 0 3px 2px rgba(0, 0, 0, 0.15);" >
			<div id="logo" class="span8">
				<h1>
					<?php   echo $this->Html->image('AquaMapsBrand.png', array('class' => 'media-object', 'width' => '50%'));  ?>
				</h1>
			</div>
			<div id="strapline" class="span4">
				<p class="masthead">
					The tool that brings people and organizations together,
					to improve water and sanitation access around the world.
				</p>
				
			</div>
		</div>			
		<br class="clear"/>
		<div class="row-fluid" >
			<div class="span4">
				<h2 style="opacity: 0.5;">Soon available on</h2>
				<ul class="heading-icons">
				<li class=""><a  target="_blank">
				<?php   echo $this->Html->image('android-small-logo.png') ?> 
				</a></li>
				<li class=""><a  target="_blank">
				<?php   echo $this->Html->image('iphone-small-logo.png', array('width'=>100)) ?>
				</a>
				</li>
				</ul>
			</div>
			<div id="phonescreens" class="span4" >
				<div id="slider">
					<ul>				
						<li><?php   echo $this->Html->image('screen1.PNG') ?> </li>
						<li><?php   echo $this->Html->image('screen2.PNG') ?> </li>
						<li><?php   echo $this->Html->image('screen3.PNG') ?> </li>
						<li><?php   echo $this->Html->image('screen4.PNG') ?> </li>
						<li><?php   echo $this->Html->image('screen5.PNG') ?> </li>
						<li><?php   echo $this->Html->image('screen6.PNG') ?> </li>
					</ul>
				</div>
			</div>
			<div id="features" class="span4">
				<h1 style="opacity: 0.6">Features</h1>
				<ul class="featurelist" style="font-size: 24px;">

					<li class="BulletImage" style="opacity: 0.8">Capture water and sanitation data on the field </li>
					<li class="BulletImage" style="opacity: 0.8">Share it with your organization and the world</li>
					<li class="BulletImage" style="opacity: 0.8">Visualize your data</li>
					<li class="BulletImage" style="opacity: 0.8">Powered by API's from The World Bank</li>
				</ul>
			</div>
	</div>
	<div class="row-fluid">
	<div class="span12 offset1">
	<p><a href="">AquaMaps</a> by <a href="http://www.cochaValley.com/">Cocha Valley</a></p>
	</div>	
	</div>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				pause: 5000,
				controlsShow: false
			});
		});	
	</script>




