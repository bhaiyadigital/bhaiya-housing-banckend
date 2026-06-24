import "./bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// ১. গ্লোবাল এক্সেস (সবার আগে)
window.AOS = AOS;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
gsap.registerPlugin(ScrollTrigger);
window.isMobile = window.innerWidth < 1024;

const initApp = () => {
    // ২. AOS ও Parallax (মোবাইলে অফ রাখা হয়েছে স্পিড ১০০ করার জন্য)
    AOS.init({
        duration: 800,
        once: true,
        disable: window.isMobile,
    });

    if (!window.isMobile) {
        // ডেক্সটপ Parallax
        gsap.utils.toArray("[data-speed]").forEach((el) => {
            gsap.to(el, {
                y: (i, target) =>
                    (1 - parseFloat(target.dataset.speed || 1)) * 100,
                scrollTrigger: { trigger: el, scrub: true },
            });
        });

        // Quality Image Hover Zoom
        document.querySelectorAll(".quality-col").forEach((col) => {
            const wrap = col.querySelector(".quality-img-wrap");
            const img = col.querySelector(".quality-img");
            if (wrap && img) {
                col.addEventListener("mouseenter", () => {
                    wrap.style.width = "100%";
                    img.style.transform = "scale(1.06)";
                });
                col.addEventListener("mouseleave", () => {
                    wrap.style.width = "75%";
                    img.style.transform = "scale(1)";
                });
            }
        });
    }

    // ৩. Quality Border Line (Home Page)
    if (document.querySelector(".quality-border-line")) {
        gsap.to(".quality-border-line", {
            width: "100%",
            duration: 1.4,
            scrollTrigger: {
                trigger: "#quality-grid",
                start: "top 80%",
                once: true,
            },
        });
    }
};


// ৫. ভিডিও মোডাল ফাংশন
window.openVideoModal = () => {
    const modal = document.getElementById("videoModal");
    const video = document.getElementById("modalVideo");
    if (modal && video) {
        if (!video.src) {
            video.src = video.getAttribute("data-src");
            video.load();
        }
        modal.style.display = "flex";
        video.play();
    }
};

window.closeVideoModal = () => {
    const video = document.getElementById("modalVideo");
    if (video) video.pause();
    document.getElementById("videoModal").style.display = "none";
};
// ৪. হেডার লজিক (অপ্টিমাইজড)
const initHeader = () => {
    const header = document.getElementById("site-header");
    if (!header) return;
    let lastScroll = 0;

    window.addEventListener(
        "scroll",
        () => {
            const s = window.scrollY;
            // নিচে স্ক্রল করলে হাইড, উপরে করলে শো
            if (s > 100 && s > lastScroll) {
                header.style.transform = "translateY(-100%)";
            } else {
                header.style.transform = "translateY(0)";
                header.style.background = s > 80 ? "#152018" : "transparent";
            }
            lastScroll = s;
        },
        { passive: true },
    );
};
window.openMenu = () => {
    const overlay = document.getElementById("menuOverlay");
    if (overlay) {
        overlay.classList.add("is-open");
        overlay.style.pointerEvents = "all";
        document.body.style.overflow = "hidden";
    }
};

window.closeMenu = () => {
    const overlay = document.getElementById("menuOverlay");
    if (overlay) {
        overlay.classList.remove("is-open");
        overlay.style.pointerEvents = "none";
        document.body.style.overflow = "";
    }
};
window.hoverLink = (el) => {
    const img = el.getAttribute("data-img");
    const menuImg = document.getElementById("menuImage");
    if (img && menuImg) {
        menuImg.src = img;
    }
};
// সব লজিক উইন্ডো লোড হওয়ার পর রান করুন
window.addEventListener("load", () => {
    initApp();
    initHeader();
    if (window.AOS) window.AOS.refresh();
});
