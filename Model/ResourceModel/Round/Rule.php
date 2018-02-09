<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Model\ResourceModel\Round;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Round Rule Resource
 */
class Rule extends AbstractDb
{
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
