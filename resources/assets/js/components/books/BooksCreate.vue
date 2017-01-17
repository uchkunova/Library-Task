<template>
    <div class="form-group">
        <div class="container-fluid">
            <div class="alert alert-danger top-buffer-50" v-if="message">
                {{ message }}
            </div>

            <h1>Add Book</h1>

            <form id="createBookForm" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" @submit.prevent="createBook" >
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text"
                                   placeholder="Book title"
                                   name="title"
                                   class="form-control"
                                   v-model="NewBook.title"
                                   @input="errors.title=[]"
                            >
                            <div v-show="errors.title" v-for="error in errors.title">
                                <span class="text-danger">{{error}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <input type="text"
                                   placeholder="Publish date"
                                   name="publish_date"
                                   class="form-control"
                                   v-model="NewBook.publish_date"
                                   @input="errors.publish_date=[]"
                            />
                            <div v-show="errors.publish_date" v-for="error in errors.publish_date">
                                <span class="text-danger">{{error}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text"
                                   placeholder="Author"
                                   name="author"
                                   class="form-control"
                                   v-model="NewBook.author"
                                   @input="errors.author=[]"
                            >
                            <div v-show="errors.author" v-for="error in errors.author">
                                <span class="text-danger">{{error}}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <select name="format"
                                    class="form-control"
                                    v-model="NewBook.format"
                                    @change="errors.format=[]"
                            >
                                <option value="">Select Format..</option>
                                <option v-for="formatType in this.formatTypes" :value="formatType">{{ formatType }}</option>
                            </select>
                            <div v-show="errors.format" v-for="error in errors.format">
                                <span class="text-danger">{{error}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group top-buffer-50">
                        <div class="col-md-6">
                            <div style="margin-bottom: 15px">
                                <input type="text"
                                   placeholder="Page count"
                                   name="page_count"
                                   class="form-control"
                                   v-model="NewBook.page_count"
                                   @input="errors.page_count=[]"
                                />
                                <div v-show="errors.page_count" v-for="error in errors.page_count">
                                    <span class="text-danger">{{error}}</span>
                                </div>
                            </div>

                            <div>
                                <input type="text"
                                       placeholder="ISBN"
                                       name="isbn"
                                       class="form-control"
                                       v-model="NewBook.isbn"
                                       @input="errors.isbn=[]"
                                />
                                <div v-show="errors.isbn" v-for="error in errors.isbn">
                                    <span class="text-danger">{{error}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <textarea
                                    placeholder="Resume"
                                    name="resume"
                                    class="form-control"
                                    v-model="NewBook.resume"
                                    @input="errors.resume=[]"
                                    style="height:87px"
                            />
                            <div v-show="errors.resume" v-for="error in errors.resume">
                                <span class="text-danger">{{error}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group top-buffer-50">
                        <div class="col-md-6">
                            <div class="col-md-1 content-center">
                                <img :src="upload_cover_image"
                                     style="width:30px; height:30px;"
                                >
                            </div>
                            <div class="col-md-11">
                                <input type="file"
                                   placeholder="cover"
                                   name="cover"
                                   @input="errors.cover=[]"
                                />
                                <div v-show="errors.cover" v-for="error in errors.cover">
                                    <span class="text-danger">{{error}}</span>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-default pull-right">
                                <span class="pull-left">Submit</span>
                                <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default{
        data() {
            return{
                NewBook: {
                    title: '',
                    author: '',
                    publish_date: '',
                    resume: '',
                    format: '',
                    page_count: '',
                    isbn: '',
                },
                errors: {},
                formatTypes: '',
                upload_photo_url: Laravel.basePath + 'books/upload',
                upload_cover_image: Laravel.basePath + 'images/upload_cover.png',
                message: ''
            }
        },

        created() {
            this.getFormatTypes();
        },

        methods: {
            createBook() {
                let formData = new FormData(document.getElementById('createBookForm'));
                this.$http.post('books', formData)
                    .then((response) => {
                        this.addBook();
                        this.NewBook = {};
                    })
                    .catch((error) => {
                        this.errors = error.response.data;
                        this.message = error.response.data.message;
                    });
            },

            addBook() {
                this.$emit('applied');
            },

            getFormatTypes() {
                this.$http.get('api/formatTypes')
                .then((response) => {
                    this.formatTypes = response.data;
                })
                .catch((error) => {
                    this.errors.formatTypes = error;
                });
            }
        }
    }
</script>
