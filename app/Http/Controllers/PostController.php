<?php

namespace App\Http\Controllers;

use App\Post;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        $items = [
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 1,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 2,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 3,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 4,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 5,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 6,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 7,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 8,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 9,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ],
            [
                'body' => "Atque in dolores est. Dolor aut ut aspernatur a qui. Eos eligendi ipsam et omnis quia totam voluptatem. Quia cum explicabo facere repellat.",
                'created_at' => "2018-03-17 03:14:02",
                'id' => 10,
                'title' => "Prof.",
                'updated_at' => "2018-03-17 03:14:02"
            ]
        ];
        //$posts = $this->paginate($items, 10);
        $client = new Client();

        //$ResponsePhotos = $client->request('GET', 'https://jsonplaceholder.typicode.com/photos');
        $out = [];
        foreach ($posts as $k => $post) {
            try {
                $ResponsePhoto = $client->request('GET', 'https://jsonplaceholder.typicode.com/photos/'.$post->id);
                $photo = json_decode($ResponsePhoto->getBody(true)->getContents());
                $posts[$k]->url = $photo->url;
                $out[] = $k;
            } catch (\Exception $e) {
                $posts[$k]->url = null;
                $out[] = $k;
            }

            // Send an asynchronous request.
            // $request = new \GuzzleHttp\Psr7\Request('GET', 'https://jsonplaceholder.typicode.com/photos/'.$id);
            // $promise = $client->sendAsync($request)->then(function ($ResponsePhoto) {
            //     $photo = json_decode($ResponsePhoto->getBody(true)->getContents());
            //     return $photo->url;
            // });
            // $posts[$k]->url = $promise->wait();
        }
        $response = [
            'pagination' => [
                'total'        => $posts->total(),
                'per_page'     => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'from'         => $posts->firstItem(),
                'to'           => $posts->lastItem()
            ],
            'data' => $posts,
            'photos' => $out
        ];
        
        return response()->json($response);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        //$page = $request->get('page', 1);
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : collect($items);// Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function paginator(Request $request)
    {
        $rpp = $request->input('rpp');
        $type = $request->input('type') == 1 ? 'asc' : 'desc';
        $unit = $request->input('unit') == 1 ? 'MOD(id,2)=0' : ($request->input('unit') == 2 ? 'MOD(id,2)=1' : null);
        $asd = $request->input('activityStartDate');
        $psd = $request->input('purchaseStartDate');
        $aa = $request->input('activityArea');

        $o = Post::orderBy('title', $type);
        if ($unit) {
            $o->whereRaw($unit);
        }
        if ($asd) {
            $o->where('created_at', '<=', $asd);
        }
        if ($aa) {
            //$o->leftJoin('activities', 'activities.title', 'promotions.title');
            //$o->leftJoin('activities', 'areas.title', 'areas.title');
        }
        $posts = $o->paginate($rpp ? $rpp : 10);
        $client = new Client();

        $out = [];
        foreach ($posts as $k => $post) {
            try {
                $ResponsePhoto = $client->request('GET', 'https://jsonplaceholder.typicode.com/photos/'.$post->id);
                $photo = json_decode($ResponsePhoto->getBody(true)->getContents());
                $posts[$k]->url = $photo->url;
                $out[] = $k;
            } catch (\Exception $e) {
                $posts[$k]->url = null;
                $out[] = $k;
            }
        }
        $response = [
            'pagination' => [
                'total'        => $posts->total(),
                'per_page'     => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'from'         => $posts->firstItem(),
                'to'           => $posts->lastItem()
            ],
            'data' => $posts,
            'photos' => $out
        ];
        
        return response()->json($response);        
    }

    public function sortByTitle(Request $request)
    {
        $rpp = $request->input('rpp');
        $type = $request->input('type');
        $unit = $request->input('unit') == 1 ? 'MOD(id,2)=0' : ($request->input('unit') == 2 ? 'MOD(id,2)=1' : null);
        if ($unit) {
            $posts = Post::whereRaw($unit)->orderBy('title', $type)->paginate($rpp ? $rpp : 10);
        } else {
            $posts = Post::orderBy('title', $type)->paginate($rpp ? $rpp : 10);
        }
        
        $client = new Client();

        $out = [];
        foreach ($posts as $k => $post) {
            try {
                $ResponsePhoto = $client->request('GET', 'https://jsonplaceholder.typicode.com/photos/'.$post->id);
                $photo = json_decode($ResponsePhoto->getBody(true)->getContents());
                $posts[$k]->url = $photo->url;
                $out[] = $k;
            } catch (\Exception $e) {
                $posts[$k]->url = null;
                $out[] = $k;
            }
        }
        $response = [
            'pagination' => [
                'total'        => $posts->total(),
                'per_page'     => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'from'         => $posts->firstItem(),
                'to'           => $posts->lastItem()
            ],
            'data' => $posts,
            'photos' => $out
        ];
        
        return response()->json($response);        
    }
}
