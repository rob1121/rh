/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import toggleGear from './components/toggleGear.vue';

Vue.use(require('vue-resource'));

new Vue({
    el: "#app",
    
    data: {
        atReady: false
    },

    ready() {
        this.atReady = true;
    },
    
    components: { toggleGear }
});
