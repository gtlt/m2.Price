<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Block\Adminhtml\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Import CSV Button
 */
class Import extends AbstractElement
{
    /**
     * Initialize Element
     * 
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setType('file');
    }
    
    /**
     * Retrieve Element Html
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = '<input id="time_condition" type="hidden" name="' . $this->getName() . '" value="' . time() . '" />';
        return $html . parent::getElementHtml();
    }    
}
