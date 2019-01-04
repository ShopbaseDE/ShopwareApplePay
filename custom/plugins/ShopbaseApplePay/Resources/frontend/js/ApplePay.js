/**
 * Apple Pay
 * Copyright (c) shopbase
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Check the Apple Pay Availability and Merchant Identifier
function getApplePayAvailability(merchantIdentifier = null) {
    if(merchantIdentifier !== undefined && merchantIdentifier !== null && merchantIdentifier !== "") {
        if(window.location.protocol == "https:" && window.ApplePaySession) {
            //if(ApplePaySession.canMakePayments()) {
                return true;
            //}
        }
    } else {
        console.error('[ApplePay] Merchant Identifier is undefined');
    }
    return false;
}

// Make sure that Apple Pay Button is displayed if it is available.
setInterval(function(){
    if(!ApplePayIsDisplayed) {
        $('button.apple-pay--button[data-isApplePay="true"]').each(function() {
            if(getApplePayAvailability(ApplePayMerchantIdentifier)) {
                $(this).addClass('apple-pay-active');
            }
        });
        ApplePayIsDisplayed = true;
    }
}, 1000);

// Payment Logic
$(document).ready(function() {
    var ApplePayHTMLSelector = 'button.apple-pay--button[data-isApplePay="true"]';
    var ApplePaySelector = $(ApplePayHTMLSelector);
    $('body').on('click', ApplePayHTMLSelector, function() {
        if(getApplePayAvailability(ApplePayMerchantIdentifier)) {
            //ToDo: ApplePay Ordering Process runs here
        }
        return false;
    });
});