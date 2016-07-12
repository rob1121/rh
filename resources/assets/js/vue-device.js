/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import deviceTable from './components/table.vue';
import VuePaginate from 'vue-paginate';
import atReady from './mixins/atReady';
import inputText from "./components/inputText.vue";

Vue.use(VuePaginate);

Vue.use(require('vue-resource'));

new Vue({
    el: "#app",

    data: {
    	devices: devices,
    	index: null,
    	input: {
    		ip: '',
    		location: ''
    	}
    },

    mixins:[atReady],

    components: { deviceTable, inputText },

    methods: {
        setPage: function(pageNumber) {
            this.currentPage = pageNumber
        },

        sortBy: function(column) {
            this.sortKey = column;
            this.reverse = this.sortKey == column ? this.reverse * -1 : this.reverse = 1;
        },
    	makeNonReactive(collection)
    	{
    		return JSON.parse(JSON.stringify(collection));
    	},

		updateDevice()
		{
			this.devices.$set(this.index, this.makeNonReactive(this.input));
			this.input.ip = '';
			this.input.location = '';
		},

		deleteDevice(device)
		{
			var self = this;

			self.$http.get( env_server + '/delete/' + device.ip )
                .then( response => {
					self.devices.$remove(device);
                }, (response) => self.updateStatus() );
		}
    },
});
