<?php 

namespace App\Http\Controllers;

use illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return "Hello Student!";
    }
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\ProductService;
    
    class ProductController extends Controller
    {
    protected $service;

    public function_construct(ProductService $service)
    {
    $this->service =$service;
    }

    public function show($id)
    {
        return response()->json(
            $this->service->getOne($id)
        );
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->service->update($id $request->all())
        );
    }
    pulic function update(Request $request, $id)
    {
        return response()->json(
            $this->service->update($id, $request->all())
        );
    }
    public functin destroy($id)
    {
        return response()->json(
            $this->service-delete($id)
        );
    }
    }
}
