import './bootstrap';
import '../css/app.css';

import Turbolinks from "turbolinks"

Turbolinks.start()


$(document).on('turbolinks:click', function () {
    $('img')
        .addClass('animated fadeOut')
        .off('webkitAnimationEnd oanimationend msAnimationEnd animationend')
});$(document).on('turbolinks:load', function (event) {
    if (event.originalEvent.data.timing.visitStart) {
        $('img')
            .addClass('animated fadeIn')
            .one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
                $('img').removeClass('animated');
            });
    } else {
        $('img').removeClass('hide')
    }
});
