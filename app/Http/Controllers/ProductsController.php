<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Echo_;

class ProductsController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            echo Auth::user()->name;
            $products = Product::all()->where('id_user', Auth::user()->id);
            return view('products.index',compact('products'))
                    ->with('i',(request()->input('page', 1) - 1) * 5);
        }
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->id_user = Auth::user()->id;
        $product->_token = Str::random(40);
        $product->save();

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}