<?php

$tabs = array(
    'file',
    'url',
    'facebook',
    'instagram',
    'flickr',
    'gdrive',
    'evernote',
    'box',
    'skydrive',
    'dropbox',
    'vk'
);
$tab_defaults = array(
    'file',
    'url',
    'facebook',
    'instagram',
    'flickr',
    'gdrive',
    'evernote',
    'box',
    'skydrive',
);

$effects = array(
    'crop',
    'rotate',
    'mirror',
    'flip',
    'blur',
    'sharp',
    'enhance',
    'grayscale',
);

$effects_defaults = array (
    'crop',
    'rotate',
    'sharp',
    'enhance',
    'grayscale',
);


$saved = false;
if(isset($_POST['uploadcare_hidden']) && $_POST['uploadcare_hidden'] == 'Y') {
    $uploadcare_public = $_POST['uploadcare_public'];
    update_option('uploadcare_public', $uploadcare_public);
    $uploadcare_secret = $_POST['uploadcare_secret'];
    update_option('uploadcare_secret', $uploadcare_secret);
    $uploadcare_cdn_base = $_POST['uploadcare_cdn_base'];
    update_option('uploadcare_cdn_base', $uploadcare_cdn_base);
    $uploadcare_original = $_POST['uploadcare_original'];
    update_option('uploadcare_original', $uploadcare_original);
    $uploadcare_multiupload = $_POST['uploadcare_multiupload'];
    update_option('uploadcare_multiupload', $uploadcare_multiupload);
    $uploadcare_download_to_server = $_POST['uploadcare_download_to_server'];
    update_option('uploadcare_download_to_server', $uploadcare_download_to_server);
    $uploadcare_finetuning = $_POST['uploadcare_finetuning'];
    update_option('uploadcare_finetuning', $uploadcare_finetuning);
    $uploadcare_source_tabs = $_POST['uploadcare_source_tabs'];
    update_option('uploadcare_source_tabs', $uploadcare_source_tabs);
    $uploadcare_tab_effects = $_POST['uploadcare_tab_effects'];
    update_option('uploadcare_tab_effects', $uploadcare_tab_effects);
    $saved = true;
} else {
    $uploadcare_public = get_option('uploadcare_public');
    $uploadcare_secret = get_option('uploadcare_secret');
    $uploadcare_cdn_base = get_option('uploadcare_cdn_base', 'ucarecdn.com');
    $uploadcare_original = get_option('uploadcare_original');
    $uploadcare_multiupload = get_option('uploadcare_multiupload');
    $uploadcare_download_to_server = get_option('uploadcare_download_to_server');
    $uploadcare_finetuning = get_option('uploadcare_finetuning');
    $uploadcare_source_tabs = get_option('uploadcare_source_tabs', $tab_defaults);
    $uploadcare_tab_effects = get_option('uploadcare_tab_effects', $effects_defaults);
}
?>

<?php if ($saved): ?>
<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php endif; ?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
    <?php echo "<h2>" . __( 'Uploadcare', 'uploadcare_settings' ) . "</h2>"; ?>
    <form name="oscimp_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="uploadcare_hidden" value="Y">
        <h3>API Keys <a href="https://uploadcare.com/documentation/keys/">[?]</a></h3>
        <p>
            <?php _e('Public key: '); ?>
            <input type="text" name="uploadcare_public" value="<?php echo $uploadcare_public; ?>" size="20">
        </p>
        <p>
            <?php _e("Secret key: " ); ?>
            <input type="text" name="uploadcare_secret" value="<?php echo $uploadcare_secret; ?>" size="20">
        </p>
        <h3>Options</h3>
        <p>
            <?php _e("CDN Host: " ); ?>
            <input type="text" name="uploadcare_cdn_base" value="<?php echo $uploadcare_cdn_base; ?>" size="20">
        </p>
        <p>
            <input type="checkbox" name="uploadcare_original" <?php if ($uploadcare_original): ?>checked="checked"<?php endif; ?>
            />&nbsp;<?php _e('Insert image with URL to the original image'); ?>
        </p>
        <p>
            <input type="checkbox" name="uploadcare_multiupload" <?php if ($uploadcare_multiupload): ?>checked="checked"<?php endif; ?>
            />&nbsp;<?php _e('Allow multiupload in Uploadcare widget'); ?>
        </p>
        <p>
            <input type="checkbox" name="uploadcare_download_to_server" <?php if ($uploadcare_download_to_server): ?>checked="checked"<?php endif; ?>
                />&nbsp;<?php _e('Download images to server from Uploadcare before publish'); ?>
        </p>
        <h3>Tab effects</h3>
        <select name="uploadcare_tab_effects[]" multiple="" size="12" style="width: 120px;">
        <?php
            $selected = in_array('none', $uploadcare_tab_effects) ? 'selected="selected"' : '';
            echo '<option ' . $selected . ' value="none">none</option>';
            foreach ($effects as $effect) {
                $selected = in_array($effect, $uploadcare_tab_effects) ? 'selected="selected"' : '';
                echo '<option ' . $selected . ' value="' . $effect . '">' . $effect . '</option>';
            }
        ?>
        </select>
        <h3>Upload Sources</h3>
        <select name="uploadcare_source_tabs[]" multiple="" size="12" style="width: 120px;">
            <?php
                $selected = in_array('all', $uploadcare_source_tabs) ? 'selected="selected"' : '';
                echo '<option ' . $selected . ' value="all">All tabs</option>';
                foreach ($tabs as $tab) {
                    $selected = in_array($tab, $uploadcare_source_tabs) ? 'selected="selected"' : '';
                    echo '<option ' . $selected . ' value="' . $tab . '">' . $tab . '</option>';
                }
            ?>
        </select>

        <h3>Widget fine tuning <a href="https://uploadcare.com/documentation/widget/#advanced-configuration">[?]</a></h3>
        <p>
            <textarea name="uploadcare_finetuning" rows="10" cols="50"><?php echo stripcslashes($uploadcare_finetuning); ?></textarea>
        </p>
        <p class="submit">
        <?php submit_button(); ?>
        </p>
    </form>
    <div>
    <ul>
        <li>Files uploaded to demo account (demopublickey) are deleted after some time.</li>
        <li>You can get your own account <a href="https://uploadcare.com/pricing/">here</a>.</li>
    </ul>
    </div>
</div>
