Vue.component('modal', {
	
	template: 	`<div class="modal is-active">
				  <div class="modal-background"></div>
				  <div class="modal-card">
				    <header class="modal-card-head">
				      <p class="modal-card-title">
				      		<slot name="header">default title</slot>
				      </p>
				      <button class="delete" aria-label="close"></button>
				    </header>
				    <section class="modal-card-body">
				      <slot>Default content</slot>
				    </section>
				    <footer class="modal-card-foot">
				      <button class="button is-success">Save changes</button>
				      <button class="button">Cancel</button>
				    </footer>
				  </div>
				</div>`

});

Vue.component('deficiency', {
	template: 	`<tr>
					<td><slot name="department"></slot></td>
					<td><slot name="title"></slot></td>
					<td><slot name="note"></slot></td>
					<td><slot name="postedBy"></slot></td>
					<td><slot name="postDate"></slot></td>
				</tr>`

});

new Vue({
	el: '#deficiency-row'
});