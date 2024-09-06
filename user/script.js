// // Cursor

// var cursor = document.querySelector('.cursor');
// var cursorinner = document.querySelector('.cursor2');
// var a = document.querySelectorAll('a');

// document.addEventListener('mousemove', function(e){
// var x = e.clientX;
// var y = e.clientY;
// cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`
// });

// document.addEventListener('mousemove', function(e){
// var x = e.clientX;
// var y = e.clientY;
// cursorinner.style.left = x + 'px';
// cursorinner.style.top = y + 'px';
// });

// document.addEventListener('mousedown', function(){
// cursor.classList.add('click');
// cursorinner.classList.add('cursorinnerhover')
// });

// document.addEventListener('mouseup', function(){
// cursor.classList.remove('click')
// cursorinner.classList.remove('cursorinnerhover')
// });

// a.forEach(item => {
// item.addEventListener('mouseover', () => {
// cursor.classList.add('hover');
// });
// item.addEventListener('mouseleave', () => {
// cursor.classList.remove('hover');
// });
// })


// Paralax Effect in About Page
document.addEventListener('DOMContentLoaded', function() {
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

        inViewContents.forEach(function(content) {
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



// Loader
document.addEventListener('DOMContentLoaded', function () {
    const loaderContainer = document.querySelector('.loader-container');
    const textElement = document.querySelector('.text2');

    setTimeout(() => {
        // Wait for the fade-out transition to complete
        loaderContainer.addEventListener('transitionend', function () {
            // Wait an additional 0.5 seconds after the transition ends
            setTimeout(() => {
                loaderContainer.parentNode.removeChild(loaderContainer);
                document.body.style.overflow = 'auto';
                console.log("the loader is removed")
                console.log("wating for the animation")
            }, 500); // 0.5-second delay
        });
    }, 1000);
    
});

// Loader End



// Nav Responsive
var navLinks = document.getElementById("navLinks");

function showMenu() {
    navLinks.style.right = "0"
    navLinks.style.display = "block"
}

function hideMenu() {
    navLinks.style.right = "-200px"
    navLinks.style.display = "none"
}
// Nav Responsive End



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

// Shutdown Ticket Form

// async function checkFormStatus() {
//     try {
//         const response = await fetch('user/backend.php');
//         const data = await response.json();

//         if (data.formOpen === '1') {
//             document.getElementById('myForm').style.display = 'none';
//             document.getElementById('done_message').style.display = 'block';
//         } else {
//             document.getElementById('myForm').style.display = 'block';
//             document.getElementById('done_message').style.display = 'none';
//             // document.getElementById('done_message').innerText = '';
//         }
//     } catch (error) {
//         console.error('Error fetching form status:', error);
//     }
// }
// checkFormStatus()