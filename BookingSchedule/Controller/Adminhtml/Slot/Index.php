<?php

namespace Magenest\BookingSchedule\Controller\Adminhtml\Slot;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        /* Create array for return value */
        $response['value1'] = "Value one";
        $response['value2'] = "Value Two";
        $response['value3'] = "Value Three";

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);  //create Json type return object
        $resultJson->setData($response);  // array value set in Json Result Data set

        return $resultJson; // return json object
    }
}
