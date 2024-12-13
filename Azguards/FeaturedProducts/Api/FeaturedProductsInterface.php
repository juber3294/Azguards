<?php
/**
 * @author Azguards Team
 * @copyright Copyright (c) Azguards
 * @package Featured Products for Magento 2
 */

declare(strict_types=1);

namespace Azguards\FeaturedProducts\Api;

use Azguards\FeaturedProducts\Api\Data\FeaturedProductInterface;

interface FeaturedProductsInterface
{
    /**
     * Retrieve a list of featured products.
     *
     * @return FeaturedProductInterface[]
     */
    public function getList();
}
