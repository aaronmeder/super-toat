/* --------
Site Nav 
-------- */

const siteNavToggle = document.querySelector('#site-nav__toggle');
const siteNav = document.querySelector('#site-nav');
const siteNavItems = document.querySelectorAll('#site-nav li');


/* --- Event Listeners --- */

siteNavToggle.addEventListener( 'click', toggleNav );


/* --- Animations --- */

// stagger nav items animation
const minimumDelay = 0;
const incrementDelay = 60;
let counter = 0;
siteNavItems.forEach( (item) => {
    item.style.animationDelay = minimumDelay + ( counter * incrementDelay) + "ms";
    counter++;
});


/* --- Functions --- */

function toggleNav() {

    siteNav.classList.toggle('site-nav--hidden');
    siteNav.classList.toggle('site-nav--show');
    siteNavToggle.classList.toggle('is-active');
  
  }