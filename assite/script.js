document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    let path = window.location.pathname;

    // Remove starting/ending slashes → "/aboutus/" → "aboutus"
    path = path.replace(/^\/|\/$/g, "");

    // Homepage case
    if (path === "" || path === "index.html") {
        path = "";
    }

    navLinks.forEach(link => {
        let href = link.getAttribute("href");

        // Remove "./" and slashes → "./aboutus/" → "aboutus"
        href = href.replace("./", "").replace(/^\/|\/$/g, "");

        link.classList.remove("active");

        if (path === href) {
            link.classList.add("active");
        }
    });
});

 
 
 const words = [
    "Modern Websites",
    "Google Ranking #1",
    "Social Media Growth",
    "Instant Leads",
    "PPC Advertising",
    "Real Customers"
];

let wordIndex = 0;
let charIndex = 0;

const typedText = document.querySelector(".typed-text");

const typingSpeed = 120;  // slow smooth typing
const erasingSpeed = 70;  // slow erase
const delayAfterComplete = 1200; // wait time

function type() {
    const word = words[wordIndex];
    typedText.textContent = word.substring(0, charIndex);
    charIndex++;

    if (charIndex <= word.length) {
        setTimeout(type, typingSpeed);
    } else {
        setTimeout(erase, delayAfterComplete);
    }
}

function erase() {
    const word = words[wordIndex];
    typedText.textContent = word.substring(0, charIndex);
    charIndex--;

    if (charIndex >= 0) {
        setTimeout(erase, erasingSpeed);
    } else {
        wordIndex = (wordIndex + 1) % words.length;
        setTimeout(type, 500);
    }
}

type();


        document.addEventListener("DOMContentLoaded", function () {
            const dropdownItems = document.querySelectorAll(".downbtnoption .dropdown-item");
            const dropdownBtn = document.querySelector(".dropdownbtnmain .dropdown-toggle");

            dropdownItems.forEach(item => {
                item.addEventListener("click", function (e) {
                    e.preventDefault();
                    dropdownBtn.textContent = this.textContent; // Selected text show
                });
            });
        });



         document.addEventListener("DOMContentLoaded", function () {
            const dropdownItems = document.querySelectorAll(".downbtnoption .dropdown-item");
            const dropdownBtn = document.querySelector(".dropdownbtnmain .dropdown-toggle");

            dropdownItems.forEach(item => {
                item.addEventListener("click", function (e) {
                    e.preventDefault();
                    dropdownBtn.textContent = this.textContent; // Selected text show
                });
            });
        });



$(".compnylogo").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    autoplay: true,
    
    smartSpeed: 6000,        // Smooth slow speed
    autoplayHoverPause: false,
    slideTransition: "linear", // Super smooth
    responsive:{
        0:{ items:2 },
        600:{ items:4 },
        1000:{ items:6 }
    }
});

//testmonial
 $(document).ready(function () {
            $('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                items: 1,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 800
            });
        });


const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const inc = target / 80;

        if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(updateCounter, 20);
        } else {
            counter.innerText = target;
        }
    };
    updateCounter();
});





