import Vue from 'vue';
import card from './components/card.vue';

Vue.use(require('vue-resource'));

var rhTemp = new Vue({
	el: "#app",

	data: {
		omegas: omegas,
        atReady: false
	},

	components: { card },

    ready() {
        var self = this;

        self.updateStatus();
        self.atReady = true;
    },

    methods: {
        updateStatus() {
            var self = this

            self.$http.get(env_server + '/status')
                .then(response => this.$set('omegas', response.json()));
            // setTimeout(() => this.updateStatus(), 5000); // for local server deployment
        }

    }



});
