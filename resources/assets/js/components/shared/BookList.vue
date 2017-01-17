<template>
    <div class="container-fluid">
        <div class="container-fluid">
            <h1>Books</h1>
        </div>
        <div class="container-fluid">
            <div class="col-md-3" v-for="book in books">
                <book :book="book"></book>
            </div>
        </div>

    </div>
</template>
<script>
    import Book from './Book.vue';

    export default {
        props: ['books'],

        components: {
            'book': Book
        }
    }
</script>

