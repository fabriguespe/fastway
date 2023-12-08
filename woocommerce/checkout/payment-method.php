<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$value=$gateway->id;

?>


<li class="capsula payment wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>" data-radio="<?=$value?>" data-label="<?=$gateway->title?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>"   />
	<span class="checkmark"></span>
	<label class="title"><?=$gateway->title?></label>
	<small class="costo"><?=$gateway->description?></small>

	<?php if ( $gateway->has_fields() ) : ?>
		<div class="extras extras_payment" >
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>