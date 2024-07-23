<div class="fe-wrapper">
    <div class="fe-table-wrapper">
        <table class="fe-table">
            <thead>
                <tr class="fe-headers">
                    <th class="fe-header">Sintaxis</th>
                    <th class="fe-header">Resultado</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data->terms as $term): ?>
                <tr class="fe-row">
                    <td class="fe-data"><pre class="fe-pre"><code><?= get_term_meta($term->term_id, 'fe_syntax', true);?> </code></pre></td>
                    <td class="fe-data"><pre class="fe-pre"><code><?= get_term_meta($term->term_id, 'fe_expected', true); ?></code></pre></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>