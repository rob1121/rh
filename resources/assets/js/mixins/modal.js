import modalBox from "../components/modal.vue";
export default {

    data: {
        modalData: {}
    },

    methods: {
        showModal: function(id, data) {
            this.$set(id + 'IsOpen', true);
            this.modalData = data;
        }
    },

	  components: { modalBox }
}