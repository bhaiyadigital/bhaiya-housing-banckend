<script>
    let testiSwiper;

    window.addEventListener('load', function() {
        if (!window.Swiper) return;

        // --- Count Up Logic ---
        const yrEl = document.getElementById('yr2026');
        if (yrEl) {
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
            observer.observe(yrEl);
        }

        // --- Hero Swiper ---
        new Swiper(".heroSwiper", {
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
        setTimeout(() => {
            // --- Department Swiper ---
            const deptSwiper = new Swiper('.departmentSwiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                on: {
                    slideChange: function() {
                        updateProgressLines(this.realIndex);
                    }
                }
            });

            function updateProgressLines(activeIndex) {
                for (let i = 0; i < 5; i++) {
                    const bar = document.getElementById(`progress-${i}`);
                    const text = document.getElementById(`text-${i}`);
                    if (!bar || !text) continue;
                    if (i === activeIndex) {
                        text.className =
                            "mt-2 font-medium text-xs md:text-base transition-colors duration-300 text-white";
                        bar.className = "absolute top-0 left-0 h-full bg-white w-0";
                        void bar.offsetWidth;
                        bar.className =
                            "absolute top-0 left-0 h-full bg-white w-full transition-all duration-[5000ms] ease-linear";
                    } else {
                        text.className =
                            "mt-2 font-medium text-xs md:text-base transition-colors duration-300 text-white/40";
                        bar.className = i < activeIndex ?
                            "absolute top-0 left-0 h-full bg-white w-full" :
                            "absolute top-0 left-0 h-full bg-white w-0";
                    }
                }
            }
            updateProgressLines(0);

            // --- Testimonial Swiper  ---
            testiSwiper = new Swiper('.testiSwiper', {
                loop: true,
                speed: 800,
                spaceBetween: 50,
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

            if (testiSwiper) {
                testiSwiper.on('slideChangeTransitionStart', function() {
                    resetAllVideos();
                    testiSwiper.autoplay.start();
                });
            }
            document.querySelectorAll('video source[data-src]').forEach(source => {
                const srcValue = source.dataset.src;

                if (srcValue && srcValue !== "undefined" && srcValue !== "" && srcValue !==
                    "null") {
                    source.src = srcValue;
                    const video = source.parentElement;
                    video.load();
                    if (video.hasAttribute('autoplay')) {
                        video.play().catch(e => {});
                    }
                } else {
                    source.parentElement.style.display = 'none';
                }
            });
        }, 1500);
    });


    function resetAllVideos() {
        document.querySelectorAll('.video-container').forEach(container => {
            const video = container.querySelector('video');
            const thumbnail = container.querySelector('.thumbnail-wrapper');
            if (video) {
                video.pause();
                video.classList.add('hidden');
            }
            if (thumbnail) thumbnail.classList.remove('hidden');
        });
    }

    document.addEventListener('click', function(e) {
        const wrapper = e.target.closest('.thumbnail-wrapper');
        if (!wrapper) return;

        if (testiSwiper && testiSwiper.autoplay) {
            testiSwiper.autoplay.stop();
        }

        const container = wrapper.closest('.video-container');
        if (container) {
            const video = container.querySelector('video');
            if (video) {
                wrapper.classList.add('hidden');
                video.classList.remove('hidden');
                video.play();
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('chat-toggle-btn');
        const chatIcons = document.getElementById('chat-icons');
        if (toggleBtn && chatIcons) {
            let isOpen = false;
            toggleBtn.addEventListener('click', function() {
                isOpen = !isOpen;
                chatIcons.classList.toggle('opacity-0', !isOpen);
                chatIcons.classList.toggle('translate-y-6', !isOpen);
                chatIcons.classList.toggle('pointer-events-none', !isOpen);
                chatIcons.classList.toggle('opacity-100', isOpen);
                chatIcons.classList.toggle('translate-y-0', isOpen);
                chatIcons.classList.toggle('pointer-events-auto', isOpen);
            });
        }
    });

    window.addEventListener('load', function() {
        const hero = document.querySelector('.hero-fixed, [data-hero-fixed]');
        if (!hero) return;

        function onScroll(scrollY) {
            const progress = Math.min(scrollY / hero.offsetHeight, 1);
            hero.style.transform = `translateY(${progress * -30}%)`;
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
<script>
    // ==========================================
    // ── Custom Trailing & Magnetic Cursor Logic ──
    // ==========================================
    setTimeout(() => {
        const dot = document.getElementById('cursor-dot');

        if (window.matchMedia("(pointer: fine)").matches && dot) {
            let mouseX = window.innerWidth / 2;
            let mouseY = window.innerHeight / 2;
            let dotX = window.innerWidth / 2;
            let dotY = window.innerHeight / 2;
            let magneticElement = null;

            window.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function animateCursor() {
                let targetX = mouseX;
                let targetY = mouseY;

                if (magneticElement) {
                    const rect = magneticElement.getBoundingClientRect();
                    targetX = rect.left + (rect.width / 2);
                    targetY = rect.top + (rect.height / 2);
                }

                dotX += (targetX - dotX) * 0.15;
                dotY += (targetY - dotY) * 0.15;

                dot.style.transform = `translate(${dotX}px, ${dotY}px) translate(-50%, -50%)`;

                requestAnimationFrame(animateCursor);
            }
            animateCursor();

            document.addEventListener('mouseover', (e) => {
                const largeTarget = e.target.closest('.hover-lg');
                const normalTarget = e.target.closest(
                    'a, button, input[type="submit"], input[type="button"], .cursor-pointer');

                if (largeTarget) {
                    magneticElement = largeTarget;
                    dot.classList.add('active-large');
                    dot.classList.remove('active');
                } else if (normalTarget) {
                    dot.classList.add('active');
                    dot.classList.remove('active-large');
                }
            });

            document.addEventListener('mouseout', (e) => {
                const largeTarget = e.target.closest('.hover-lg');
                const normalTarget = e.target.closest(
                    'a, button, input[type="submit"], input[type="button"], .cursor-pointer');

                if (largeTarget) {
                    magneticElement = null;
                    dot.classList.remove('active-large');
                } else if (normalTarget) {
                    dot.classList.remove('active');
                }
            });
        }
    }, 3000);
    // ==========================================
</script>
