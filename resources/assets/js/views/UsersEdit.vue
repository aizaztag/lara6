<template>
    <div>
        <ul>
            <li v-for="error in errors" :key="error.message">
                {{error}}
            </li>
        </ul>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="! loaded">Loading...</div>


        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label for="user_name">Name</label>
                <input id="user_name" v-model="user.name" />
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" type="email" v-model="user.email" />
            </div>
            <div class="form-group">
                <button type="submit" :disabled="saving">Update</button>
                <button :disabled="saving" @click.prevent="onDelete($event)">Delete</button>
                <button :disabled="saving" @click.prevent="onCancel($event)">Cancel</button>
            </div>
        </form>
    </div>
</template>
<script>
    import api from '../api/users';

    export default {
        data() {
            return {
                items: [
                    { message: 'Foo' },
                    { message: 'Bar' }
                ],
                errors:null,
                message: null,
                loaded: false,
                saving: false,
                user: {
                    id: null,
                    name: "",
                    email: ""
                }
            };
        },
        methods: {
            onSubmit(event) {
                this.saving = true;

                api.update(this.user.id, {
                    name: this.user.name,
                    email: this.user.email,
                }).then((response) => {
                    this.message = 'User updated';
                    setTimeout(() =>{
                        this.message = null
                        this.$router.push({ name: 'users.index' })
                        },
                        2000
                    );
                    this.user = response.data.data;
                }).catch(error =>  {
                    let errormsg = [] ;
                        $.each((error.response.data.errors) , function (key, value) {
                            errormsg.push(value[0])
                        });
                        this.errors = errormsg
                        //console.log(this.errors, errormsg)
                }).then(_ => this.saving = false);
            },
            onDelete() {
                this.saving = true;
                api.delete(this.user.id)
                    .then((response) => {
                        this.message = 'User Deleted';
                        setTimeout(() => this.$router.push({ name: 'users.index' }), 2000);
                    });
            },
            onCancel(){
                this.saving = true;
                this.$router.push({ name: 'users.index' })
            },
            setData(err) {
                console.log('ffdfd' , links)

                if (err) {
                    this.error = err.toString();
                }
                /*if (err) {
                    this.error = err.toString();
                } else {
                    this.users = users;
                    this.links = links;
                    this.meta = meta;
                }*/
            },
        },
        created() {
            api.find(this.$route.params.id)
                .then((response) => {
                    this.loaded = true;
                    this.user = response.data.data;
                })
                .catch((err) => {
                    this.$router.push({ name: '404' });
                });
        }

    };
</script>
<style lang="scss" scoped>
    $red: lighten(red, 30%);
    $darkRed: darken($red, 50%);
    .form-group label {
        display: block;
    }
    .alert {
        background: $red;
        color: $darkRed;
        padding: 1rem;
        margin-bottom: 1rem;
        width: 50%;
        border: 1px solid $darkRed;
        border-radius: 5px;
    }
</style>