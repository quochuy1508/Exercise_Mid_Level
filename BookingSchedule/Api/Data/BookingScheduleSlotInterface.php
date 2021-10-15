<?php

namespace Magenest\BookingSchedule\Api\Data;

interface BookingScheduleSlotInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID      = 'entity_id';
    const DAY_ID    = 'day_id';
    const TIME_ID    = 'time_id';
    const STOCK    = 'stock';
    const RESERVATION    = 'reservation';
    const USED    = 'used';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set ID
     *
     * @return BookingScheduleDayInterface
     */
    public function setEntityId($entityId);

    /**
     * Get day id
     *
     * @return int
     */
    public function getDayId();

    /**
     * Set day id
     *
     * @return BookingScheduleDayInterface
     */
    public function setDayId($dayId);

    /**
     * Get day id
     *
     * @return int
     */
    public function getTimeId();

    /**
     * Set day id
     *
     * @return BookingScheduleDayInterface
     */
    public function setTimeId($timeId);

    /**
     * Get day id
     *
     * @return int
     */
    public function getStock();

    /**
     * Set day id
     *
     * @return BookingScheduleDayInterface
     */
    public function setStock($reservation);

    /**
     * Get day id
     *
     * @return int
     */
    public function getReservation();

    /**
     * Set day id
     *
     * @return BookingScheduleDayInterface
     */
    public function setReservation($reservation);
}
