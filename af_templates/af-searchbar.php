<?php
$handle = 'appsheet-functions-searchbar';

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
wp_enqueue_script('alpinejs');
?>

<div class="appsheet-functions-searchbar__wrapper">
	<div class="search">
		<form id="searchbarForm" class="search-form" action="" method="POST">
			<input type="text" name="search_query" class="search-input" placeholder="Buscar una expresión">
			<button type="submit" class="search-button">
				<i class="fa fa-search"></i>
			</button>
		</form>
	</div>
</div>