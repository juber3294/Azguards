<?php

namespace Azguards\FeaturedProducts\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public const MAX_PRODUCTS_DISPLAY_SIZE = 'featured_products/featured_products/max_products_display';
    /**
     * @var ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get Config Value Feature Product size
     *
     * @return mixed
     */
    public function getMaxFeaturedProductDisplay()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::MAX_PRODUCTS_DISPLAY_SIZE, $storeScope);
    }
}
