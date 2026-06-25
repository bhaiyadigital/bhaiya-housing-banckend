<script>
    window.addEventListener('load', function() {
        // ১. Swiper চেক করুন
        if (!window.Swiper) return;

        // 2. Count Up 2026
        const yrEl = document.getElementById('yr2026');

        function countUp(el, target) {
            let start = 1900;
            const timer = setInterval(() => {
                start += 5;
                if (start >= target) {
                    el.innerText = target;
                    clearInterval(timer);
                } else el.innerText = start;
            }, 20);
        }
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                countUp(yrEl, 2026);
                observer.disconnect();
            }
        });
        if (yrEl) observer.observe(yrEl);

        // 3. Hero Swiper
        const heroSwiper = new Swiper(".heroSwiper", {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
        });


        const TOTAL_SLIDES = 5;
        const AUTOPLAY_TIME = 5000;
        const deptSwiper = new Swiper('.departmentSwiper', {
            loop: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: AUTOPLAY_TIME,
                disableOnInteraction: false,
                pauseOnMouseEnter: false
            },
            on: {
                slideChange: function() {
                    updateProgressLines(this.realIndex);
                }
            }
        });

        function updateProgressLines(activeIndex) {
            for (let i = 0; i < TOTAL_SLIDES; i++) {
                const bar = document.getElementById(`progress-${i}`);
                const text = document.getElementById(`text-${i}`);
                if (!bar || !text) continue;

                if (i === activeIndex) {
                    text.className =
                        "mt-2 font-medium text-xs md:text-base transition-colors duration-300 text-white";
                } else {
                    text.className =
                        "mt-2 font-medium text-xs md:text-base transition-colors duration-300 text-white/40";
                }

                if (i < activeIndex) {
                    bar.className = "absolute top-0 left-0 h-full bg-white w-full transition-none";
                } else if (i === activeIndex) {
                    bar.className = "absolute top-0 left-0 h-full bg-white w-0";
                    void bar.offsetWidth; // Force Reflow
                    bar.className =
                        "absolute top-0 left-0 h-full bg-white w-full transition-all duration-[5000ms] ease-linear";
                } else {
                    bar.className = "absolute top-0 left-0 h-full bg-white w-0 transition-none";
                }
            }
        }
        updateProgressLines(0);

        const testiSwiper = new Swiper('.testiSwiper', {
            loop: true,
            speed: 800,
            spaceBetween: 50,
            grabCursor: false,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: '.testi-next',
                prevEl: '.testi-prev'
            },
            pagination: {
                el: '.testi-pagination',
                clickable: true
            },
        });
    });
</script>
<script>
    // 6. Click To Play Video Logic
    // Document level click listener for robust delegation
    document.addEventListener('click', function(e) {
        // Check if clicked element is our thumbnail
        const wrapper = e.target.closest('.thumbnail-wrapper');
        if (!wrapper) return;

        // Stop slider autoplay
        if (typeof testiSwiper !== 'undefined') {
            testiSwiper.autoplay.stop();
        }

        // Find video in the same container
        const container = wrapper.closest('.video-container');
        if (container) {
            const video = container.querySelector('video');
            if (video) {
                // Hide thumbnail, show and play video
                wrapper.classList.add('hidden');
                video.classList.remove('hidden');
                video.play();
            }
        }
    });

    // Reset Video when slide changes
    testiSwiper.on('slideChangeTransitionStart', function() {
        document.querySelectorAll('.video-container').forEach(container => {
            const video = container.querySelector('video');
            const thumbnail = container.querySelector('.thumbnail-wrapper');

            if (video && !video.paused) {
                video.pause();
            }

            if (video) video.classList.add('hidden');
            if (thumbnail) thumbnail.classList.remove('hidden');
        });

        // Resume slider
        testiSwiper.autoplay.start();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('chat-toggle-btn');
        const chatIcons = document.getElementById('chat-icons');
        let isOpen = false;

        toggleBtn.addEventListener('click', function() {
            isOpen = !isOpen;

            if (isOpen) {
                chatIcons.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                chatIcons.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
            } else {
                chatIcons.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                chatIcons.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
            }
        });
    });
    // ── News & Events text scroll animation ──
</script>
<script>
    window.addEventListener('load', function() {

        const hero = document.querySelector('.hero-fixed, [data-hero-fixed]');
        if (!hero) return;

        function onScroll(scrollY) {
            const heroH = hero.offsetHeight;
            const progress = Math.min(scrollY / heroH, 1);


            const translateY = progress * -30;
            hero.style.transform = `translateY(${translateY}%)`;
        }

        if (window.innerWidth > 768 && typeof lenis !== 'undefined') {
            lenis.on('scroll', ({
                scroll
            }) => onScroll(scroll));
        } else {
            window.addEventListener('scroll', () => onScroll(window.scrollY));
        }

    });
</script>
