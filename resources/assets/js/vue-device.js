/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import { PulseLoader  } from 'vue-spinner/dist/vue-spinner.min.js';
import deviceTable from './components/table.vue';
import VuePaginate from 'vue-paginate';
import atReady from './mixins/atReady';
import inputText from "./components/inputText.vue";
import helper from "./mixins/helper";

Vue.use(VuePaginate);

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

new Vue({
    el: "#app",

    data: {
    	devices: devices,
        errors: [],
        show_loader: false,
        input: {
            id: null,
            ip: '',
            location: '',
            index: null
        },

    },

    mixins:[atReady, helper],

    components: { deviceTable, inputText, PulseLoader  },

    methods: {

        storeDevice() {
            this.show_loader = true;

            var link = env_server + '/devices';

            this.$http.post( link, this.input )
                .then( response => {
                    if (! this.hasError(response.json()))
                        this.devices.push(response.json());

                    this.resetForm();
                    this.show_loader = false;

                }).catch(function (data, status, request) {

                    this.errors = JSON.parse(data.data);
                    this.show_loader = false;
                    setTimeout(() => this.errors = [], 5000);
                }).bind(this);
        },

		updateDevice()
		{
            this.show_loader = true;
            var link = env_server + '/update/' + this.helperMakeNonReactive(this.input.id);

            this.$http.post( link, this.input )
                .then( response => {
                    var input = this.helperMakeNonReactive(this.input);
                        this.devices.$set(input.index, input);
                        this.resetForm();
                        this.show_loader = false;
                }).bind(this);
		},

        resetForm() {
            this.input.ip = '';
            this.input.id = null;
            this.input.location = '';
            this.input.index = null;
        },

        showErrorMsg: function (errors) {
            var self = this;

            self.errors = errors.json();

            setTimeout(function () {
                self.errors = '';
            }, 15000);
        },
    },
});
