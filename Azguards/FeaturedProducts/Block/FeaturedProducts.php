<?php
/**
 * @author Azguards Team
 * @copyright Copyright (c) Azguards
 * @package Featured Products for Magento 2
 */

declare(strict_types=1);

namespace Azguards\FeaturedProducts\Block;

use Azguards\FeaturedProducts\Helper\Data as AzguardsHelper;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Helper\Output as OutputHelper;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;
use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManagerInterface;

class FeaturedProducts extends ListProduct
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var AzguardsHelper
     */
    private $dataHelper;
    /**
     * @var Image
     */
    private $imageHelper;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * FeaturedProducts constructor.
     *
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param StoreManagerInterface $storeManager
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Data $urlHelper
     * @param AzguardsHelper $dataHelper
     * @param Image $imageHelper
     * @param CollectionFactory $productCollectionFactory
     * @param array $data
     * @param OutputHelper|null $outputHelper
     */
    public function __construct(
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        StoreManagerInterface $storeManager,
        CategoryRepositoryInterface $categoryRepository,
        Data $urlHelper,
        AzguardsHelper $dataHelper,
        Image $imageHelper,
        CollectionFactory $productCollectionFactory,
        array $data = [],
        ?OutputHelper $outputHelper = null
    ) {
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data,
            $outputHelper
        );
        $this->productCollectionFactory = $productCollectionFactory;
        $this->dataHelper = $dataHelper;
        $this->imageHelper = $imageHelper;
        $this->storeManager = $storeManager;
    }

    /**
     * Get Featured Products
     *
     * @return Collection
     */
    public function getFeaturedProducts()
    {

        $collection = $this->productCollectionFactory->create();
        $featureProductSize = $this->getMaxFeaturedProductDisplay();
        $collection->addAttributeToSelect(['name', 'price', 'thumbnail'])
            ->addAttributeToFilter('is_featured', 1)
            ->setPageSize($featureProductSize)->addMediaGalleryData();
        return $collection;
    }

    /**
     * Get Config Value Feature Product size
     *
     * @return mixed
     */
    public function getMaxFeaturedProductDisplay()
    {
        return $this->dataHelper->getMaxFeaturedProductDisplay();
    }

    /**
     * This function call ProductImageUrl
     *
     * @param string $product
     * @return string
     */
    public function getProductImageUrl($product)
    {
        return $this->imageHelper->init($product, 'product_thumbnail_image')->getUrl();
    }

    /**
     * Get Media Url
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl()
    {
        return $this ->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
