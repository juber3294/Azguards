<?php
/**
 * @author Azguards Team
 * @copyright Copyright (c) Azguards
 * @package Featured Products for Magento 2
 */

declare(strict_types=1);

namespace Azguards\FeaturedProducts\Model;

use Azguards\FeaturedProducts\Api\Data\FeaturedProductInterface;
use Azguards\FeaturedProducts\Api\FeaturedProductsInterface;
use Azguards\FeaturedProducts\Helper\Data as AzguardsHelper;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class FeaturedProducts implements FeaturedProductsInterface
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var AzguardsHelper
     */
    private $dataHelper;

    /**
     * FeaturedProducts constructor.
     *
     * @param CollectionFactory $productCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param AzguardsHelper $dataHelper
     */
    public function __construct(
        CollectionFactory $productCollectionFactory,
        StoreManagerInterface $storeManager,
        AzguardsHelper $dataHelper
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->storeManager = $storeManager;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Get List Featured Products
     *
     * @return FeaturedProductInterface[]|false|string
     * @throws NoSuchEntityException
     */
    public function getList()
    {
        $collection = $this->productCollectionFactory->create();
        $featuredProductSize = $this->dataHelper->getMaxFeaturedProductDisplay();
        $collection->addAttributeToSelect(['name', 'price', 'thumbnail'])
            ->addAttributeToFilter('is_featured', 1)
            ->setPageSize($featuredProductSize);
        $products = [];
        foreach ($collection as $product) {
            $products[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'thumbnail' => $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .
                    'catalog/product' . $product->getThumbnail()
            ];
        }
        return $products;
    }
}
