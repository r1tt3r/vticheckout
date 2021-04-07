<?php
namespace Vtic\Checkout\Plugin\Block\Magento\Checkout;


class LayoutProcessorPlugin
{
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    )
    {

        if(isset(
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['vat_id']
        )){
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['vat_id']
            ['validation'] =[
                'required-entry' => true,
            ];
        }


        $configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
        foreach ($configuration as $paymentGroup => $groupConfig) {
            if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {



                if(isset(
                    $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']
                    ['children']['vat_id']
                )){
                    $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']
                    ['children']['vat_id'] ['validation'] =[
                        'required-entry' => true,
                    ];
                }

            }
        }

        return $jsLayout;
    }

}