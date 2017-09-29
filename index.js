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
    $('.carousel').carousel();
    $('input#post_namea','input#post_unit','input#post_namen').characterCounter();
    $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google' : null
      },
      limit: Infinity,
      minLength: 1
    }
  });
});
