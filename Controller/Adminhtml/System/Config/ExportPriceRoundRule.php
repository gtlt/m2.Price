<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Controller\Adminhtml\System\Config;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action\Context;
use Magento\Config\Controller\Adminhtml\System\AbstractConfig;
use Magento\Config\Controller\Adminhtml\System\ConfigSectionChecker;
use Magento\Config\Model\Config\Structure;
use Magento\Store\Model\StoreManagerInterface;
use Faonni\Price\Block\Adminhtml\Round\Rule\Grid as RuleGrid;

/**
 * Export CSV Controller
 */
class ExportPriceRoundRule extends AbstractConfig
{
    /**
     * File Factory
     *	
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    /**
     * Store Manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Initialize Controller
     * 
     * @param Context $context
     * @param Structure $configStructure
     * @param ConfigSectionChecker $sectionChecker
     * @param FileFactory $fileFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        Structure $configStructure,
        ConfigSectionChecker $sectionChecker,
        FileFactory $fileFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        $this->_fileFactory = $fileFactory;
        
        parent::__construct(
			$context, 
			$configStructure, 
			$sectionChecker
		);
    }

    /**
     * Export shipping table rates in csv format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $fileName = 'priceRoundRule.csv';
        $storeId = $this->getRequest()->getParam('store');        
        $websiteId = $this->getRequest()->getParam('website');

        /** @var \Faonni\Price\Block\Adminhtml\Round\Rule\Grid $grid */
        $grid = $this->_view->getLayout()->createBlock(
            RuleGrid::class
        );
        
        if ($websiteId) {
			$grid->setWebsiteId($websiteId);
        }
        
        if ($storeId) {
			$grid->setStoreId($storeId);
        }
        
        return $this->_fileFactory->create(
			$fileName, 
			$grid->getCsvFile(), 
			DirectoryList::VAR_DIR
		);
    }
}
