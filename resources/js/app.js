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

    /* Scroll fluide */
    $(document).on('click', '.scroll-link', function (e) {
        e.preventDefault();

        const $target = $('#' + $(this).data('target'));

        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 80
            }, 500);
        }

        // Ferme le menu mobile
        $('#mobile-menu')
            .addClass('max-h-0 opacity-0 hidden')
            .removeClass('max-h-[500px] opacity-100');

        $('#icon-menu').removeClass('hidden');
        $('#icon-close').addClass('hidden');
    });

});