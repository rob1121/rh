import Vue from 'vue';
import card from './components/card.vue';

Vue.use(require('vue-resource'));

var rhTemp = new Vue({
	el: "#app",

	data: {
		omegas: omegas
	},

	components: { card },

    ready() {
        this.updateStatus();
    },

    methods: {
        updateStatus() {
            var self = this,
            	development = '/status', // for laragon connections
            	production = '/rh-temp/public/status'; // form local server connections

            self.$http.get(development)
                .then(response => this.$set('omegas', response.json()));
            // setTimeout(() => this.updateStatus(), 5000); // for local server deployment
        }

    }



});
