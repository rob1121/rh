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

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

new Vue({
    el: "#app",

    data: {
    	devices: devices,
    	index: null,
        ip_hook: "127.0.0.1",
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

        storeDevice() {
            var link = env_server + '/devices';

            this.$http.post( link, this.input )
                .then( response => {
                    if (! response.json().hasOwnProperty('error')) // check if key 'error' exist
                    {
                        var input = this.makeNonReactive(this.input);

                        this.devices.push(input);
                    }

                    this.input.ip = '';
                    this.index = null;
                    this.input.location = '';
                }).bind(this);
        },

		updateDevice()
		{
            var link = env_server + '/update/' + this.makeNonReactive(this.id);

            this.$http.post( link, this.input )
                .then( response => {
                    var index = this.makeNonReactive(this.index),
                        input = this.makeNonReactive(this.input);

                        this.devices.$set(index, input);
                        this.input.ip = '';
                        this.index = null;
                        this.input.location = '';
                }).bind(this);
		}
    },
});
