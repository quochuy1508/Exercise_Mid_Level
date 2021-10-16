<?php

namespace Magenest\BookingSchedule\Model;

use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleSlot\Collection as SlotCollection;
use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleSlot\CollectionFactory as BookingScheduleSlotCollectionFactory;
use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleDay;
use Magenest\BookingSchedule\Model\ResourceModel\BookingScheduleTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class GetBookingScheduleData implements \Magenest\BookingSchedule\Api\GetBookingScheduleDataInterface
{
    const NAME_DAY_OF_WEEK = ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday'];
    /**
     * @var BookingScheduleSlotCollectionFactory
     */
    private $bookingScheduleSlotCollection;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    public function __construct(
        BookingScheduleSlotCollectionFactory $bookingScheduleSlotCollection,
        TimezoneInterface $localeDate
    ) {
        $this->bookingScheduleSlotCollection = $bookingScheduleSlotCollection;
        $this->localeDate                  = $localeDate;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var SlotCollection $collection */
        $collection = $this->bookingScheduleSlotCollection->create();

        $currentDate = $this->localeDate->date()->format("Y-m-d h:i:s");
        $monday = date('Y-m-d', strtotime('monday this week', strtotime($currentDate)));
        $sunday = date('Y-m-d', strtotime('monday next week', strtotime($currentDate)));

        $collection->getSelect()
            ->join(['day_table' => $collection->getTable(BookingScheduleDay::TABLE_NAME)], 'day_table.entity_id = main_table.day_id', 'day')
            ->where(
                'day_table.day >= ?',
                $monday
            )
            ->where(
                'day_table.day < ?',
                $sunday
            )
            ->order(['day_table.day ASC']);
        $result = [];

        foreach ($collection->getItems() as $item) {
            $dayOfWeek = self::NAME_DAY_OF_WEEK[date('w', strtotime($item['day']))];
            $dayAndMonth = $this->localeDate->date($item['day'])->format("d-m");
            $result[$dayOfWeek . ' ' . $dayAndMonth][$item['time_id']] = $item->getData();
        }
        return $result;
    }
}
