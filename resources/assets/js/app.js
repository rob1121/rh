import Vue from 'vue';
import card from './components/card.vue';
import toggleGear from './components/toggleGear.vue';

var moment = require('moment');

Vue.use(require('vue-resource'));

new Vue({
	el: "#app",

	data: {
		omegas: omegas,
        atReady: false,
        time: moment().format('MMMM Do YYYY, h:mm:ss a')
    },

	components: { card, toggleGear },

    ready() {
        var self = this;

        self.updateStatus();
        self.atReady = true;
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
