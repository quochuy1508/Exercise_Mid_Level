<?php

namespace Magenest\BookingSchedule\Block\Adminhtml;

use Magenest\BookingSchedule\Api\GetBookingScheduleDataInterface;
use Magenest\BookingSchedule\Api\GetBookingScheduleTimeInterface;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\View\Element\Template;

class BookingSchedule extends Template
{
    /**
     * @var GetBookingScheduleDataInterface
     */
    private $getBookingScheduleData;

    /**
     * @var GetBookingScheduleTimeInterface
     */
    private $getBookingScheduleTime;

    public function __construct(
        Template\Context $context,
        GetBookingScheduleDataInterface $getBookingScheduleData,
        GetBookingScheduleTimeInterface $getBookingScheduleTime,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getBookingScheduleData = $getBookingScheduleData;
        $this->getBookingScheduleTime = $getBookingScheduleTime;
    }

    public function getBookingScheduleData()
    {
        return $this->getBookingScheduleData->execute();
    }

    public function getBookingScheduleTime()
    {
        return $this->getBookingScheduleTime->execute();
    }
}
