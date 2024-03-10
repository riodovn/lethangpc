(function ($) {
    'use strict';

   function buyNow() {
        if ( ! $('body').find('div.product').hasClass('has-buy-now') && ! $('body').find('div.product-quickview').hasClass('has-buy-now') ) {
            return;
        }

        $('body').on('click', '.motta-buy-now-button', function (e) {
            e.preventDefault();
            var $form = $(this).closest('form.cart'),
                is_disabled = $(this).is(':disabled');


            if (is_disabled) {
                jQuery('html, body').animate({
                        scrollTop: $(this).offset().top - 200
                    }, 900
                );
            } else {
                $form.addClass('buy-now-clicked');
                $form.append('<input type="hidden" value="true" name="motta_buy_now" />');
                $form.find('.single_add_to_cart_button').trigger('click');
            }
        });

        var $variations_form = $('.variations_form');
        $variations_form.on('hide_variation', function (event) {
            event.preventDefault();
            $variations_form.find('.motta-buy-now-button').addClass('disabled wc-variation-selection-needed');
        });


        $variations_form.on('show_variation', function (event, variation, purchasable) {
            event.preventDefault();
            if (purchasable) {
                $variations_form.find('.motta-buy-now-button').removeClass('disabled wc-variation-selection-needed');
            } else {
                $variations_form.find('.motta-buy-now-button').addClass('disabled wc-variation-selection-needed');
            }
        });
    };

    /**
     * Document ready
     */
    $(function () {
        buyNow();

        $('body').on('motta_product_quick_view_loaded', function () {
            buyNow();
        });
    });

})(jQuery);