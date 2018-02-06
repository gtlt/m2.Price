<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Model\Config\Backend;

use Magento\Framework\Registry;
use Magento\Framework\App\Config\Value;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Model\Context;
use Faonni\Price\Model\ResourceModel\Round\RuleFactory;

/**
 * Import Backend
 */
class Rule extends Value
{
    /**
     * Rule Factory
     *	
     * @var \Faonni\Price\Model\ResourceModel\Round\RuleFactory
     */
    protected $_ruleFactory;

    /**
     * Initialize Import Backend
     * 
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $config
     * @param TypeListInterface $cacheTypeList
     * @param RuleFactory $ruleFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        RuleFactory $ruleFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_ruleFactory = $ruleFactory;
        
        parent::__construct(
			$context, 
			$registry, 
			$config, 
			$cacheTypeList, 
			$resource, 
			$resourceCollection, 
			$data
		);
    }

    /**
     * Processing Object After Save Data
     *
     * @return $this
     */
    public function afterSave()
    {
        /** @var \Faonni\Price\Model\ResourceModel\Round\Rule $rule */
        $rule = $this->_ruleFactory->create();
        $rule->uploadAndImport($this);
        
        return parent::afterSave();
    }
}
