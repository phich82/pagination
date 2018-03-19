<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pagination - Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                /* text-align: center; */
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #app {
                padding: 40px 0 40px;
            }
            .content {
                padding: 10px 10px 20px;
                border-bottom: 1px solid #d3d3d3;
            }
            .content:last-child {
                border-bottom: none !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="container" id="app">
                <div class="row">
                    <div>
                        <select name="unit" v-model="unit" @change="changeUnit(unit)">
                            <option value="0">All</option>
                            <option value="1">Even</option>
                            <option value="2">Odd</option>
                        </select>
                        <span>Selected: @{{ unit }}</span>
                    </div>
                    <div>
                        <select name="titleType" v-model="titleType" @change="sortByTitle(titleType)">
                            <option value="1">Title ASC</option>
                            <option value="2">Title DESC</option>
                        </select>
                        <span>Selected: @{{ titleType }}</span>
                    </div>
                    <div>
                        <select name="rpp" v-model="rpp" @change="changeRecordsPerPage(rpp)">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>Selected: @{{ rpp }}</span>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="content" v-for="(post, index) in posts">
                            <h1>@{{ (index + 1) + '.' + post.title }}</h1>
                            <p>@{{ post.url }}</p>
                            <p>@{{ post.body }}</p>
                        </div>
                    </div>
                    {{--  pagination  --}}
                    <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchPosts(rpp)"></pagination>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
