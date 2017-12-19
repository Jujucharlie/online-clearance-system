export default [

	{
		name: 'department',
		callback: 'addLinkToDept'
	},

	{
		name: 'title',
	},

	{
		name: 'note',
	},

	{
		name: 'staff',
		title: 'Posted By',
		callback: 'addLinkToStaff'	
	},

	{
		name: 'created_at',
		title: 'Posted On'
	},

	{
		name: 'actions',
		callback: 'actionButtons'
	}
]