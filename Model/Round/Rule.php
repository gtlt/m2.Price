<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Model\Round;

use Magento\Framework\Model\AbstractModel;

/**
 * Round Rule
 */
class Rule extends AbstractModel
{
    /**
     * Model Construct That Should Be Used For Object Initialization
     *
     * @return void
     */
    protected function _construct()
    {	
        $this->_init(
			'Faonni\Price\Model\ResourceModel\Round\Rule'
		);
    }
}
