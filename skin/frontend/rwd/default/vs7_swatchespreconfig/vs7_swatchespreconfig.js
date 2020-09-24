(function ($, window, document, undefined) {
    ConfigurableSwatchesList.init = function () {
        if ($('.product-view').length == 0) {
            $('.configurable-swatch-list li').each(function () {
                var $swatch = $(this);
                $swatch.off('click.vs7.swatchespreconfig').on('click.vs7.swatchespreconfig', function() {
                    var $anchor = $swatch.find('a').first();
                    var $result = $anchor.attr('class').match(/swatch-link-(\d+)/i);
                    var $attributeId = $result[1];
                    var $label = $(this).data('option-label');
                    var $productId = $(this).data('product-id');
                    var $productUrl = vs7.SwatchesPreconfig.productsUrl[$productId];
                    var $optionId = vs7.SwatchesPreconfig.attributesOptions[$attributeId][$label];
                    window.location.href = $productUrl + '#' + $attributeId + '=' + $optionId;
                });
            });
        }
    };
}(jQuery, window, document));