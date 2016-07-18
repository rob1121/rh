import Vue from 'vue';
import moment from 'moment';
import card from './components/card.vue';
import atReady from './mixins/atReady';
import helper from './mixins/helper';

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

new Vue({
	el: "#app",

	data: {
		omegas: omegas,
        time: moment().format('MMMM Do YYYY, h:mm:ss a')
    },

    mixins:[atReady, helper],

	components: { card },

    ready() {
        this.statuses();

        setInterval(() => this.statuses(), 60 * 60 * 1000);
    },

    methods: {
        statuses() {
            let delay = 0;
            this.omegas.map(device => {
                setTimeout(() =>this.updateStatus(device), delay += 500 );
            });
        },

        updateStatus(device) {
            this.$http.post(env_server + '/status', device)
                .then(response => {
                    var index = this.helperFindIndex(this.omegas, 'ip', device.ip);

                    this.omegas.$set(index, response.json());
                    this.time = moment().format('MMMM Do YYYY, h:mm:ss a');
                }, () => setTimeout(() =>this.updateStatus(device), 1000))
                .bind(this);
        }
    }
});
