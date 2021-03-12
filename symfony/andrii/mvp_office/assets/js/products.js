import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: function() {
        return {
            firstName: 'Andrii',
        };
    },
    template: '<h1>Hello Vue! Is this cooler </h1>',
});
