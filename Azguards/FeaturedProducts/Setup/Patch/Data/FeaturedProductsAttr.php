<?php
/**
 * @author Azguards Team
 * @copyright Copyright (c) Azguards
 * @package Featured Products for Magento 2
 */

declare(strict_types=1);

namespace Azguards\FeaturedProducts\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class FeaturedProductsAttr implements DataPatchInterface
{

    public const ENTITY_TYPE_ID = 'catalog_product';
    public const ATTRIBUTE_CODE = 'is_featured';

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetup
     *
     * @var EavSetup
     */
    private $eavSetupFactory;

    /**
     * ToggleProductAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Get Dependencies
     *
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Apply
     *
     * {@inheritdoc}
     */
    public function apply(): void
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            self::ENTITY_TYPE_ID,
            self::ATTRIBUTE_CODE,
            [
                'group' => 'General',
                'label' => 'Is Featured',
                'type' => 'int',
                'input' => 'boolean',
                'backend' => '',
                'frontend' => '',
                'class' => '',
                'source' => Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '0',
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable,grouped,virtual,bundle,downloadable'
            ]
        );
    }

    /**
     * Get Aliases
     *
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
