<?php

namespace App\Http\Controllers;

use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    protected $service;

    public function __construct(SectionService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        return $this->service->createSection($request->all());
    }

    public function update(Request $request, $id)
    {
       
        $this->service->updateSection($id, $request->all());

        
        return back()->with([
            'message' => 'Cập nhật chương học thành công!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        return $this->service->deleteSection($id);
    }
}
