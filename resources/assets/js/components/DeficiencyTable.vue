<script>
	import Vuetable from 'vuetable-2/src/components/Vuetable'

	//import VuetablePagination from 'vuetable-2/src/components/VuetablePaginationDropdown' --- for dropdown pagination
	import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
	import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import moment from 'moment'
	import Vue from 'vue'
	import VueEvents from 'vue-events'
	import CustomActions from './ActionButtons'
	import FilterBar from './FilterBar'
	import CssConfig from './VuetableCssConfig.js'


	Vue.use('VueEvents');
	Vue.component('action-buttons', ActionButtons);
	Vue.component('filter-bar', FilterBar);

	export default{
		components: {
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
		}

		props: {
			apiUrl: {
				type: String,
				required: true
			},

			fields: {
				type: Array,
				required: true
			},

			sortOrder: {
				type: Array,
				default(){
					return {}
				},
			},

			appendParams: {
				type: Object,
				default(){
					return {}
				}
			},

		},

		render(h){
			return h(
				'div',
				{
					class: {
						table: true,
						table-striped: true,	
					}
				},
					[
						h('filter-bar'),
						this.renderVuetable(h),
						this.renderPagination(h)
					]

				);
		},

		mounted(){
			this.$events.$on('filter-set', eventData => this.onFilterSet(eventData));
			this.$events.$on.('filter-reset', e => this.onFilterReset());
		},

		methods: {

			renderVuetable(h){
				return h(
						'vuetable',
						{
							ref: 'vuetable',
							props: {
								apiUrl: this.apiUrl,
								fileds: this.fields,
								paginationPath: "",
								perPage: 10,
								multiSort: true,
								sortOrder: this.sortOrder,
								appendParams: this.appendParams,
								detailRowComponent: this.detailRowComponent,
								css: CssConfig.table
							},

							on: {
								'vuetable:cell-clicked' : this.onCellClicked,
								'vuetable:pagination-data': this.onPaginationData,	
								scopdeSlots: this.$vnode.data.scpodeSlots
							}
						}
					);
			},

			renderPagination(h){
				return h(
					'div',
					{
						//pagination bootstrap class
						class:
						{},

						css: CssConfig.pagination
					},
					[
						h('vuetable-pagination-info', 
						{
							ref: 'paginationInfo'
						}),
						h('vuetable-pagination',
						{
							ref: 'pagination',
							on: {
								'vuetable-pagination:change-page' : this.onChangePage
							}
						})
					]
				);
			},

			onFilterSet(filterText){
				this.appendParams.filter = filterText;
				Vue.nextTick(() => this.$refs.vuetable.refresh());
			},


			onFilterReset(){
				delete this.appendParams.filter;
				Vue.nextTick(() => this.$refs.vuetable.refresh());
			},

			
		    onPaginationData(paginationData){
		      this.$refs.pagination.setPaginationData(paginationData);
		    },

		    onChangePage(page){
		      this.$refs.vuetable.changePage(page);
		    },

		    onPaginationData (paginationData) {

		        this.$refs.pagination.setPaginationData(paginationData);
		        this.$refs.paginationInfo.setPaginationData(paginationData);
		    },

		}
	}

</script>