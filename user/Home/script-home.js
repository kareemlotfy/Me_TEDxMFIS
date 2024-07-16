// JS Code With Slick 
// Code For Making Slide To Schedule Container
$(document).ready(function () {
    $('.schedule_container').slick({
      infinite: false,
      slidesToShow: 5,
      slidesToScroll: 0,
      autoplay: false,
      // autoplaySpeed: 2000,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: false,
            dots: true
          }
        },
        {
          breakpoint: 799,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });

  $(document).ready(function () {
    $('.sponsors_slider').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [{
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: ture,
            dots: false,
          }
        },
        {
          breakpoint: 799,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });

// Code to Resize Schedule Container and Card 
// From Screen Size 780px to 767px
function adjustContainerWidths() {
  const windowWidth = window.innerWidth;
  const scheduleContainer = document.querySelector('.schedule_container');
  const scheduleCard = document.querySelectorAll('.schedule_card');

  if (windowWidth >= 767 && windowWidth <= 780) {
    const diff = 780 - windowWidth;
    scheduleContainer.style.width = (780 - diff) + 'px';
    scheduleCard.forEach(card => {
      card.style.width = (330 - 2 * diff) + 'px';
    });
  }
  else if (windowWidth >= 480 && windowWidth <= 600) {
    const diff = 600 - windowWidth;
    scheduleContainer.style.width = (570 - diff) + 'px';
    scheduleCard.forEach(card => {
      card.style.width = (225 - 2 * diff) + 'px';
    });
  }
  else if(windowWidth <= 480) {
    const diff = 480 - windowWidth;
    scheduleContainer.style.width = (450 - diff) + 'px';
  }
  else{
    return
  }
}

window.addEventListener('resize', adjustContainerWidths);
window.addEventListener('load', adjustContainerWidths);


  // Make The Team Section (top=-100px)

  // window.addEventListener('DOMContentLoaded', (event) => {
  //     // Adjust the top position of the section with id=team
  //     const teamSection = document.getElementById('team');
  //     teamSection.style.marginTop = '-100px';
  //   });

  // Event Date Countdown Start
  // 1000 millisecond = 1 second

  let countDownDate = new Date("Nov 15, 2024 14:00:00").getTime();


  let counter = setInterval(() => {
    // Get Date Now 
    let dateNow = new Date().getTime();

    // Find The Diffrence Between Now And Countdown Date
    let dateDiff = countDownDate - dateNow;

    // Get Time Units
    // let days = Math.floor(dateDiff / 1000 / 60 / 60 / 24);
    let days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
    let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);

    document.querySelector(".days").innerHTML = days < 10 ? `0${days}` : days;
    document.querySelector(".hours").innerHTML = hours < 10 ? `0${hours}` : hours;
    document.querySelector(".minutes").innerHTML = minutes < 10 ? `0${minutes}` : minutes;
    document.querySelector(".seconds").innerHTML = seconds < 10 ? `0${seconds}` : seconds;

    if (dateDiff < 0) {
      clearInterval(counter);
    }
  }, 1000)
  // Event Date Countdown End

  // Function to play the video Start
  function playVideo() {
    var video = document.getElementById('myVideo');
    var playButton = document.querySelector('.play-button');

    // Hide the thumbnail and play button
    playButton.style.display = 'none';

    // Display and play the video
    video.style.display = 'block';
    video.play();
  }
  // Function to play the video End


  // Function for the animation of home hero text
  // document.addEventListener('DOMContentLoaded', function() {
  //     const flyingTexts = document.querySelectorAll('.flying-text');

  //     flyingTexts.forEach((text, index) => {
  //       setTimeout(() => {
  //         text.style.animationName = 'flyIn';
  //         text.style.animationDelay = index * 0.5 + 's';
  //       }, 600); // Delay initial animation for smoother loading
  //     });
  //   });


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




  function adjustPhotoSize() {
    var screenWidth = window.innerWidth;

    // Check if the screen width is 600 pixels or less
    if (screenWidth <= 600) {
      var initialWidth = 520;
      var initialHeight = 500;

      // Calculate the new width and height based on the formula
      var newWidth = initialWidth - (600 - screenWidth) * 0.91;
      var newHeight = initialHeight - (600 - screenWidth) * 0.84;

      // Apply the new width and height to your photo element
      document.getElementById("abt_img").style.width = newWidth + "px";
      document.getElementById("abt_img").style.height = newHeight + "px";
    } else {
      return
    }
  }

  // Call the function after the DOM is fully loaded
  document.addEventListener("DOMContentLoaded", function () {
    adjustPhotoSize();
  });

  // Listen for the window resize event and call the function
  window.addEventListener('resize', adjustPhotoSize);