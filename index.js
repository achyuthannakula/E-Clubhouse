$(document).ready(function() {
    $('.slider').slider();
    $('.parallax').parallax();
    $('.scrollspy').scrollSpy();
    $(".dropdown-button").dropdown();
    $(".button-collapse").sideNav();
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 2 // Creates a dropdown of 15 years to control year
    });
    $('.modal-trigger').leanModal();
    $('.carousel').carousel();
    $('input#post_namea','input#post_unit','input#post_namen').characterCounter();
});