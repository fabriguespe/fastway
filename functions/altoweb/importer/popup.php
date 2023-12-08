<?php
/**
 * Uploadscreen for selecting and uploading new media file
 *
 * @author      M�ns Jonasson  <http://www.mansjonasson.se>
 * @copyright   M�ns Jonasson 13 sep 2010
 * @version     $Revision: 2303 $ | $Date: 2010-09-13 11:12:35 +0200 (ma, 13 sep 2010) $
 * @package     wordpress
 * @subpackage  enable-media-replace
 *
 */

if (!current_user_can('upload_files'))
	wp_die(__('You do not have permission to upload files.', 'enable-media-replace'));

global $wpdb;

$table_name = $wpdb->prefix . "posts";

$sql = "SELECT guid, post_mime_type FROM $table_name WHERE ID = " . (int) $_GET["attachment_id"];

list($current_filename, $current_filetype) = $wpdb->get_row($sql, ARRAY_N);

$current_filename = substr($current_filename, (strrpos($current_filename, "/") + 1));


?>
<div class="wrap">
		<div id="icon-upload" class="icon32"><br /></div>
	<h2><?php echo "Reemplazar archivo ".$current_filename; ?></h2>

	<?php
	$url = admin_url( "upload.php?page=enable-media-replace/enable-media-replace.php&noheader=true&action=media_replace_upload&attachment_id=" . (int) $_GET["attachment_id"]);
	$action = "media_replace_upload";
    $formurl = wp_nonce_url( $url, $action );
	if (FORCE_SSL_ADMIN) {
			$formurl = str_replace("http:", "https:", $formurl);
		}
	?>

	<form enctype="multipart/form-data" method="post" action="<?php echo $formurl; ?>">
		<input type="hidden" name="ID" value="<?php echo (int) $_GET["attachment_id"]; ?>" />
		<input type="hidden" name="EXCEL" value="<?php echo $_GET["excel"]; ?>" />
		<div id="message" class="updated fade"><p><?php echo __("NOTE: You are about to replace the media file", "enable-media-replace"); ?> "<?php echo $current_filename?>". <?php echo __("There is no undo. Think about it!", "enable-media-replace"); ?></p></div>

		<p><?php echo "Elegir un archivo desde su PC"; ?></p>

		<input type="file" name="userfile" />

		<input type="hidden" name="replace_type" value="replace" />

		<input type="submit" class="button" value="Subir" />
	</form>
</div>
