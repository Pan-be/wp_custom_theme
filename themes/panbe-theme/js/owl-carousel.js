$(".owl-carousel").owlCarousel({
    loop: true,
    margin: 0,
    navText: [],
    center: true,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        1000: {
            items: 3
        }
    }
});