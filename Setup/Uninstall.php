<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory as ConfigCollectionFactory;

/**
 * Price Uninstall
 */
class Uninstall implements UninstallInterface
{
    /**
     * Config Collection Factory
     *
     * @var \Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory
     */
    private $_configCollectionFactory;

    /**
     * Initialize Setup
     *
     * @param ConfigCollectionFactory $configCollectionFactory
     */
    public function __construct(
		ConfigCollectionFactory $configCollectionFactory
	) {
        $this->_configCollectionFactory = $configCollectionFactory;
    }
    
    /**
     * Uninstall DB Schema for a Module Price
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        
        $this->removeTables($setup);
        $this->removeConfig();
        
        $setup->endSetup();
    }
    
    /**
     * Remove Tables
	 *
     * @param SchemaSetupInterface $setup
     * @return void
     */
    private function removeTables(SchemaSetupInterface $setup)
    {	
        $tableName = 'faonni_price_round_rule';
        if ($setup->tableExists($tableName)) {			
            $setup->getConnection()->dropTable($setup->getTable($tableName));
		}
    }
    
    /**
     * Remove Config
     *
     * @return void
     */
    private function removeConfig()
    {
        $path = 'currency/price';
        /** @var \Magento\Config\Model\ResourceModel\Config\Data\Collection $collection */
        $collection = $this->_configCollectionFactory->create(); 
        $collection->addPathFilter($path);

        foreach ($collection as $config) {
			$config->delete(); 	
        }
    }    
}