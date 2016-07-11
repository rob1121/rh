/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import deviceTable from './components/table.vue';
import VuePaginate from 'vue-paginate';
import atReady from './mixins/atReady';

Vue.use(VuePaginate);

Vue.use(require('vue-resource'));

new Vue({
    el: "#app",

    data: {
    	devices: devices
    },

    mixins:[atReady],

    components: { deviceTable }
});
