
// Hide empty featured section on elementor scripts init
// $( window ).on( 'elementor/frontend/init', function (){
//     setTimeout( function() {
//         // alert('Your code here');
//         if ($('.home-featured.empty')[0]) {
//             $('#job-listing').hide();
//         }
//     }, 1000 );
// } );

jQuery(document).ready(function($) {

    $('.select2-single').select2({
        selectionCssClass: 'jfwp-single-selector',
        dropdownCssClass: 'jfwp-single-dropdown',
        allowClear: true,
        // placeholder: 'Stadt auswählen'
    });

    $('.select2-single.no-search').select2({
        selectionCssClass: 'jfwp-single-selector',
        dropdownCssClass: 'jfwp-single-dropdown',
        minimumResultsForSearch: Infinity
    });

    if ($('.jfwp-jobs-count') && $('.jobs-regular-list')) {
        $('.jfwp-jobs-count').text($('.jobs-regular-list').data('jobs-info'))
    }

    if ($('.firma-positions-count') && $('.jobs-regular-list')) {
        $('.firma-positions-count').text($('.jobs-regular-list').data('jobs-info'))
    }


//    $("#burger").click(function() {
//        $(".siteNavigation").stop().toggleClass("active");
//        $("#burger, body").stop().toggleClass("open");
//    });
    //$(".site").css('padding-top', $(".siteHeader").outerHeight());
//    $(window).resize(function() {
//        $(".site").css('padding-top', $(".siteHeader").outerHeight());
//    });

//    function headerFixed() {
//        if ($(window).scrollTop() > 0) {
//            $(".siteHeader").addClass("fixed");
//            
//        } else {
//            $(".siteHeader").removeClass("fixed");
//           
//        }
//    }
//    $(window).scroll(function() {
//        headerFixed();
//    });
    $('#wpmj_search .search_jobs-reset').click( function (e) {
        e.preventDefault();
        window.location.href = $('#wpmj_search').attr('action');
    });

    $(".scroll-link").click(function(event) {
        event.preventDefault();
        var id = $(this).attr("href"),
            top = $(id).offset().top;
        $("body,html").animate({
            scrollTop: top
        }, 1500);
    });

    // ANCHORS
    $('a[href^="#"]').click(function(e) {
        if ($($.attr(this, 'href')).length > 0) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - $('.site-header').height()-100
            }, 1500);
        } else {
            $(this).attr('href', '/' + $.attr(this, 'href'));
        }
    });
    if (window.location.hash) {
        $('html, body').animate({
            scrollTop: $(window.location.hash).offset().top - $('.site-header').height()-100
        }, 1500);
    }
});
