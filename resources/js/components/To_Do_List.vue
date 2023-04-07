<template>
	<div class="container">
		<div class="card p-3">
			
		</div>
		<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Задача для группы</th>
			      <th scope="col">Дедлайн</th>
				  <th scope="col">Задача</th>
			    </tr>
			  </thead>
			  
			  <tbody>
			  	<template  v-for="group in groups_to_do_list" :key="group.id"> 
				    <tr>
				     
				      <td>{{ group.id }}</td>
				      <td>{{ group.Name }}</td>
					  <td>{{ group.End_Date }}</td>
					  <td>{{ group.descriptions }}</td>
				     
				    </tr>

			  	</template>
			</tbody>
		</table>
		<table class="table">
			<thead class="thead-dark">
			  <tr>
				<th scope="col">#</th>
				<th scope="col">Задача для пользователч</th>
				<th scope="col">Дедлайн</th>
				<th scope="col">Задача</th>
			  </tr>
			</thead>
			
			<tbody>
				<template  v-for="group in user_to_do_list" :key="group.id"> 
				  <tr>
				   
					<td>{{ group.id }}</td>
					<td>{{ group.Name }}</td>
					<td>{{ group.End_Date }}</td>
					<td>{{ group.descriptions }}</td>
				   
				  </tr>

				</template>
		  </tbody>
	  </table>
	</div>
</template>

<script>
	import { ref, onMounted } from 'vue';
	import Notify from './PostNotify.vue'
	export default{
		props:['groups_to_do_list','user_to_do_list','user'],
		components:{
			'notify':Notify
		},
		setup(props){
			let posts = ref([])
			console.log(props.groups_to_do_list)
	    	onMounted(() =>{
	    		posts.value = props.posts
	    	})

	        function LikePost(id){
	        	axios.post('/post-like',{'post_id':id}).then(response => {
	                console.log(id);
	            });
	        }

	        return {
	        	posts,
	        	LikePost
	        }
		}
		
	}
	document.addEventListener("DOMContentLoaded", () => {
	const form = document.querySelector("form");


	})
</script>