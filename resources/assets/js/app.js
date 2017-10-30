/* global jQuery */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import PxLoader from 'pxloader';
import 'pxloader/PxLoaderImage.js';

import './bootstrap';

/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    const Sage = {

        // All pages
        common: {
            init() {
                //* JavaScript to be fired on all pages
                console.log('=> app.common.init()');
            },
            finalize() {
                //* JavaScript to be fired on all pages, after page specific JS is fired
                console.log('=> app.common.finalize()');

                this.handleCookiesAcceptance();
                this.handleEvents();
            },
            handleCookiesAcceptance() {
                console.log('=> app.common.handleCookiesAcceptance()');

                // $('.j-acceptance').on('click', () => {
                //     Cookie.create('acceptance', true);
                //     $('.o-cookies-warning').fadeTo(400, 0, function () {
                //         $(this).remove();
                //     });
                // });
            },
            handleEvents() {
                console.log('=> app.common.handleEvents()');

                $('#needs-validation').submit(function (e) {
                    if ($(this)[0].checkValidity() === false) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    $(this).addClass('was-validated');
                });

                // $('#social-facebook').on('click', () => {
                //     gtag('event', 'perfil', {
                //         event_category: 'external',
                //         event_label: 'facebook',
                //     });
                // });

                // $('#social-twitter').on('click', () => {
                //     gtag('event', 'perfil', {
                //         event_category: 'external',
                //         event_label: 'twitter',
                //     });
                // });

                // $('#social-instagram').on('click', () => {
                //     gtag('event', 'perfil', {
                //         event_category: 'external',
                //         event_label: 'instagram',
                //     });
                // });
            },
        },

        messageShow: {
            init() {
                console.log('=> app.message.init()');

                Vue.component('responses', require('molecules/Responses.vue'));
                new Vue().$mount('#app');
            },
        },

        welcome: {
            init() {
                console.log('=> app.welcome.init()');

                this.loadImagesBeforeShowing();

                Vue.component('notifications', require('molecules/Notifications.vue'));
                new Vue().$mount('#app');
            },
            fadeOutWhiteWrapper() {
                console.log('=> app.welcome.fadeOutWhiteWrapper()');
                $('#white-wrapper').fadeOut(1200);
            },
            loadImagesBeforeShowing() {
                console.log('=> app.welcome.loadImagesBeforeShowing()');

                //* Create the loader and queue our images
                //* Images will not begin downloading until we tell the loader to start
                const loader = new PxLoader();
                loader.addImage('/images/favicon.ico');

                //* Callback that will be run once images are ready
                loader.addCompletionListener(() => {
                    this.fadeOutWhiteWrapper();
                });

                //* Begin downloading images
                loader.start();
            },
        },
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    const UTIL = {
        fire(func, funcname, args) {
            let fire;
            const namespace = Sage;
            const name = (funcname === undefined) ? 'init' : funcname;

            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][name] === 'function';

            if (fire) {
                namespace[func][name](args);
            }
        },

        loadEvents() {
            //* Fire common init JS
            UTIL.fire('common');

            //* Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), (i, classnm) => {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            //* Fire common finalize JS
            UTIL.fire('common', 'finalize');
        },
    };

    //* Load events
    $(document).ready(UTIL.loadEvents);
}(jQuery)); // Fully reference jQuery after this point
