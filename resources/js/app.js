/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//Smooth scrolling with links
$('a[href*=\\#]').on('click', function(event){
    event.preventDefault();
    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
});

// Smooth scrolling when the document is loaded and ready
$(document).ready(function(){
    // $('html,body').animate({scrollTop:$(location.hash).offset().top}, 500);

    $('.navbar-collapse').on('show.bs.collapse', function() {
        $('.navbar .navbar-brand').fadeOut(200);
    });
    $('.navbar-collapse').on('hidden.bs.collapse.in', function() {
        $('.navbar .navbar-brand').fadeIn(200);
    });
});
