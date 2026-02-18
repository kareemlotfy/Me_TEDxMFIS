

// Nav JS
    // Elements
    const mainNav = document.getElementById('mainNav');
    const scrollTop = document.getElementById('scrollTop');
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
    const sectionDots = document.querySelectorAll('.section-dot');

    let lastScroll = 0;

    // Hide/Show Nav on Scroll
    function handleNavScroll() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            mainNav.classList.add('scrolled');
        } else {
            mainNav.classList.remove('scrolled');
        }

        if (currentScroll > lastScroll && currentScroll > 200) {
            mainNav.classList.add('hidden');
        } else {
            mainNav.classList.remove('hidden');
        }

        lastScroll = currentScroll;
    }

    // Show/Hide Section Nav and Scroll Top
    function handleElementsVisibility() {
        const scrollPosition = window.pageYOffset;

        if (scrollPosition > 300) {
            scrollTop.classList.add('visible');
        } else {
            scrollTop.classList.remove('visible');
        }
    }

    // Smooth Scroll
    function smoothScroll(target) {
        const element = document.querySelector(target);
        if (element) {
            window.scrollTo({
                top: element.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    }

    // Mobile Menu Toggle
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Close mobile menu when link clicked
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const target = link.getAttribute('href');
            
            // Check if the link is an anchor (starts with #)
            if (target.startsWith('#')) {
                e.preventDefault(); // Stop default only for anchors
                
                // Close menu
                menuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
                
                smoothScroll(target);
            } 
            // If it doesn't start with # (like 'About/index.html'), 
            // we do NOTHING here, letting the browser navigate normally.
        });
    });

    // Scroll to top
    scrollTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Logo click
    document.querySelector('.nav-logo').addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Scroll Events
    window.addEventListener('scroll', () => {
        handleNavScroll();
        handleElementsVisibility();
    });

    // Initial calls
    handleElementsVisibility();





// Paralax Effect in About Page
document.addEventListener('DOMContentLoaded', function () {
    const abtContents = document.querySelectorAll('.abt-content');

    const observerOptions = {
        root: null, // Use the viewport as the root
        threshold: 0.01 // Trigger when 50% of the element is visible
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            } else {
                entry.target.classList.remove('in-view');
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);

    abtContents.forEach(content => {
        observer.observe(content);
    });

    function parallaxEffect() {
        const inViewContents = document.querySelectorAll('.abt-content.in-view');
        let scrollPosition = window.pageYOffset;

        inViewContents.forEach(function (content) {
            const secondImg = content.querySelector('.second_img');
            let contentOffsetTop = content.getBoundingClientRect().top + scrollPosition - window.innerHeight / 2;
            if (scrollPosition + window.innerHeight > contentOffsetTop) {
                let translateY = ((scrollPosition + window.innerHeight / 2 - contentOffsetTop) * 0.25) - 50; // Adjust speed and initial offset
                secondImg.style.transform = `translateY(-${translateY}px)`;
            }
        });
    }

    // Check visibility on load
    function checkVisibilityOnLoad() {
        abtContents.forEach(content => {
            let rect = content.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                content.classList.add('in-view');
            } else {
                content.classList.remove('in-view');
            }
        });
        parallaxEffect(); // Apply parallax effect based on initial visibility
    }

    checkVisibilityOnLoad();
    window.addEventListener('scroll', parallaxEffect);
});
// Paralax End


// Set padding of class="body_section"
function setDynamicPadding() {
    var windowWidth = window.innerWidth;

    // Check if window width is less than or equal to 600px
    if (windowWidth <= 600) {
        // Remove inline styles added by JavaScript
        var elements = document.querySelectorAll('.body_section');
        elements.forEach(function (element) {
            element.style.removeProperty('padding-left');
            element.style.removeProperty('padding-right');
        });
        return; // Exit the function
    }

    var mainContentWidth = document.querySelector('.inner_content').offsetWidth;
    var paddingValue = windowWidth - mainContentWidth;
    var paddingLR = paddingValue / 2;

    // Apply padding to the desired class
    var elements = document.querySelectorAll('.body_section');
    elements.forEach(function (element) {
        element.style.paddingLeft = paddingLR + 'px';
        element.style.paddingRight = paddingLR + 'px';
    });
}

// Call the function initially and on window resize
window.onload = setDynamicPadding;
window.addEventListener('resize', setDynamicPadding);
// Set padding End


// About Us Page Images Resize 
// Function to resize elements based on screen width
function resizeElements() {
    let screenWidth = window.innerWidth;

    if (screenWidth <= 600) {
        // Get all div elements
        const firstImgs = document.querySelectorAll('.first_img');
        const secondImgs = document.querySelectorAll('.second_img');
        const abtLefts = document.querySelectorAll('.abt-left');
        const abtRights = document.querySelectorAll('.abt-right');

        // Initial widths
        let firstImgInitialWidth = 400;
        let secondImgInitialWidth = 200;
        let abtInitialWidth = 500;

        // Calculate how much the screen width has decreased from 600px
        let widthDifference = 600 - screenWidth;

        // Adjust the widths
        let newFirstImgWidth = firstImgInitialWidth - (0.75 * widthDifference);
        let newSecondImgWidth = secondImgInitialWidth - (0.375 * widthDifference);
        let newAbtWidth = newFirstImgWidth + (newSecondImgWidth / 2);

        // Ensure widths don't go negative
        if (newFirstImgWidth > 0) {
            firstImgs.forEach(firstImg => {
                firstImg.style.width = newFirstImgWidth + 'px';
            });
        }

        if (newSecondImgWidth > 0) {
            secondImgs.forEach(secondImg => {
                secondImg.style.width = newSecondImgWidth + 'px';
            });
        }

        if (newAbtWidth > 0) {
            abtLefts.forEach(abtLeft => {
                abtLeft.style.width = newAbtWidth + 'px';
            });
            abtRights.forEach(abtRight => {
                abtRight.style.width = newAbtWidth + 'px';
            });
        }
    } else {
        return
    }
}

// Call the resize function when DOM is fully loaded
document.addEventListener('DOMContentLoaded', resizeElements);

// Call the resize function whenever the window is resized
window.addEventListener('resize', resizeElements);

// About Us End