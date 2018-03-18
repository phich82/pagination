<template>
    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
        <a class="pagination-previous" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">First page</a>
        <a class="pagination-previous" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">Previous</a>
        <a class="pagination-next" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page">Next page</a>
        <a class="pagination-next" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page">Last page</a>
        <!-- print out the numeric visiable links -->
        <ul class="pagination-list">
            <li v-for="(page, index) in pages" :key="index">
                <a class="pagination-link" :class="isCurrentPage(page) ? 'is-current' : ''" @click.prevent="changePage(page)">{{ page }}</a>
            </li>
        </ul>
    </nav>
</template>

<style>
    .pagination {  margin-top: 40px; }
</style>

<script>
    export default {
        // define props for component
        props: ['pagination', 'offset'],
        // define methods for component (not be cached)
        methods: {
            // check the current page
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            // change current page & emit a event 'paginate' for its parent
            changePage(page) {
                if (page > this.pagination.last_page) page = this.pagination.last_page;
                this.pagination.current_page = page;
                this.$emit('paginate'); // emit a event to parent
            }
        },
        // (be cached)
        // every methods in this prop is used as the getter function in prop vm
        // it meant that, if we define a method 'abc(){}', then in template, only call {{ abc }}
        // and this value will also be cached
        computed: {
            // generate the numeric visible pages
            pages() {
                let pages = [];
                // from record-n
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) from = 1;
                // to record-m
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) to = this.pagination.last_page;
                // add the visible pages to array
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>