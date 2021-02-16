<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Posts </span>
                        <span class="cursor-pointer" @click="newPost=true; editPost=false; resetForm()">Add Post</span>
                        <span class="cursor-pointer" @click="getPosts()">Refresh</span>
                    </div>

                    <div class="card-body">
                        <form v-if="newPost" @submit.prevent="editPost ? updatePost(myPost.id) : savePost()" class="mb-5">
                            <span class="cursor-pointer text-danger mb-2" @click="newPost=false">Close</span>
                            <div class="form-group">
                                <label for="title" class="w-100">
                                    Title
                                    <input v-model="myPost.title" id="title" type="text" class="form-control">
                                </label>
                                <label for="post" class="w-100">
                                    Post
                                    <textarea v-model="myPost.post" id="post" class="form-control" cols="30"
                                              rows="10"></textarea>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success">{{ editPost ? 'Update':'Save' }}</button>
                        </form>

                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post, index) in posts">
                                <td>{{ index + 1 }}</td>
                                <td>{{ post.title }}</td>
                                <td>{{ post.post }}</td>
                                <td>
                                    <button @click="myPost = post; newPost = true; editPost = true;">Edit</button>
                                    <button @click="deletePost(post.id)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    /*props: ['posts'],*/
    name: "PostIndex",
    data() {
        return {
            posts: [],
            myPost: {
                title: '',
                post: '',
                id: null
            },
            newPost: false,
            editPost: false,
        }
    },
    mounted() {
        // console.log(this.posts);
        this.getPosts();
    },
    methods: {
        getPosts() {
            let url = '/post/getPosts';
            axios.get(url)
                .then((response) => {
                    this.posts = response.data;
                })
                .catch(err => {

                }).finally(() => {

            })
        },
        savePost() {
            let url = '/post';
            axios.post(url, this.myPost)
            .then((response) => {
                this.getPosts();
                this.resetForm();
            })
            .catch(err => {

            }).finally(() => {
                this.editPost = false;
            })
        },
        updatePost(id) {
            let url = `/post/${id}`;
            axios.put(url, this.myPost)
            .then((response) => {
                this.getPosts();
                this.resetForm();
            })
            .catch(err => {

            }).finally(() => {
                this.editPost = false;
            })
        },
        deletePost(id) {
            let url = '/post/' + id;
            axios.delete(url)
                .then(response => {
                    this.getPosts();
                })
                .catch(err => {

                }).finally(() => {

            })
        },
        resetForm() {
            this.myPost = {
                title: '',
                post: '',
                id: null
            }
        }
    }

}

</script>

<style scoped>
.cursor-pointer {
    cursor: pointer;
}
</style>
