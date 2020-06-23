
<template>
    <div class="col-md-3">
        <p id="success"></p>
        <a href="#"><i @click.prevent="likePost" v-bind:class="[ (like) ? 'fa fa-thumbs-up' : 'fa fa-thumbs-down']"aria-hidden="true"></i>({{ totallike }})</a>
    </div>
</template>

<script>
    export default {
        props:['post'],
        data(){
            return {
                totallike:'',
                like : true
            }
        },
        methods:{
            likePost(){
                axios.post('/like/'+this.post,{post:this.post})
                    .then(response =>{
                        this.getlike()
                        $('#success').html(response.data.message)
                        this.like = response.data.like ;//(response.data.like) ? true : false;
                        alert(this.like)
                    })
                    .catch()
            },
            getlike(){
                axios.post('/like',{post:this.post})
                    .then(response =>{
                        console.log(response.data.post.like)
                        this.totallike = response.data.post.like
                    })
            }
        },
        mounted() {
            this.getlike()
        }
    }
</script>