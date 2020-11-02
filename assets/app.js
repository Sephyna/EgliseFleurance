/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/navbar.scss';
import './styles/footer.scss';


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');


/* NAVBAR */

/* Change class of navBar and link on right when reload and window resize */

let onWindowResize = function ()
{

    let iWindowsSize = $(window).width();
    let navBar = document.querySelector('nav');
    let positionTopNavBar = $("#navBar").offset().top;
    let linkRightMenu = $( "#right-menu" ).find( "a" );


    linkRightMenu.addClass('btn-dark');
    linkRightMenu.addClass('btn')

    if (iWindowsSize <= 750)
    {
        $( navBar ).addClass('scrolling-active');
        linkRightMenu.removeClass('btn-dark');
        linkRightMenu.removeClass('btn');
        $(navBar).removeClass('menu-underline');
    }
    else if(positionTopNavBar !== 0)
    {
        $(navBar).addClass('scrolling-active');


    }
    else {
        $(navBar).removeClass('scrolling-active');
        $(navBar).addClass('menu-underline');
    }



}

/*Smooth effect on scrolling Y only in large screen */
let onUserScrolling = function ()
{
    let iWindowsSize = $(window).width();
    let navBar = document.querySelector('nav');
    let windowPosition = window.scrollY > 0;
    let positionTopNavBar = $("#navBar").offset().top;


    if (iWindowsSize <= 750) {
        $(navBar).addClass('scrolling-active', windowPosition);
        $(navBar).removeClass('menu-underline');
    } else {
        if(positionTopNavBar !== 0)
        {
            $(navBar).addClass('scrolling-active');
            $(navBar).removeClass('menu-underline');

        }
        else {
            $(navBar).removeClass('scrolling-active');
            $(navBar).addClass('menu-underline');
        }


    }
}



$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    window.addEventListener('load', onWindowResize);
    window.addEventListener('resize', onWindowResize);

    window.addEventListener('scroll', onUserScrolling);
    window.addEventListener('scroll', onUserScrolling);

    /*REDIRECTION*/
    $('#redirection').click(function() {
        $('html,body').animate({scrollTop: $("#body").offset().top}, 'slow'      );
    });
});







