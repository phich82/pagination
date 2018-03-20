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
            <h1>Posts</h1>

            <div class="posts">
                @foreach ($posts as $post)
                    <article>
                        <h2>{{ $post->title }}</h2>
                        {{ $post->body }}
                    </article>
                @endforeach
                {{ $posts->links() }}
            </div>

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
            <script>
            $(window).on('hashchange', function() {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else {
                        getPosts(page);
                    }
                }
            });
            $(document).ready(function() {
                $(document).on('click', '.pagination a', function (e) {
                    getPosts($(this).attr('href').split('page=')[1]);
                    e.preventDefault();
                });
            });
            function getPosts(page) {
                $.ajax({
                    url : 'paginator/list?page=' + page,
                    dataType: 'json',
                }).done(function (data) {
                    $('.posts').html(data);
                    location.hash = page;
                }).fail(function () {
                    alert('Posts could not be loaded.');
                });
            }
            </script>

        </div>
    </body>
</html>
