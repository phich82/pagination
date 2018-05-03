<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;

class PromotionController extends Controller
{
    private $promotionRepository;

    public function __construct(Promotion $promotion)
    {
        $this->promotionRepository = $promotion;
    }

    public function create()
    {
        return view('promotion.create');
    }

    public function store(CreatePromotionRequest $request)
    {
        $data = $request->all();
        $data['created_user'] = 'admin@test.com';
        $this->promotionRepository->create($data);
        return redirect()->back()->with('success', 'A promotion has already been created successfully.');
    }

    public function edit($id)
    {
        $promotion = $this->promotionRepository->find($id);
        
        return view('promotion.edit', compact('promotion'));
    }

    public function update(UpdatePromotionRequest $request)
    {
    }

    public function destroy($id)
    {
    }
}
