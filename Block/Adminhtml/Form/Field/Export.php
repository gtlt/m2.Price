<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Block\Adminhtml\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Export CSV button
 */
class Export extends AbstractElement
{
    /**
     * Backend Url
     * 
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;

    /**
     * Initialize Element
     * 
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Backend\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        array $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->_backendUrl = $backendUrl;
    }

    /**
     * @return string
     */
    public function getElementHtml()
    {
        /** @var \Magento\Backend\Block\Widget\Button $buttonBlock  */
        $buttonBlock = $this->getForm()->getParent()->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Button::class
        );

        $params = ['website' => $buttonBlock->getRequest()->getParam('website')];

        $url = $this->_backendUrl->getUrl("*/*/exportTablerates", $params);
        $data = [
            'label' => __('Export CSV'),
            'onclick' => "setLocation('" .
            $url .
            "conditionName/' + $('carriers_tablerate_condition_name').value + '/tablerates.csv' )",
            'class' => '',
        ];

        $html = $buttonBlock->setData($data)->toHtml();
        return $html;
    }
}
