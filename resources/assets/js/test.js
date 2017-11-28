Vue.component('deficiency', {
	
	template: 	`<table>
					<tr>
						<th>Department</th>
						<th>Title</th>
						<th>Note</th>
						<th>Staff</th>
						<th>Posted On</th>
					</tr>

					<tr>
						<td><slot name="department"></slot></td>
						<td><slot name="title"></slot></td>
						<td><slot name="note"></slot></td>
						<td><slot name="staff"></slot></td>
						<td><slot name="posted-on"></slot></td>
					</tr>
				</table>`

});

new Vue({
	el: '#deficiency-table'
});