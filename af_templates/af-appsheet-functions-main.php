<?php
$handle = 'appsheet-functions-main';

wp_localize_script($handle, 'wp_ajax', array(
    'admin_ajax_url' => admin_url('admin-ajax.php'),
    /**
     * Create nonce for security.
     *
     * @link https://codex.wordpress.org/Function_Reference/wp_create_nonce
     */
    '_nonce' => wp_create_nonce('query_appsheet-functions'),

));

wp_enqueue_script($handle);
wp_enqueue_style($handle);
?>

<div class="af-main__wrapper">
	<!-- Categorias de expresiones -->
	<form id="categoryForm" class="af-form-category" method="POST">
		<div class="af-form-category-container">
			<h3 class="af-category-title">
				<?php echo esc_html__('Category', 'appsheet-functions') ?>
			</h3>

			<div class="af-category-list">
				<?php foreach ($data->categories as $category): ?>
				<div class="af-category">
					<input id="af-category-checkbox" type="checkbox"
						value="<?php echo $category->term_id ?>"
						name="categories[]" class="af-category-checkbox">
					<label for="af-category-checkbox"
						class="af-category-label"><?php echo esc_html($category->name) ?></label>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="af-category-buttons">
			<button type="submit" id="categorySubmit" class="af-btn-submit">
				<span><?php echo esc_html__('Show results', 'appsheet-functions') ?></span>
				<i class="fa fa-spinner"></i>
			</button>

			<button id="categoryReset" class="af-btn-reset" type="reset">
				<i class="fa fa-undo"></i>
				<span><?php echo esc_html__('Reset', 'appsheet-functions') ?></span>
			</button>
		</div>
	</form>

	<!-- Listado de expresiones -->
	<div class="af-posts-list">
		<div class="af-searchbar__wrapper">
			<form id="searchbarForm" class="af-searchbar-form" method="POST">
				<label for="af-search-text" class="af-searchbar-label"><?php echo esc_html__('Search', 'appsheet-functions') ?></label>
				<div class="af-searchbar-container">
					<div class="af-searchbar-icon__wrapper">
						<i class="fa fa-search"></i>
					</div>
					<input type="search" id="af-search-text"
						class="af-searchbar-input"
						placeholder="<?php echo esc_html__('Search functions...', 'appsheet-functions') ?>"
						name="search_query" />
					<button type="submit" id="searchbarSubmit"
						class="af-searchbar-button">
						<span><?php echo esc_html__('Search', 'appsheet-functions') ?></span>
						<i class="fa fa-spinner"></i>
					</button>
				</div>
			</form>
		</div>

		<div id="appsheetFunctionsList" class="af-posts-container">
			<?php echo $data->posts ?>
		</div>
	</div>

</div>