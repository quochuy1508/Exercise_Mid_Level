/*global define,alert*/
define(
    [
        'ko',
        'jquery',
        'mage/storage',
        'mage/translate',
        'mage/url'
    ],
    function (
        ko,
        $,
        storage,
        $t,
        urlBuilder
    ) {
        'use strict';
        return function (weekNumberFromNow) {
            'use strict';
            return storage.get(
                'booking_schedule/slot/index?id=' + weekNumberFromNow,
                false
            ).done(
                function (response) {
                    if (response) {
                        console.log(v)
                    }
                }
            ).fail(
                function (response) {
                }
            );
        };
    }
);
