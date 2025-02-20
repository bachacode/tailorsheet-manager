<?php
$handle = 'tailorsheet-manager-faq';

wp_localize_script($handle, 'wp_ajax', array(
    'faq_first_opened' => isset( $data->faq_first_opened ) ? $data->faq_first_opened : 'no',
));

wp_enqueue_script($handle);
wp_enqueue_style($handle);
?>

<div class="tm-accordion-wrapper">
    <div class="tm-accordion-items">
        <?php foreach($data->faq_items as $item): ?>
        <div class="tm-accordion-item">
            <div class="tm-accordion-heading-wrapper">
                <span class="tm-accordion-icon active-icon">
                    <i class="<?= $data->faq_icons['icon_active']['value'] ?>"></i>
                </span>
                <span class="tm-accordion-icon inactive-icon">
                    <i class="<?= $data->faq_icons['icon_inactive']['value'] ?>"></i>
                </span>
                <h3><?= $item['faq_heading'] ?></h3>
            </div>
            <div class="tm-accordion-content-wrapper">
                <span><?= $item['faq_content'] ?></span>
            </div>
        </div>
            <?php endforeach; ?>
    </div>
</div>