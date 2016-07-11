import Vue from 'vue';
import card from './components/card.vue';
import atReady from './mixins/atReady';

var moment = require('moment');

Vue.use(require('vue-resource'));

new Vue({
	el: "#app",

	data: {
		omegas: omegas,
        time: moment().format('MMMM Do YYYY, h:mm:ss a')
    },

    mixins:[atReady],

	components: { card },

    ready() {
        this.updateStatus();
    },

    methods: {

        updateStatus() {
            var self = this;

            self.$http.get(env_server + '/status')
                .then(
                    response => {

                        self.$set('omegas', response.json());
                        self.time = moment().format('MMMM Do YYYY, h:mm:ss a');
                        setTimeout(() => self.updateStatus(), 60 * 60 * 1000); // for local server deployment
                    },

                    (response) => self.updateStatus()
                );
        }

    }
});
