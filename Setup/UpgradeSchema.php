<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Price Upgrade Schema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB Schema for a Module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.13', '<')) {
            $this->addLogTable($setup);
        }

        $setup->endSetup();
    }

    /**
     * Add Log Table
	 *
     * @param SchemaSetupInterface $setup
     * @return void
     */
    private function addLogTable(SchemaSetupInterface $setup)
    {
		$installer = $setup;
        $connection = $installer->getConnection();
		
        /**
         * Create table 'faonni_price_round_rule'
         */		
        $tableName = 'faonni_price_round_rule';
        if (!$installer->tableExists($tableName)) {
            $table = $connection->newTable(
					$installer->getTable($tableName)
				)
				->addColumn(
                    'rule_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'identity' => true, 'nullable' => false, 'primary' => true],
                    'Rule Id'
                )
				->addColumn(
					'store_id',
					Table::TYPE_SMALLINT,
					null,
					['unsigned' => true],
					'Store Id'
				)                
				->addColumn(
					'min_amount',
					Table::TYPE_DECIMAL,
					'12,4',
					[],
					'Min Amount'
				)                
				->addColumn(
					'max_amount',
					Table::TYPE_DECIMAL,
					'12,4',
					[],
					'Max Amount'
				)                 
				->addColumn(
					'enabled',
					Table::TYPE_SMALLINT,
					null,
					['unsigned' => true],
					'Enabled'
				) 
				->addColumn(
                    'type',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Rounding Type'
                )				
				->addColumn(
					'subtract',
					Table::TYPE_SMALLINT,
					null,
					['unsigned' => true],
					'Subtract Amount'
				) 				
				->addColumn(
					'amount',
					Table::TYPE_DECIMAL,
					'12,4',
					[],
					'Amount'
				) 
				->addColumn(
					'precision',
					Table::TYPE_SMALLINT,
					null,
					[],
					'Precision'
				) 	
				->addColumn(
					'show_decimal_zero',
					Table::TYPE_SMALLINT,
					null,
					['unsigned' => true],
					'Show Decimal Zeros'
				) 				
				->addColumn(
					'swedish_fraction',
					Table::TYPE_DECIMAL,
					'12,4',
					[],
					'Swedish Fraction'
				) 
				->addColumn(
					'position',
					Table::TYPE_SMALLINT,
					null,
					['unsigned' => true],
					'Position'
				) 				
				->addIndex(
					$installer->getIdxName($tableName, ['position']),
					['position']
				)	
				->addIndex(
					$installer->getIdxName($tableName, ['store_id']),
					['store_id']
				)	
				->addForeignKey(
					$installer->getFkName($tableName, 'store_id', 'store', 'store_id'),
					'store_id',
					$installer->getTable('store'),
					'store_id',
					Table::ACTION_CASCADE
				)				
				->setComment(
                    'Faonni Price Round Rule Table'
                );				
            $connection->createTable($table);		
		}
    }
}
