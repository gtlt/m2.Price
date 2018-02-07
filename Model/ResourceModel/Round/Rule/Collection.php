<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Model\ResourceModel\Round\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Round Rule Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize Collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
			'Faonni\Price\Model\Round\Rule', 
			'Faonni\Price\Model\ResourceModel\Round\Rule'
		);	
    } 
    
    /**
     * Add Store Filter To Collection
     *
     * @param array $storeIds
     * @return \Faonni\Price\Model\ResourceModel\Round\Rule\Collection
     */
    public function setStoreFilter(array $storeIds)
    {
        return $this->addFieldToFilter('store_id', ['in' => $storeIds]);
    }    
}
