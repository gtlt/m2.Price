<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Block\Adminhtml\Round\Rule;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended as GridExtended;
use Magento\Backend\Helper\Data as BackendHelper;
use Faonni\Price\Model\ResourceModel\Round\Rule\CollectionFactory;
use Faonni\Price\Model\Round\Rule as RoundRule;

/**
 * Round Rule Grid
 */
class Grid extends GridExtended
{
    /**
     * Website Id
     *
     * @var int
     */
    protected $_websiteId;
    
    /**
     * Store Id
     *
     * @var int
     */
    protected $_storeId;    

    /**
     * Round Rule
     *	
     * @var \Faonni\Price\Model\Round\Rule
     */
    protected $_roundRule;

    /**
     * Round Rule Collection Factory
     *
     * @var \Faonni\Price\Model\ResourceModel\Round\Rule\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * Initialize Grid
     * 
     * @param Context $context
     * @param BackendHelper $backendHelper
     * @param CollectionFactory $collectionFactory
     * @param RoundRule $roundRule
     * @param array $data
     */
    public function __construct(
        Context $context,
        BackendHelper $backendHelper,
        CollectionFactory $collectionFactory,
        RoundRule $roundRule,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_roundRule = $roundRule;
        
        parent::__construct(
			$context, 
			$backendHelper, 
			$data
		);
    }

    /**
     * Define Grid Properties
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        
        $this->setId('PriceRoundRuleGrid');
        $this->_exportPageSize = 10000;
    }

    /**
     * Set Current Website
     *
     * @param int $websiteId
     * @return $this
     */
    public function setWebsiteId($websiteId)
    {
        $this->_websiteId = $this->_storeManager
			->getWebsite($websiteId)->getId();
        return $this;
    }

    /**
     * Retrieve Website Id
     *
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->_websiteId;
    }
    
    /**
     * Set Current Store
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->_storeId = $this->_storeManager
			->getStore($storeId)->getId();
        return $this;
    }

    /**
     * Retrieve Store Id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeId;
    }
    
    /**
     * Prepare shipping table rate collection
     *
     * @return \Faonni\Price\Block\Adminhtml\Round\Rule\Grid
     */
    protected function _prepareCollection()
    {
        $storeIds = null;
        if ($this->getStoreId()) {
			$storeIds = [$this->getStoreId()];
        }  elseif ($this->getWebsiteId()) {
			$storeIds = $this->_storeManager
				->getWebsite($this->getWebsiteId())
				->getStoreIds();
        }
        /** @var \Faonni\Price\Model\ResourceModel\Round\Rule\Collection $collection */
        $collection = $this->_collectionFactory->create();        
        if ($storeIds) {
			$collection->setStoreFilter($storeIds);
        }
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare Table Columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'store_id',
            ['header' => __('Store Id'), 'index' => 'store_id']
        );
        
        $this->addColumn(
            'min_amount',
            ['header' => __('Min Amount'), 'index' => 'min_amount']
        );
        
        $this->addColumn(
            'max_amount',
            ['header' => __('Max Amount'), 'index' => 'max_amount']
        );
        
        $this->addColumn(
            'type',
            ['header' => __('Rounding Type'), 'index' => 'type']
        );
        
        $this->addColumn(
            'subtract',
            ['header' => __('Subtract'), 'index' => 'subtract']
        );
        
        $this->addColumn(
            'amount',
            ['header' => __('Subtract Amount'), 'index' => 'amount']
        );
        
        $this->addColumn(
            'precision',
            ['header' => __('Precision'), 'index' => 'precision']
        );
        
        $this->addColumn(
            'show_decimal_zero',
            ['header' => __('Show Decimal Zeros'), 'index' => 'show_decimal_zero']
        ); 
        
        $this->addColumn(
            'swedish_fraction',
            ['header' => __('Swedish Fraction'), 'index' => 'swedish_fraction']
        );
        
        $this->addColumn(
            'position',
            ['header' => __('Position'), 'index' => 'position']
        ); 
        
        $this->addColumn(
            'enabled',
            ['header' => __('Enabled'), 'index' => 'enabled']
        ); 
        
        return parent::_prepareColumns();
    }
}
