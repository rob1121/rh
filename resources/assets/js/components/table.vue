<template lang="jade">
	.table-content
		.table-container
			table
				thead
					th(v-for="thead in theads") {{ thead }}

				tbody
					tr(v-for="(index, device) in devices | orderBy sortKey reverse | filterBy searchKey | paginate")
						td {{ device.ip }}
						td {{ device.location }}
						td
							a.action-btn(href="#" @click.prevent="setInput(device, index)")
								span edit
								i.fa.fa-edit
							span |
							a.action-btn(href="#")
								span delete
								i.fa.fa-trash-o
		.table-tools
			.input-group
				label.caption Search:
				input.text(type="text" placeholder="Input keyword")

			.input-group
				select
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
				.btn(:class = "{'active': currentPage == pageNumber}" )
					{{ pageNumber+1 }}
		li
			a(href="#" @click.prevent="currentPage = currentPage != (totalPages-1) ? currentPage+1 : currentPage")
				.btn
					i.fa.fa-angle-right
		li
			a(href="#" @click.prevent="setPage(totalPages-1)")
				.btn
					i.fa.fa-angle-double-right
	p(:class = "[resultCount ? 'text-success':'text-warning']" v-show = "searchKey != ''")
		"<strong>@{{ searchKey }}</strong>" results <strong>@{{ resultCount }}</strong> found

</template>

<style lang="stylus" src="../../stylus/vue-table.sty"></style>

<script>
	import pagination from "../mixins/pagination";
	export default {
		data() {
			return {
				theads: ['IP','location','actions']
			}
		},

		props: ['devices','input','index'],

		mixins: [pagination],

		methods: {
	    	makeNonReactive(collection) {
	    		return JSON.parse(JSON.stringify(collection));
	    	},

			setInput(device, index) {
				this.index = index;
				this.input = this.makeNonReactive(device);
			},
		}
	}

</script>