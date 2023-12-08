<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>


<form name="checkout" method="post" class=" fw_checkout" enctype="multipart/form-data">	
		<div class="register-fields" style="width:100%;">
			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
			<div class="woocommerce-billing-fields__field-wrapper">
				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<p class="form-row form-row-first validate-required">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<span class="woocommerce-input-wrapper">
						<input type="text" class="input-text" name="username" id="billing_first_name" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
					</span>
				</p>
				<p class="form-row form-row-first validate-required">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<span class="woocommerce-input-wrapper">
						<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
					</span>
				</p>
				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row form-row-first validate-required">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
</form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<form name="checkout" method="post" class=" fw_checkout" enctype="multipart/form-data" style="margin-top:50px;">	
		<div class="register-fields" style="width:100% !important;">

			<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
			<div class="woocommerce-billing-fields__field-wrapper">
					<?php do_action( 'woocommerce_register_form_start' ); ?>
					
					
					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<p class="form-row form-row-first validate-required">
							<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>

					<?php endif; ?>

					<p class="form-row form-row-first validate-required">
						<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<span class="woocommerce-input-wrapper">
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
						</span>
					</p>
					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<p class="form-row form-row-first validate-required">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<span class="woocommerce-input-wrapper">
							<input class="input-text" type="password" name="password" id="reg_password" autocomplete="new-password" />
						</span>
					</p>
					<?php else : ?>

					<label><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></label>

					<?php endif; ?>
							
							<!--
					<p class="form-row form-row-first validate-required">
						<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<span class="woocommerce-input-wrapper">
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

								<p class="">
									<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
								</p>

							<?php else : ?>

								<span><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></span>

							<?php endif; ?>
						</span>
					</p>-->

			</div>
			<div class="woocommerce-billing-fields__field-wrapper">
					
					<p class="form-row form-row-first validate-required" >
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<button type="submit" class="woocommerce-Button button woocommerce-form-login__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>

						<?php if(fw_theme_mod('fw_terms_required')){ ?>
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
								<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" /> 
								<span><?php echo 'He leido y acepto los  <a target="_blank" href="'.get_privacy_policy_url().'">terminos y condiciones</a>' ?></span> <span class="required">*</span>
							</label>
							<input type="hidden" name="terms-field" value="1" />
						<?php } ?>
					</p>

					<?php do_action( 'woocommerce_register_form_end' ); ?>
			</div>
			
			

		</div>
		
</form>

<?php endif; ?>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
