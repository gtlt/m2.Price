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
     * Enter description here...
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = '';

        $html .= '<input id="time_condition" type="hidden" name="' . $this->getName() . '" value="' . time() . '" />';

        $html .= <<<EndHTML
        <script>
        //require(['prototype'], function(){
        //Event.observe($('carriers_tablerate_condition_name'), 'change', checkConditionName.bind(this));
        //function checkConditionName(event)
        //{
        //    var conditionNameElement = Event.element(event);
        //    if (conditionNameElement && conditionNameElement.id) {
        //        $('time_condition').value = '_' + conditionNameElement.value + '/' + Math.random();
        //    }
        //}
        //});
        </script>
EndHTML;

        $html .= parent::getElementHtml();

        return $html;
    }
}
