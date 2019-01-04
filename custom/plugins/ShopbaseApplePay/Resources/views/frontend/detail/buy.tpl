{extends file="parent:frontend/detail/buy.tpl"}

{block name="frontend_detail_buy_button"}
    {$smarty.block.parent}

    {block name="frontend_detail_buy_apple_pay_check"}
        <script>
            var ApplePayMerchantIdentifier = "{$apple_pay_merchant_identifier}";
            var ApplePayIsDisplayed = false;
        </script>
        <style>
            .apple-pay--button {
                -webkit-appearance: -apple-pay-button;
                -apple-pay-button-type: {$apple_pay_merchant_button_type};
                -apple-pay-button-style: {$apple_pay_merchant_button_style};
            }
        </style>
        {$lang_iso|@var_dump}
        {if $apple_pay_merchant_button_language|lower == "auto"}
            {assign var="applePayButtonLanguage" value="{$language_iso}"}
        {else}
            {assign var="applePayButtonLanguage" value="{$apple_pay_merchant_button_language|lower}"}
        {/if}

        {if $sArticle.sConfigurator && !$activeConfiguratorSelection}
            <button data-isApplePay="true" lang="{$applePayButtonLanguage}" class="apple-pay--button buybox--button block btn is--disabled is--icon-right is--large" disabled="disabled" aria-disabled="true" name="ApplePay"{if $buy_box_display} style="{$buy_box_display}"{/if}>
            </button>
        {else}
            <button data-isApplePay="true" lang="{$applePayButtonLanguage}" class="apple-pay--button block btn is--primary is--icon-right is--center is--large" name="ApplePay"{if $buy_box_display} style="{$buy_box_display}"{/if}>
            </button>
        {/if}
    {/block}
{/block}