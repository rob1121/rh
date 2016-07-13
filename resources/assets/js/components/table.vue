<template lang="jade">

	.table-content

		.table-container

			p.title Devices

			table
				thead
					th(v-for="thead in theads") {{ thead }}

				tbody
					tr(v-for="device in devices | orderBy sortKey reverse | filterBy searchKey | count | paginate")
						td {{ device.ip }}
						td {{ device.location }}
						td
							a.action-btn(href="#" @click.prevent="setInput(device)")
								span edit
								i.fa.fa-edit
							span |
							a.action-btn(href="#" @click.prevent="deleteDevice(device)")
								span delete
								i.fa.fa-trash-o
		.table-tools
			.input-group
				label.caption Search:
				input.text(type="text" placeholder="Input keyword" v-model="searchKey" debounce="500")

			.input-group
				label.caption Display:
				select.text(v-model="itemsPerPage")
					option 5
					option 10
					option 25
					option 50
					option 100

	ul.links(v-show="totalPages > 1")
		li
			a(href="#" @click.prevent="setPage(0)")
				.btn
					i.fa.fa-angle-double-left
		li
			a(href="#" @click.prevent="currentPage = currentPage ? currentPage-1 : 0")
				.btn
					i.fa.fa-angle-left
		li(v-for  = "pageNumber in totalPages" v-show = "pageNumber >= firstPoint && pageNumber <= lastPoint")
			a(href="#" @click.prevent="setPage(pageNumber)")
				.btn(:class = "{'active': currentPage == pageNumber}" ) {{ pageNumber+1 }}
		li
			a(href="#" @click.prevent="currentPage = currentPage != (totalPages-1) ? currentPage+1 : currentPage")
				.btn
					i.fa.fa-angle-right
		li
			a(href="#" @click.prevent="setPage(totalPages-1)")
				.btn
					i.fa.fa-angle-double-right
	p(:class = "[resultCount ? 'text-success':'text-warning']" v-show = "searchKey != ''")
		"<strong>{{ searchKey }}</strong>" results <strong>{{ resultCount }}</strong> found

</template>

<style lang="stylus" src="../../stylus/vue-table.sty"></style>

<script>
	import pagination from "../mixins/pagination";
	import helper from "../mixins/helper";
	export default {
		data() {
			return {
				theads: ['IP','location','actions']
			}
		},

		props: ['devices','input','show_loader','alert'],

		mixins: [pagination, helper],

		methods: {
	        setPage: function(pageNumber) {
	            this.currentPage = pageNumber
	        },

	        sortBy: function(column) {
	            this.sortKey = column;
	            this.reverse = this.sortKey == column ? this.reverse * -1 : this.reverse = 1;
	        },

			setInput(device) {
				this.input = this.helperMakeNonReactive(device);
				this.input.index = this.helperFindIndex(this.devices, "ip", device.ip);

			},

			deleteDevice(device) {
				this.show_loader = true;
				this.$http.post( env_server + '/delete/' + device.id, [] )
	                .then( response => this.onDelete(device)).bind(this);
			},

			onDelete(device) {
            	this.devices.$remove(device);
                this.alertMsg({msg:device.ip + ' successfully removed'},'success');
            },

	        alertMsg(alert, alertClass) {

	            this.alert.messages = typeof alert == 'object'
	                ? alert
	                : JSON.parse(alert);

	            this.alert.class = alertClass;
	            this.show_loader = false;

	            setTimeout(() => this.alert.messages = [], 15000);
	        }
			}
	}

</script>