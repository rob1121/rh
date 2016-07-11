/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import toggleGear from './components/toggleGear.vue';
import deviceTable from './components/table.vue';
import VuePaginate from 'vue-paginate';

Vue.use(VuePaginate);

Vue.use(require('vue-resource'));

new Vue({
    el: "#app",

    data: {
    	devices: devices,
        atReady: false
    },

    ready() {
        this.atReady = true;
    },

    components: { toggleGear, deviceTable }
});
