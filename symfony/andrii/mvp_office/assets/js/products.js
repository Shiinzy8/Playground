import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data() {
        return {
            firstName: 'Andrii',
        };
    },
    template: '<h1>Hello {{ firstName }} ! Is this cooler </h1>',
});

window.app = app; // this allow to play with app in console
// for example now you can tap in console app.firstName and change it to another value
