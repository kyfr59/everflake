import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {

    /* Menu burger */
    $('#burger-btn').on('click', function () {
        const menu = $('#mobile-menu');
        const closed = menu.hasClass('max-h-0');

        menu.toggleClass('max-h-0 opacity-0', !closed);
        menu.toggleClass('max-h-[500px] opacity-100', closed);
        menu.toggleClass('hidden', !closed);
        menu.toggleClass('flex', closed);

        $('#icon-menu').toggleClass('hidden', closed);
        $('#icon-close').toggleClass('hidden', !closed);
    });
});