<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePromotionRequest;
use App\Promotion;

class PromotionController extends Controller
{
    public function create()
    {
        return view('promotion.create');
    }

    public function store(CreatePromotionRequest $request)
    {
        $data = $request->all();
        $data['created_user'] = 'admin@test.com';
        Promotion::create($data);
        return redirect()->back()->with('success', 'A promotion has already been created successfully.');
    }
}
