<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Model\ResourceModel\Round;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Faonni\Price\Model\ResourceModel\Round\Rule\Import;
use Faonni\Price\Model\ResourceModel\Round\Rule\QueryFactory;
use Faonni\Price\Model\Round\Rule as RoundRule;

/**
 * Round Rule Resource
 */
class Rule extends AbstractDb
{
    /**
     * Scope Config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_coreConfig;

    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * Store Manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Round Rule
     *
     * @var \Faonni\Price\Model\ResourceModel\Round\Rule
     */
    protected $_roundRule;

    /**
     * Filesystem
     *
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;

    /**
     * Rule Import
     *
     * @var \Faonni\Price\Model\ResourceModel\Round\Rule\Import
     */
    protected $_import;

    /**
     * Rule Query Factory
     *
     * @var \Faonni\Price\Model\ResourceModel\Round\Rule\QueryFactory
     */
    protected $_queryFactory;

    /**
     * Initialize Resource
     * 
     * @param Context $context
     * @param LoggerInterface $logger
     * @param ScopeConfigInterface $coreConfig
     * @param StoreManagerInterface $storeManager
     * @param RoundRule $roundRule
     * @param Filesystem $filesystem
     * @param QueryFactory $queryFactory
     * @param Import $import
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger,
        ScopeConfigInterface $coreConfig,
        StoreManagerInterface $storeManager,
        RoundRule $roundRule,
        Filesystem $filesystem,
        Import $import,
        QueryFactory $queryFactory,
        $connectionName = null
    ) {
        $this->_coreConfig = $coreConfig;
        $this->_logger = $logger;
        $this->_storeManager = $storeManager;
        $this->_roundRule = $roundRule;
        $this->_filesystem = $filesystem;
        $this->_import = $import;
        $this->_queryFactory = $queryFactory;
        
        parent::__construct(
			$context, 
			$connectionName
		);        
    }
    
    /**
     * Define Main Table And Id Field Name
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faonni_price_round_rule', 'rule_id');
    }
}
