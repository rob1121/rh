export default {
	data() {
		return {
			searchKey: '',
			reverse: 1,
			sortKey: '',
			currentPage: 0,
			itemsPerPage: 10,
			resultCount: 0
		}
	},

	ready() {
		this.$set('resultCount', this.devices.length);
	},

	computed: {
	    lastPoint() {
	        var val = this.currentPage;
	        var last = this.totalPages - 1;

	        if (val < 2) return val ? 5 - val : 4;
	        if ((last - val) < 2) return last;
	        return val + 2;
	    },

	    firstPoint() {
	        var val = this.currentPage;
	        var last = this.totalPages - 1;
	        var res = last - val;

	        if (val < 2) return 0;
	        if (res < 2) return res ? last - (5 - res) : last - 4;
	        return val - 2;
	    },

	    totalPages() {
	        return Math.ceil(this.resultCount / parseInt(this.itemsPerPage))
	    }
	},

	filters: {
	    paginate(list) {
	        var index = this.currentPage * parseInt(this.itemsPerPage)
	        return list.slice(index, index + parseInt(this.itemsPerPage))
	    },

		count(arr) {

		this.$set('resultCount', arr.length)

		return arr
		}
	},

	methods: {
        sortBy: function(column) {
            this.sortKey = column;
            this.reverse = this.sortKey == column ? this.reverse * -1 : this.reverse = 1;
        },

	    setPage(pageNumber) {
	        this.currentPage = pageNumber
	    },
	}
}