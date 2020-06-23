<template>
    <div class="col-md-3">
        <p id="success"></p>
        <a href="http://"><i @click.prevent="dislikePost" class="fa fa-thumbs-down" aria-hidden="true"></i>({{ totaldislike }})</a>
    </div>
</template>
<script>
    export default {
        props:['post'],
        data(){
            return {
                totaldislike:'',
            }
        },
        methods:{
            dislikePost(){
                axios.post('/like/'+this.post,{post:this.post})
                    .then(response =>{
                        this.getdislike()
                        $('#success').html(response.data.message)
                    })
                    .catch()
            },
            getdislike(){
                axios.post('/like',{post:this.post})
                    .then(response =>{
                        console.log(response.data.post.like)
                        this.totallike = response.data.post.like
                    })
            }
        },
        mounted() {
            this.getdislike()
        }
    }

</script>