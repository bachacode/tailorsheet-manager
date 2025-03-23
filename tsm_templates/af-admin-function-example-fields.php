<div>
    <?php if(isset($data->syntax) || isset($data->expected)): ?>
    <div class="form-field">
        <label
            for="fe_syntax"><?php echo __('Example use', 'tailorsheet-manager') ?></label>
        <input type="text" name="fe_syntax" id="fe_syntax" placeholder="e.j: FUNCTION (-1)"
            value="<?php echo esc_attr($data->syntax) ?>" />
    </div>

    <div class="form-field">
        <label
            for="fe_expected"><?php echo __('Expected Result', 'tailorsheet-manager') ?></label>
        <input type="text" name="fe_expected" id="fe_expected" placeholder="e.j: 1"
            value="<?php echo esc_attr($data->expected) ?>" />
    </div>
    <?php else: ?>
    <div class="form-field">
        <label
            for="fe_syntax"><?php echo __('Example use', 'tailorsheet-manager') ?></label>
        <input type="text" name="fe_syntax" id="fe_syntax" placeholder="e.j: FUNCTION (-1)" />
    </div>
    <div class="form-field">
        <label
            for="fe_expected"><?php echo __('Expected Result', 'tailorsheet-manager') ?></label>
        <input type="text" name="fe_expected" id="fe_expected" placeholder="e.j: 1" />
    </div>
    <?php endif; ?>
</div>