
/* ------------------------------------------------
  Telltec.ch Main Javascript
  Hi there!
------------------------------------------------ */

console.log("Gotta lova a good 🍪!");


/* --------
Import Third Party
-------- */
import '../../../../../node_modules/in-viewport-class/dist/in-viewport-class.js'


/* --------
Site Nav 
-------- */

const siteNavToggle = document.querySelector('#site-nav__toggle');
const siteNav   = document.querySelector('#site-nav');

siteNavToggle.addEventListener( 'click', toggleNav );

function toggleNav() {

  siteNav.classList.toggle('site-nav--hidden');
  siteNavToggle.classList.toggle('is-active');

}





