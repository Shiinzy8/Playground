import Vue from 'vue';
import App from './pages/products';

new Vue({
    render: (h) => h(App),
    // render(h) {
    //     return h(App);
    // },
}).$mount('#app');
