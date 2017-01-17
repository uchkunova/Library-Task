<template>
    <div class="form-group top-buffer-20" style="height: 420px">
        <div style="width: 100%; height:182.1px;" class="form-group">
            <img :src="images_url+book.cover_path"
                 alt="book.id"
                 style="width:100%; height:100%;"
            >
        </div>
        <div class="form-group">
            <div class="text-center">
                Book: {{ book.title }}
            </div>
            <div class="text-center">
                Author: {{ book.author }}
            </div>
            <div class="text-center">
                Pages: {{book.page_count}}
            </div>
            <div class="text-center">
                Format: {{book.format}}
            </div>
            <div class="text-center">
                ISBN: {{book.isbn}}
            </div>
            <div class="text-center">
                Publish Date: {{book.publish_date}}
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['book'],

        data() {
            return{
                images_url: Laravel.basePath + 'uploads/'
            }
        }
    }
</script>
