<?php

namespace Magenest\BookingSchedule\Api\Data;

interface BookingScheduleTimeInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID      = 'entity_id';
    const TIME    = 'time';
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
     * Get day
     *
     * @return string
     */
    public function getTime();

    /**
     * Set Time
     *
     * @return BookingScheduleDayInterface
     */
    public function setTime($time);
}
