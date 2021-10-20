<?php

namespace Magenest\BookingSchedule\Model;

use Magenest\BookingSchedule\Api\DuplicateBookingScheduleInterface;
use Magenest\BookingSchedule\Model\BookingScheduleDay;
use Magenest\BookingSchedule\Model\BookingScheduleDayFactory;
use Magenest\BookingSchedule\Model\BookingScheduleSlot;
use Magenest\BookingSchedule\Model\BookingScheduleSlotFactory;
use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleSlot as SlotResourceModel;
use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleDay as DayResourceModel;
use Magento\Framework\Stdlib\DateTime\DateTime;

class DuplicateBookingSchedule implements DuplicateBookingScheduleInterface
{
    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var DayResourceModel
     */
    private $dayResourceModel;

    /**
     * @var BookingScheduleDayFactory
     */
    private $bookingScheduleDayFactory;

    public function __construct(
        DayResourceModel $dayResourceModel,
        DateTime                 $dateTime,
        BookingScheduleDayFactory                 $bookingScheduleDayFactory
    )
    {
        $this->dayResourceModel = $dayResourceModel;
        $this->dateTime = $dateTime;
        $this->bookingScheduleDayFactory = $bookingScheduleDayFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute($number)
    {
        $currentDate = $this->dateTime->date('Y-m-d h:i:s');
        $mondayNextWeek = date('Y-m-d h:i:s', strtotime('monday next week', strtotime($currentDate)));

        $dayIsNews = [];
        foreach (range(0, $number * 7) as $i) {
            /** @var BookingScheduleDay $dayModel */
            $dayModel = $this->bookingScheduleDayFactory->create();
            $day = $this->dateTime->gmtDate('Y-m-d H:i:s', strtotime('+' . $i . ' day', strtotime($mondayNextWeek)));
            $dayModel->setDay($day);
            $this->dayResourceModel->save($dayModel);
            $dayIsNews[] = $dayModel->getId();
        }
    }
}
