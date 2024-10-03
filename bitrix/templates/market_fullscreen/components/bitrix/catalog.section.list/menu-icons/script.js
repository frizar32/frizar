$(document).ready(function (){

    $('[data-trigger-section]').on('mouseenter', function (){
        $('[data-target-section="'+$(this).data('trigger-section')+'"]')
            .addClass('visible')
            .siblings('[data-target-section]').removeClass('visible')
    });

    $('.aside-catalog-menu__list').on('mouseleave', function (){
        $('[data-target-section]').removeClass('visible');
    });

});