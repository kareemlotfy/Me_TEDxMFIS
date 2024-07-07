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
    let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24))  / (1000 * 60 * 60));
    let minutes = Math.floor((dateDiff % (1000 * 60 * 60))  / (1000 * 60));
    let seconds = Math.floor((dateDiff % (1000 * 60 ))  / 1000);

    document.querySelector(".days").innerHTML = days < 10 ? `0${days}` : days;
    document.querySelector(".hours").innerHTML = hours < 10 ? `0${hours}` : hours;
    document.querySelector(".minutes").innerHTML = minutes < 10 ? `0${minutes}` : minutes;
    document.querySelector(".seconds").innerHTML = seconds < 10 ? `0${seconds}` : seconds;

    if (dateDiff < 0){
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


// Set padding of class="cards"

function setDynamicPadding() {
  var windowWidth = window.innerWidth;

  // Check if window width is less than or equal to 600px
  if (windowWidth <= 600) {
    // Remove inline styles added by JavaScript
    var elements = document.querySelectorAll('.cards');
    elements.forEach(function(element) {
      element.style.removeProperty('padding-left');
      element.style.removeProperty('padding-right');
    });
    return; // Exit the function
  }

  var mainContentWidth = document.querySelector('.inner_content').offsetWidth;
  var paddingValue = windowWidth - mainContentWidth;
  var paddingLR = paddingValue / 2;

  // Apply padding to the desired class
  var elements = document.querySelectorAll('.cards');
  elements.forEach(function(element) {
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
    }else{
      return
    }
}

// Call the function after the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    adjustPhotoSize();
});

// Listen for the window resize event and call the function
window.addEventListener('resize', adjustPhotoSize);

