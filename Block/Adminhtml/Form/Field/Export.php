<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\Price\Block\Adminhtml\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as ElementFactory;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Escaper;
use Magento\Backend\Block\Widget\Button;
use Magento\Backend\Model\UrlInterface;

/**
 * Export CSV Button
 */
class Export extends AbstractElement
{
    /**
     * Url Interface
     *	
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;

    /**
     * Initialize Button
     * 
     * @param ElementFactory $elementFactory
     * @param CollectionFactory $collectionFactory
     * @param Escaper $escaper
     * @param UrlInterface $backendUrl
     * @param array $data
     */
    public function __construct(
        ElementFactory $elementFactory,
        CollectionFactory $collectionFactory,
        Escaper $escaper,
        UrlInterface $backendUrl,
        array $data = []
    ) {
		$this->_backendUrl = $backendUrl;
         
        parent::__construct(
			$elementFactory, 
			$collectionFactory, 
			$escaper, 
			$data
		);
    }
    
    /**
     * Retrieve Element Html
     *
     * @return string
     */
    public function getElementHtml()
    {
        /** @var \Magento\Backend\Block\Widget\Button $button */
        $button = $this->getForm()->getParent()->getLayout()->createBlock(
            Button::class
        );
		$request = $button->getRequest();
        $url = $this->_backendUrl->getUrl(
			'*/*/exportPriceRoundRule', [
				'website' => $request->getParam('website'),
				'store' => $request->getParam('store')
		]);
        $data = [
            'label'   => __('Export CSV'),
            'onclick' => "setLocation('" .
            $url .
            "priceRoundRule.csv')",
            'class' => '',
        ];
        return $button->setData($data)->toHtml();
    }    
}
