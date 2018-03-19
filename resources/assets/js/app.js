
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('pagination', require('./components/PaginationComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        posts: {},
        pagination: { 'current_page': 1 },
        rpp: 20,
        unit: 0,
        titleType: 1
    },
    // define methods
    methods: {
        // fetch data from server
        fetchPosts: function (rpp) {
            axios.get('/paginator/posts?page=' + this.pagination.current_page + (rpp ? '&rpp='+rpp : ''))
                .then(response => {
                    console.log(response);
                    this.posts = response.data.data.data;
                    console.log(response.data.photos);
                    this.pagination = response.data.pagination;
                })
                .catch(error => console.log(error.response.data));
        },
        changeRecordsPerPage: function (rpp) {
            this.fetchPosts(rpp);
        },
        sortByTitle: function (type) {
            console.log('Type: ' + this.titleType + ' - rpp: ' + this.rpp + ' - unit: ' + this.unit);
            axios.post('/posts/sortby/title?page=' + this.pagination.current_page, {
                type: this.titleType,
                rpp: this.rpp,
                unit: this.unit
            })
                .then(response => {
                    console.log(response);
                    this.posts = response.data.data.data;
                    console.log(response.data.photos);
                    this.pagination = response.data.pagination;
                })
                .catch(error => console.log(error.response.data));
        },
        changeUnit: function (unit) {

        }
    },
    // Lifecycle Hooks
    mounted: function () { // Called after instance has been mounted
        this.fetchPosts();
    }
});
