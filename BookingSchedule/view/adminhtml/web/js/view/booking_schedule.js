define([
    'jquery',
    'uiComponent',
    'ko'
    ], function ($, Component, ko) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Magenest_BookingSchedule/form/booking_schedule'
            },
            initialize: function (config) {
                this.headers = ko.observableArray(config.bookingScheduleHeader);
                this.slot = ko.observableArray(config.bookingScheduleData);
                this._super();
            },
        });
    }
);
