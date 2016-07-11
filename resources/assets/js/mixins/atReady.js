
import toggleGear from '../components/toggleGear.vue';
export default {
    data: {
        atReady: false
    },

    ready() {
        this.atReady = true;
    },

    components: { toggleGear }
}