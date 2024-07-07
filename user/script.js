// Cursor

var cursor = document.querySelector('.cursor');
var cursorinner = document.querySelector('.cursor2');
var a = document.querySelectorAll('a');

document.addEventListener('mousemove', function(e){
var x = e.clientX;
var y = e.clientY;
cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`
});

document.addEventListener('mousemove', function(e){
var x = e.clientX;
var y = e.clientY;
cursorinner.style.left = x + 'px';
cursorinner.style.top = y + 'px';
});

document.addEventListener('mousedown', function(){
cursor.classList.add('click');
cursorinner.classList.add('cursorinnerhover')
});

document.addEventListener('mouseup', function(){
cursor.classList.remove('click')
cursorinner.classList.remove('cursorinnerhover')
});

a.forEach(item => {
item.addEventListener('mouseover', () => {
cursor.classList.add('hover');
});
item.addEventListener('mouseleave', () => {
cursor.classList.remove('hover');
});
})


// Menu

var navLinks = document.getElementById("navLinks");
function showMenu() {
    navLinks.style.right = "0"
}
function hideMenu() {
    navLinks.style.right = "-200px"
}


// Shutdown Ticket Form

async function checkFormStatus() {
    try {
        const response = await fetch('user/backend.php');
        const data = await response.json();

        if (data.formOpen === '1') {
            document.getElementById('myForm').style.display = 'none';
            document.getElementById('done_message').style.display = 'block';
        } else {
            document.getElementById('myForm').style.display = 'block';
            document.getElementById('done_message').style.display = 'none';
            // document.getElementById('done_message').innerText = '';
        }
    } catch (error) {
        console.error('Error fetching form status:', error);
    }
}
checkFormStatus()
