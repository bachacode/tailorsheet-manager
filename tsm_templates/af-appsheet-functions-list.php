<?php foreach ($data->posts as $post): ?>
<a href="<?php echo $post['post_url']; ?>"
	class="af-card-link">
	<!--  
        <div class="af-link-img__wrapper">
            <img class="af-link-img" src="<?php //echo esc_url(APPSHEET_FUNCTIONS_BASE_URL . '/assets/img/tailorsheet-mini.png');?>"
	alt="">
	</div>
	-->
	<div class="af-link-text__wrapper">
		<span><?php echo $post['post_title'] . ' ( )' ?>
		</span>
		<?php if($post['post_categories'] != null): ?>
		<span class="af-link-category"><i
				class="fa fa-tag"></i><?php echo $post['post_categories'][0]->name ?></span>
		<?php endif; ?>
	</div>
</a>
<?php endforeach; ?>