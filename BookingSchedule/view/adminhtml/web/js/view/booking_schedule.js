define([
    'jquery',
    'uiComponent',
    'ko',
    'Magenest_BookingSchedule/js/action/get-slot-data'
    ], function ($, Component, ko, getSlotDataByWeek) {
        'use strict';
        var currentWeek = 0;
        return Component.extend({
            defaults: {
                template: 'Magenest_BookingSchedule/form/booking_schedule'
            },
            initialize: function (config) {
                this.headers = ko.observableArray(config.bookingScheduleHeader);
                this.slot = ko.observableArray(config.bookingScheduleData);
                console.log("config.bookingScheduleData: ", config.bookingScheduleData);
                console.log("currentWeek: ", currentWeek);
                this._super();
            },

            save: function () {
                this.slot([]);
                console.log("config.bookingScheduleData: ", this.slot());
            },

            getDataByWeek: function (key) {
                currentWeek += parseInt(key);
                console.log("currentWeek: ", currentWeek);
                getSlotDataByWeek(currentWeek);
            }
        });
    }
);
