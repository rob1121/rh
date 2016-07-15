/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import moment from 'moment';
import datepicker from './components/datepicker.vue';
import { PulseLoader  } from 'vue-spinner/dist/vue-spinner.min.js';
import deviceTable from './components/table.vue';
import atReady from './mixins/atReady';
import inputText from "./components/inputText.vue";
import helper from "./mixins/helper";

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

new Vue({
    el: "#app",

    data: {
    	devices: devices,

        date: {
            from: moment().format('MM/DD/YYYY'),
            to: moment().format('MM/DD/YYYY')
        },

        alert:{ messages: [], class: 'success' },

        modal: { display: false },

        show_loader: false,

        input: { id: null, ip: '', location: '', index: null },
    },

    mixins:[atReady, helper],

    components: { deviceTable, inputText, PulseLoader, datepicker },

    methods: {

        storeDevice() {
            this.show_loader = true;

            var link = env_server + '/devices/store';

            this.$http.post( link, this.input )
                .then( response => this.onStore(response.json()))
                .catch((data, status, request) => this.alertMsg(data.data, 'danger'))
                .bind(this);
        },

		updateDevice()
		{
            this.show_loader = true;
            var link = env_server + '/update/' + this.helperMakeNonReactive(this.input.id);

            this.$http.post( link, this.input )
                .then(() => this.onUpdate())
                .bind(this);
		},

        resetForm() {
            this.input.ip = '';
            this.input.id = null;
            this.input.location = '';
            this.input.index = null;
            this.show_loader = false;
        },

        onStore(newDevice) {
            this.devices.push(newDevice);
            this.alertMsg({msg:newDevice.ip + ' successfully added'}, 'success');
            this.resetForm();
        },

        onUpdate() {
            var input = this.helperMakeNonReactive(this.input);
                this.devices.$set(input.index, input);
                this.alertMsg({msg:input.ip + ' successfully updated'}, 'success');
                this.resetForm();
        },

        alertMsg(alert, alertClass) {

            this.alert.messages = typeof alert == 'object'
                ? alert
                : JSON.parse(alert);

            this.alert.class = alertClass;
            this.show_loader = false;

            setTimeout(() => this.alert.messages = [], 15000);
        },

        export() {
            location.href=env_server + `/export?from=${this.date.from}&to=${this.date.to}`;
        }
    },
});
