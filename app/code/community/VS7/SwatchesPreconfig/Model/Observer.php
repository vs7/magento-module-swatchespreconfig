<?php

class VS7_SwatchesPreconfig_Model_Observer
{
    public function swatchesPreconfig($observer)
    {
        $product = Mage::registry('current_product');
        if (
            empty($product)
            || $product->getId() == null
            || $product->getTypeId() != Mage_Catalog_Model_Product_Type_Configurable::TYPE_CODE
        ) {
            return;
        }

        $params = Mage::app()->getRequest()->getParams();
        if (count($params) == 0) {
            return;
        }

        $optionsArray = array();
        foreach ($params as $paramName => $paramValue) {
            if (preg_match('/^attribute(\d+)$/', $paramName, $matches)) {
                $optionsArray[$matches[1]] = $paramValue;
            }
        }

        $options = new Varien_Object();
        $options->setData('super_attribute', $optionsArray);
        $product->setPreconfiguredValues($options);
    }
}