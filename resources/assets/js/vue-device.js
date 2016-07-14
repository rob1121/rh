/**
 * Created by LEGASPI on 7/10/2016.
 */

import Vue from 'vue';
import moment from 'moment';
import { PulseLoader  } from 'vue-spinner/dist/vue-spinner.min.js';
import deviceTable from './components/table.vue';
import atReady from './mixins/atReady';
import inputText from "./components/inputText.vue";
import selectDate from "./components/date-year-month.vue";
import helper from "./mixins/helper";

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

new Vue({
    el: "#app",

    data: {
    	devices: devices,

        alert:{ messages: [], class: 'success' },

        select: { year: '', month: '' },

        modal: { display: false },

        show_loader: false,

        input: { id: null, ip: '', location: '', index: null },
    },

    ready() {
        this.setDate();
    },

    mixins:[atReady, helper],

    components: { deviceTable, inputText, PulseLoader, selectDate },

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
            location.href=env_server + `/export?month=${this.select.month}&year=${this.select.year}`;
        },

        setDate() {
            var d = new Date();

            this.select.year = moment().format('YYYY');
            this.select.month = moment().format('M');
        }
    },
});
