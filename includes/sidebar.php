<!-- Sidebar -->
<div class="col-lg-3">
	<?php if($info['afisare'][0]['afisare_search']){ ?>
	<!-- Search -->
	<div class="sidebar-widget">
		<form class="search-form">
			<button type="submit" value="" name="submit" class="search-button"><i class="fa fa-search"></i></button>
			<input class="search-line" name="search" type="text" placeholder="Search">
		</form>
	</div>
	<?php } ?>
	
	<!-- Categories 
		<div class="sidebar-widget">
		 <h4>Categories</h4>
		 <ul class="sidebar-categories">
		  <li><a href="#">Events </a><span class="counter-list">24</span></li>
		  <li><a href="#">Director's activities </a><span class="counter-list">28</span></li>
		  <li><a href="#">Cinemas </a><span class="counter-list">36</span></li>
		  <li><a href="#">About actors</a><span class="counter-list">12</span></li>
		  <li><a href="#">Future of film</a><span class="counter-list">26</span></li>
		 </ul>
		</div>
		-->
		
	<?php if($info['afisare'][0]['afisare_postari']){ ?>
	<!-- Recent Posts -->  
	<div class="sidebar-widget">
		<h4>Postări recente</h4>
		<ul class="latest-blog-list">
			<?php
				$sql = mysqli_query($con, "SELECT * FROM `articole` ORDER BY `id` DESC LIMIT 2");
				  
				while($rand = mysqli_fetch_assoc($sql)){
				?>
			<li>
				<span><?php echo strftime("%d", strtotime($rand['data'])); ?></span>
				<small><?php echo strftime("%B", strtotime($rand['data'])); ?></small>
				<small class="latest-blog-list-comments"><i class="fa fa-comments-o"></i><?php echo numarare($con, 'comentarii', 'WHERE `id_articol` = '. $rand['id'] .''); ?></small>
				<p><a href="articol/<?php echo $rand['id']; ?>"><?php echo strip_tags($rand['text']); ?></a></p>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
	
	<!-- Text Widget -->  
	<div class="sidebar-widget">
		<h4>Text Widget</h4>
		<p>
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Praesent egestas neque eu enim.
		</p>
	</div>
	
	<?php if($info['afisare'][0]['afisare_taguri']){ ?>
	<!-- Sidebar-Tags -->
	<div class="sidebar-widget">
		<h4>Tag-uri recente</h4>
		<ul class="tags-list">
			<li><a href="#">actors</a></li>
			<li><a href="#">avengers</a></li>
			<li><a href="#">avengers 2</a></li>
			<li><a href="#">marvel</a></li>
			<li><a href="#">s.h.i.e.l.d</a></li>
		</ul>
	</div>
	<?php } ?>
</div>
<!-- /sidebar-->