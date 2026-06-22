import "./bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    // 1. AOS
    AOS.init({
        duration: 800,
        once: true,
        disable: window.innerWidth < 768,
    });

    const initHeavyTools = async () => {
        if (document.querySelector(".swiper")) {
            const { default: Swiper } = await import("swiper/bundle");
            await import("swiper/css/bundle");
            // স্লাইডার কোড এখানে লিখুন
        }

        if (document.querySelector("[data-speed]")) {
            const { gsap } = await import("gsap");
            const { ScrollTrigger } = await import("gsap/ScrollTrigger");
            gsap.registerPlugin(ScrollTrigger);

            gsap.utils.toArray("[data-speed]").forEach((el) => {
                gsap.to(el, {
                    y: (i, target) =>
                        (1 - parseFloat(target.dataset.speed || 1)) *
                        ScrollTrigger.maxScroll(window) *
                        0.1,
                    ease: "none",
                    scrollTrigger: { trigger: el, scrub: true },
                });
            });
        }
    };
    initHeavyTools();

    // 2. Optimized Scroll & Header
     const header = document.getElementById("site-header");
    let lastScroll = 0;
    window.addEventListener("scroll", () => {
        const s = window.scrollY;
        if (s > 100 && s > lastScroll) header?.classList.add("hide");
        else header?.classList.remove("hide");
        lastScroll = s;
    }, { passive: true });

    // 3. GSAP Logic (Optimized)
    gsap.utils.toArray("[data-speed]").forEach((el) => {
        gsap.to(el, {
            y: (i, target) =>
                (1 - parseFloat(target.dataset.speed || 1)) *
                ScrollTrigger.maxScroll(window) *
                0.1,
            ease: "none",
            scrollTrigger: { trigger: el, scrub: true },
        });
    });

    // 4. Cursor Logic (Use translate3d for GPU)
    const dot = document.getElementById("cursor-dot");
    if (dot && window.matchMedia("(pointer: fine)").matches) {
        let mX = 0,
            mY = 0,
            dX = 0,
            dY = 0;
        window.addEventListener(
            "mousemove",
            (e) => {
                mX = e.clientX;
                mY = e.clientY;
            },
            { passive: true },
        );

        const anim = () => {
            dX += (mX - dX) * 0.15;
            dY += (mY - dY) * 0.15;
            dot.style.transform = `translate3d(${dX}px, ${dY}px, 0) translate(-50%, -50%)`;
            requestAnimationFrame(anim);
        };
        anim();
    }
});
