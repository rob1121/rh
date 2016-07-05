import Vue from 'vue';
import card from './components/card.vue';

Vue.use(require('vue-resource'));

new Vue({
	el: "#app",

	data: {
		omegas: omegas
	},

	components: { card }


});