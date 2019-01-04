<?php
/**
 * Apple Pay
 * Copyright (c) shopbase
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ShopbaseApplePay;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

class ShopbaseApplePay extends Plugin
{
    /**
     * Executed on install plugin
     *
     * @param InstallContext $context
     */
    public function install(InstallContext $context)
    {
        parent::install($context);
    }

    /**
     * Executed on uninstall plugin
     *
     * @param UninstallContext $context
     */
    public function uninstall(UninstallContext $context)
    {
        $context->scheduleClearCache(UninstallContext::CACHE_LIST_ALL);

        if($context->keepUserData()) {
            return;
        }

        parent::uninstall($context);
    }

    /**
     * Executed on activate plugin
     *
     * @param ActivateContext $context
     */
    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(ActivateContext::CACHE_LIST_ALL);

        parent::activate($context);
    }

    /**
     * Executed on deactivate plugin
     *
     * @param DeactivateContext $context
     */
    public function deactivate(DeactivateContext $context)
    {
        $context->scheduleClearCache(DeactivateContext::CACHE_LIST_ALL);

        parent::deactivate($context);
    }

    /**
     * Add event to Shopware loading process
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_Frontend_Detail_index' => 'onCheckout',
        ];
    }

    /**
     * Hook into template
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onCheckout(\Enlight_Event_EventArgs $args)
    {
        $config = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName($this->getName(), Shopware()->Shop());
        $view = $args->getSubject()->View();

        $view->addTemplateDir($this->getPath() . '/Resources/views');
        $view->assign('apple_pay_merchant_identifier', $config['merchantIdentifier']);
        $view->assign('apple_pay_merchant_button_style', $config['buttonStyle']);
        $view->assign('apple_pay_merchant_button_type', $config['buttonType']);
        $view->assign('apple_pay_merchant_button_language', $config['buttonLanguage']);
        $view->assign('language_iso', 'en');
    }
}