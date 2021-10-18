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
            var url = urlBuilder.build("/admin/booking_schedule/slot/index?id=" + weekNumberFromNow);
            console.log(url);
            return storage.get(
                url,
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
