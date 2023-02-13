<?php

namespace Wheelpros\CatalogExtended\Block\Category;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Categorydata extends Template
{
    /**
     * @var Registry
     */
    private Registry $registry;
    /**
     * @var CategoryFactory
     */
    private CategoryFactory $categoryFactory;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param CategoryFactory $categoryFactory
     */
    public function __construct(
        Template\Context $context,
        Registry         $registry,
        CategoryFactory $categoryFactory,
        array            $data = []
    )
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @return mixed|null
     */
    public function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }
    public function getSiblingIds()
    {
        $category =  $this->registry->registry('current_category');
        $parentCategoryId = $category->getParentId();
        $parentCategory = $this->categoryFactory->create()->load($parentCategoryId);
        $childrenCategories = $parentCategory->getChildrenCategories();
        return array_column($childrenCategories->getData(), 'entity_id');
    }

    /**
     * @param $categoryId
     * @return \Magento\Catalog\Model\Category
     */
    public function getCategoryDataById($categoryId)
    {
        return $this->categoryFactory->create()->load($categoryId);
    }
}
