@extends('layouts.app')

@section('content')
<books-index  inline-template>
    <div class="form-group">
        <div class="pull-right left-buffer">
            <button type="button" class="btn btn-default" @click="showBookList=!showBookList">
                <span class="pull-left">@{{ (showBookList==true ? "Hide Books" : "Show Books" )}}</span>
                <span class="glyphicon glyphicon-list-alt pull-right" aria-hidden="true"></span>
            </button>
        </div>

        @can('create', \App\Book::class)
            <div class="pull-right">
                <button type="button" class="btn btn-default" @click="showAddBookForm=!showAddBookForm">
                    <span class="pull-left">Add Book</span>
                    <span class="glyphicon glyphicon-plus pull-right" aria-hidden="true"></span>
                </button>
            </div>
            <div class="container-fluid" v-if="showAddBookForm">
                <books-create @applied="addBook"></books-create>
            </div>
        @endcan

        <div class="container-fluid" v-if="showBookList">
            <book-list :books="books"></book-list>

            <div class="container-fluid ">
                <nav>
                    <ul class="pagination ">
                        <li v-if="pagination.current_page > 1">
                            <a href="#" aria-label="Previous"
                               @click.prevent="changePage(pagination.current_page - 1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li v-for="page in pagesNumber"
                            :class="[ page == isActive ? 'active' : '']">
                            <a href="#"
                               @click.prevent="changePage(page)">@{{ page }}</a>
                        </li>
                        <li v-if="pagination.current_page < pagination.last_page">
                            <a href="#" aria-label="Next"
                               @click.prevent="changePage(pagination.current_page + 1)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</books-index>
@endsection
