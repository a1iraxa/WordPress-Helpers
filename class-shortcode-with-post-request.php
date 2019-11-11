<?php
/**
 * DigitSol ShortCodes
 *
 * @package DigitSol
 * @since 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DigitSol_Short_Code' ) ) {

    /**
     * Class DigitSol_Short_Code
     *
     * @since 1.0
     */
    class DigitSol_Short_Code {
        /**
         * Initialize
         *
         * @access public
         * @return void
         */
        public function __construct() {

            add_shortcode('digitsol-get-products', [ $this, 'get_product_page']);

            // Form actions
            add_action( 'admin_post_nopriv_payment_get_charged', [ $this, 'charge_payment' ] );
            add_action( 'admin_post_payment_get_charged', [ $this, 'charge_payment' ] );

            add_action( 'wp_enqueue_scripts', [ $this, 'digitsol_custom_scripts'] );

        }
        /**
         * Add custom scripts
         *
         * @access public
         * @return void
         * @since 1.0
         */
        public function digitsol_custom_scripts() {
            wp_enqueue_script('digitsol_main_scripts', get_template_directory_uri() . '/digitsol/scripts.js', array('jquery'), '1.0', FALSE);

            $digitsol_ajax_data = array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'current_obj' => get_queried_object(),
            );
            wp_localize_script( 'digitsol_main_scripts', 'digitsol_ajax_object', $digitsol_ajax_data );
        }
        /**
         * Get product page
         *
         * @access public
         * @return void
         * @since 1.0
         */
        public function get_product_page($atts) {

            $products = new WP_Query( [
                'post_type' => 'product',
                'order' => 'DESC',
                'orderby' => 'ID',
                'posts_per_page' => 3
            ] );
            ?>
            <div class="container digitsol-products-wrapper">
                <div class="row">
                    <div class="col-sm-8">
                        <?php
                            if ($products->have_posts()):
                                while ($products->have_posts()): $products->the_post(); ?>
                                    <?php $_product = wc_get_product( get_the_ID() ); ?>
                                    <div class="row">
                                        <div class="digitsol-products radio">
                                            <label data-id="<?php echo get_the_ID(); ?>">
                                                <input type="radio" name="product_id" data-title="<?php the_title(); ?>" data-regular-price="<?php echo $_product->get_regular_price(); ?>" data-sale-price="<?php echo $_product->get_sale_price(); ?>" value="<?php echo get_the_ID(); ?>">
                                                <div class="digitsol-product-text">
                                                    <h4><?php ucfirst(the_title()); ?></h4>
                                                </div>
                                                <div class="col-sm-12 digitsol-product-block">
                                                    <a href="<?php esc_url(the_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>" ></a>
                                                </div>
                                                <div class="digitsol-inner">
                                                    <div class="digitsol-featured-image">
                                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );?>

                                                        <img src="<?php  echo $image[0]; ?>" data-id="<?php echo get_the_ID(); ?>">
                                                    </div>
                                                    <div class="digitsol-right-inner">
                                                        <div class="digitsol-subtitle">
                                                            <p> <?php echo $_product->short_description; ?> </p>
                                                        </div>
                                                        <div class="digitsol-prices">
                                                            <h6 class="digitsol-price digitsol-price-regular">Regularly $<?php echo $_product->get_regular_price(); ?></h6>
                                                            <h6 class="digitsol-price digitsol-price-sale">Sale $<?php echo $_product->get_sale_price(); ?></h6>
                                                        </div>
                                                        <div class="digitsol-btn">
                                                            <button class="digitsol-select">Select</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                        ?>
                        <div class="row">
                            <div class="digitsol-order-summary digitsol-hide-me">
                                <div class="digitsol-order-summary-heading">
                                    <h3>Order Summary</h3>
                                </div>
                                <div class="digitsol-order-summary-content">
                                    <div class="col-sm-5 left-area">
                                        <div class="left-order-summar">
                                            <h2>Delivery Partners</h2>
                                            <img src="http://getsafecbdnow.com/wp-content/uploads/2018/04/delivery.jpg">
                                        </div>
                                    </div>
                                    <div class="col-sm-7 right-area">
                                        <table class="digitsol-order-summary-table"></table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="payment-form">
                            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">

                                <input type="hidden" name="action" value="payment_get_charged">
                                <input type="hidden" name="amount" value="1">
                                <input type="hidden" name="productId" value="1">
                                <input type="hidden" name="productName" value="SANDBOX Products">

                                <img class="digitsol-checkout-cards" src="http://getsafecbdnow.com/wp-content/uploads/2018/04/accept.jpg">

                                <div class="form-group">
                                    <label for="cardNumber">Cart Number</label>
                                    <input type="text" name="cardNumber" id="cardNumber" required>
                                </div>

                                <div class="form-group">
                                    <label for="accountType">Card Type</label>
                                    <select name="accountType" id="accountType">
                                        <option value="americanexpress ">American Express </option>
                                        <option value="discover">Discover</option>
                                        <option value="jcb">JCB</option>
                                        <option value="visa">Visa</option>
                                        <option value="mastercard">Mastercard</option>
                                        <option value="dinersclub">Diners Club</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="expMonth">Expiry Month</label>
                                    <select name="expMonth" id="expMonth">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="expYear">Expiry Year</label>
                                    <?php
                                        $year = date('y');
                                        $max = $year + 20;
                                        $min = $year;
                                     ?>
                                    <select name="expYear" id="expYear">
                                        <option value="">Year</option>

                                        <?php
                                            for( $i=$min; $i<$max; $i++ ) {
                                                echo '<option value='. $i .'>20'.$i.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="cvv" id="cvv" required>
                                </div>
                                <div class="digitsol-terms">
                                    <p>By clicking Complete Checkout, you represent that you are at least eighteen (18) years of age and have read and agree to our Terms and Conditions and Privacy Policy.</p>
                                </div>
                                <button type="submit" class="digitsol-select">Rush my order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        }

        /**
         * Get charge payment
         *
         * @access public
         * @return void
         * @since 1.1
         */
        public function charge_payment() {

            if ( !isset( $_POST['amount'] ) || empty( $_POST['amount'] ) ) {
                return;
            }

            if ( !isset( $_POST['cardNumber'] ) || empty( $_POST['cardNumber'] ) ) {
                return;
            }

            if ( !isset( $_POST['expMonth'] ) || empty( $_POST['expMonth'] ) ) {
                return;
            }

            if ( !isset( $_POST['expYear'] ) || empty( $_POST['expYear'] ) ) {
                return;
            }
            echo "<pre>";
            // print_r($_POST);
            chargeCreditCard( $_POST );
            echo "</pre>";
        }
    }

    new DigitSol_Short_Code();
}
