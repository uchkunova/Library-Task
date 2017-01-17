<script>
    import BooksCreate from './BooksCreate.vue';
    import BookList from '../shared/BookList.vue';

    export default {
        data() {
            return {
                showBookList: true,
                showAddBookForm: false,
                books: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                  },
                offset: 4
            }
        },

        computed: {
            isActive() {
                return this.pagination.current_page;
            },

            pagesNumber() {
                if (!this.pagination.to) {
                    return [];
                }

                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                let pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            }
        },

        created() {
            this.getItems(this.pagination.current_page);
        },

        methods: {
            getItems(page) {
                this.$http.get('api/books?page='+page)
                    .then((response) => {
                        this.books = response.data.data.data;
                        this.pagination = response.data.pagination;
                    });
            },

            changePage(page) {
                this.pagination.current_page = page;
                this.getItems(page);
            },

            addBook() {
                this.getItems(this.pagination.current_page);
                this.showAddBookForm = false;
            }
        },

        components: {
            'books-create': BooksCreate,
            'book-list': BookList
        }
    }
</script>




