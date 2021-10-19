define([
    'jquery',
    'uiComponent',
    'ko',
    'Magenest_BookingSchedule/js/action/get-slot-data',
    'Magento_Ui/js/modal/modal'
    ], function ($, Component, ko, getSlotDataByWeek, modal) {
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
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: 'popup modal title',
                    buttons: [{
                        text: $.mage.__('Continue'),
                        class: '',
                        click: function () {
                            this.closeModal();
                        }
                    }]
                };

                var popup = modal(options, $('#popup-modal'));

                $('#popup-modal').modal('openModal');
            }
        });
    }
);
