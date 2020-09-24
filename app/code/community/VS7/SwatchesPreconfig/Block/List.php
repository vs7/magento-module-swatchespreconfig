<?php

class VS7_SwatchesPreconfig_Block_List extends Mage_ConfigurableSwatches_Block_Catalog_Media_Js_List
{
    protected $_template = 'vs7_swatchespreconfig/js.phtml';

    public function getAttributesOptionsJson()
    {
        $attributeOptions = array();
        foreach ($this->getProducts() as $product) {
            if ($product->getTypeId() != Mage_Catalog_Model_Product_Type_Configurable::TYPE_CODE) {
                continue;
            }
            $productAttributeOptions = $product->getTypeInstance(true)->getConfigurableAttributesAsArray($product);
            foreach ($productAttributeOptions as $productAttribute) {
                foreach ($productAttribute['values'] as $attribute) {
                    $attributeOptions[$productAttribute['attribute_id']][strtolower($attribute['store_label'])] = $attribute['value_index'];
                }
            }
        }

        return Mage::helper('core')->jsonEncode($attributeOptions);
    }

    public function getProductsUrlJson()
    {
        $productsUrl = array();

        foreach ($this->getProducts() as $product) {
            $productsUrl[$product->getId()] = $product->getUrl();
        }

        return Mage::helper('core')->jsonEncode($productsUrl);
    }
}