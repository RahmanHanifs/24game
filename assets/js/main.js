// Ensure jQuery, AOS, and Swiper are declared or imported before use
const $ = window.jQuery
const AOS = window.AOS
const Swiper = window.Swiper

jQuery(document).ready(($) => {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
    })

    // Initialize Swiper for hero slider
    const heroSwiper = new Swiper(".hero-slider", {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
    })

    // Initialize Swiper for events
    const eventsSwiper = new Swiper(".events-slider", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    })

    // Animated counters
    function animateCounters() {
        $(".stat-number").each(function () {
            const $this = $(this)
            const countTo = $this.attr("data-count")

            $({ countNum: $this.text() }).animate(
                {
                    countNum: countTo,
                },
                {
                    duration: 2000,
                    easing: "linear",
                    step: function () {
                        $this.text(Math.floor(this.countNum))
                    },
                    complete: function () {
                        $this.text(this.countNum)
                    },
                },
            )
        })
    }

    // Trigger counter animation when in viewport
    $(window).scroll(() => {
        $(".stats-container").each(function () {
            const elementTop = $(this).offset().top
            const elementBottom = elementTop + $(this).outerHeight()
            const viewportTop = $(window).scrollTop()
            const viewportBottom = viewportTop + $(window).height()

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                if (!$(this).hasClass("animated")) {
                    $(this).addClass("animated")
                    animateCounters()
                }
            }
        })
    })

    // Search toggle
    $("#search-toggle").click(() => {
        $("#search-overlay").addClass("active")
        $("#search-overlay input").focus()
    })

    $("#search-close").click(() => {
        $("#search-overlay").removeClass("active")
    })

    // Aspirasi form submission
    $("#aspirasi-form").submit((e) => {
        e.preventDefault()

        const formData = {
            action: "bem_aspirasi",
            nonce: '<?php echo wp_create_nonce("bem_aspirasi_nonce"); ?>',
            nama: $('input[name="nama"]').val(),
            nim: $('input[name="nim"]').val(),
            email: $('input[name="email"]').val(),
            aspirasi: $('textarea[name="aspirasi"]').val(),
        }

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: "POST",
            data: formData,
            beforeSend: () => {
                $("#aspirasi-form button").text("Mengirim...").prop("disabled", true)
            },
            success: (response) => {
                if (response.success) {
                    alert("Aspirasi berhasil dikirim!")
                    $("#aspirasi-form")[0].reset()
                } else {
                    alert("Gagal mengirim aspirasi: " + response.data)
                }
            },
            error: () => {
                alert("Terjadi kesalahan. Silakan coba lagi.")
            },
            complete: () => {
                $("#aspirasi-form button").text("Kirim Aspirasi").prop("disabled", false)
            },
        })
    })

    // Smooth scrolling for anchor links
    $('a[href^="#"]').click(function (e) {
        e.preventDefault()

        const target = $($(this).attr("href"))
        if (target.length) {
            $("html, body").animate(
                {
                    scrollTop: target.offset().top - 100,
                },
                800,
            )
        }
    })

    // Mobile menu toggle
    $(".mobile-menu-toggle").click(() => {
        $(".main-menu").toggleClass("active")
    })

    // Newsletter form
    $(".newsletter-form").submit(function (e) {
        e.preventDefault()
        const email = $(this).find('input[type="email"]').val()

        // Add your newsletter subscription logic here
        alert("Terima kasih! Anda telah berlangganan newsletter kami.")
        $(this)[0].reset()
    })
})
