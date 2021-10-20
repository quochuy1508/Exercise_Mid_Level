define([
    'jquery',
    'uiComponent',
    'ko',
    'Magenest_BookingSchedule/js/action/get-slot-data',
    'Magenest_BookingSchedule/js/action/copy_assignment',
    'Magenest_BookingSchedule/js/action/save_booking_schedule',
    'Magento_Ui/js/modal/modal'
    ], function ($, Component, ko, getSlotDataByWeek, copyAssignment, saveBookingSchedule, modal) {
        'use strict';
        var currentWeek = 0;

        return Component.extend({
            defaults: {
                template: 'Magenest_BookingSchedule/form/booking_schedule'
            },
            initialize: function (config) {
                this._super();
                this.headers = ko.observableArray(config.bookingScheduleHeader);
                this.slot = ko.observableArray(config.bookingScheduleData);
                this.numberOfWeekCopyToAssignment = ko.observable(1);
            },

            save: function () {
                this.slot([]);
                console.log("config.bookingScheduleData: ", this.slot());
            },

            getDataByPreviousWeek: function () {
                currentWeek -= 1;
                this.updateDataByWeek();
            },

            getDataByNextWeek: function () {
                currentWeek += 1;
                this.updateDataByWeek();
            },

            updateDataByWeek: function () {
                let that = this;
                let result = getSlotDataByWeek(currentWeek);
                //Show successfully for submit message
                result.done(function (response, textStatus, jqXHR) {
                    $('#loader').hide();
                    console.log(response)
                    console.log(textStatus)
                    that.slot(response.data);
                    that.headers(response.headerData);
                });

                //On failure of request this function will be called
                result.fail(function () {
                    //show error
                    alert("LOI NHE");
                });
            },

            openModal: function() {
                let that = this;
                var options = {
                    type: 'popup',
                    title: 'Number of week want to copy assignment',
                    focus: '[data-role="numberWeek"]',
                    buttons: [
                        {
                            text: $.mage.__('Cancel'),
                            class: '',
                            click: function () {
                                this.closeModal();
                            }
                        },
                        {
                            text: $.mage.__('Submit'),
                            class: '',
                            click: function () {
                                let modalWhenClick = this;
                                console.log(that.numberOfWeekCopyToAssignment());
                                let res = copyAssignment(that.numberOfWeekCopyToAssignment())
                                res.done(function (response, textStatus, jqXHR) {
                                    modalWhenClick.closeModal();
                                    return response;
                                });
                                //On failure of request this function will be called
                                res.fail(function () {
                                    //show error
                                    alert("LOI NHE");
                                    modalWhenClick.closeModal();
                                });
                            }
                        }
                    ]
                };

                var popup = modal(options, $('#popup-modal'));

                $('#popup-modal').modal('openModal');
            }
        });
    }
);
