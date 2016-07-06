import Vue from 'vue';
import card from './components/card.vue';

Vue.use(require('vue-resource'));

new Vue({
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
            var self = this;

            self.$http.get('/status')
                .then(response => this.$set('omegas', response.json()));

            setTimeout(() => this.updateStatus(), 5000);

        }

    }



});
