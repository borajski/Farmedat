<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAction;
use App\Models\Photo;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if ((auth()->user()->details->role) == 'admin')
      {
      $query = (new Product())->newQuery();
      $proizvodi = $query->orderBy('name')->get();
      return view('back.layouts.products.index')->with('proizvodi',$proizvodi);
    }
    else {
      $vendor = auth()->user()->vendors->id;
      $query = (new Product())->newQuery()->where('vendor_id',$vendor);
      $proizvodi = $query->orderBy('name')->get();
      return view('back.layouts.products.index')->with('proizvodi',$proizvodi);
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = (new Category())->newQuery();
        $kategorije = $query->orderBy('name')->get();
        return view('back.layouts.products.edit')->with('kategorije',$kategorije);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $product         = new Product();
      $product_created = $product->validateRequest($request)->store();
      if ($product_created)
      {
        if ($request->hasFile('image'))
        {
          $path = Photo::imageUpload($request->file('image'), $product_created, 'products', 'image');

          $product->updateImagePath($product_created->id, $path);
        }
        if ($request->hasFile('images'))
        {
          $broj = count($request->images);
          foreach ($request->images as $slika) {
            $image = new ProductImage();
            $stored = $image->storeImage($request,$product_created->id);
            if ($stored)
            {
              $path = Photo::imageUpload($slika, ProductImage::find($stored), 'products', 'image');
              $image->updateImagesPath($stored, $path);
            }
          }

        }
          return redirect('/proizvodi')->with(['success' => 'Product je uspješno spremljen!']);
      }

      else
        return redirect()->back()->with(['error' => 'Whoops..! There was an error saving the product.']);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proizvod = Product::find($id);
        $slike = $proizvod->productimages;
        $query = (new Category())->newQuery();
        $kategorije = $query->orderBy('name')->get();
        return view('back.layouts.products.edit')->with('proizvod',$proizvod)->with('kategorije',$kategorije)->with('slike',$slike);
    }
    public function front_show($id)
    {
        $proizvod = Product::find($id);
        $slike = $proizvod->productimages;
        $query = (new Category())->newQuery();
        $kategorije = $query->orderBy('name')->get();
        return view('front_layouts.proizvodi.proizvod')->with('proizvod',$proizvod)->with('kategorije',$kategorije)->with('slike',$slike);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $product         = new Product();
      $product_updated = $product->validateRequest($request)->store($id);

      if ($product_updated) {
        if ($request->hasFile('image'))
        {
          $path = Photo::imageUpload($request->file('image'), $product_updated, 'products', 'image');
          $product->updateImagePath($product_updated->id, $path);
        }
        if ($request->hasFile('images'))
        {
          $broj = count($request->images);
          foreach ($request->images as $slika) {
            $image = new ProductImage();
            $stored = $image->storeImage($request,$product_updated->id);
            if ($stored)
            {
              $path = Photo::imageUpload($slika, ProductImage::find($stored), 'products', 'image');
              $image->updateImagesPath($stored, $path);
            }
          }

        }
      return redirect('/proizvodi')->with(['success' => 'Proizvod je uspješno spremljen!']);
      }

      return redirect()->back()->with(['error' => 'Whoops..! Došlo je do greške sa snimanjem proizvoda.']);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public static function dajvrstu(Request $request)
    {
        $query = (new Subcategory())->newQuery();
        $podkategorije = $query->where("category_id",$request->kat_id)->orderBy('name')->pluck("name","id");
        return response()->json($podkategorije);
  }
  public static function brisiSliku($id)
  {
      $slika = ProductImage::find($id);
      $proizvod = $slika->product_id;
      Photo::imageDelete($slika,'products','image');
      $slika->delete();
      return redirect()->route('product', [$proizvod])->with(['success' => 'Slika je  uspješno obrisana!']);

}
public function index_front()
    {
        $products = Product::all();
        return view('front.proizvodi', compact('products'));
    }
public function cart()
    {
        return view('front_layouts.naplata.cart');
    }
    public function addToCart($id,$n)
      {
          $product = Product::find($id);

          if(!$product) {

              abort(404);

          }

          $cart = session()->get('cart');

          // if cart is empty then this the first product
          if(!$cart) {
            if ($product->productactions)
              $popust = $product->productactions->discount;
            else
              $popust = 0;

              $cart = [
                      $id => [
                          "name" => $product->name,
                          "prod_id" =>$product->id,
                          "vendor_id" =>$product->vendor_id,
                          "quantity" => $n,
                          "price" => $product->price,
                          "discount" => $popust,
                          "photo" => $product->image
                      ]
              ];

              session()->put('cart', $cart);

              return redirect()->back()->with('success', 'Product added to cart successfully!');
          }

          // if cart not empty then check if this product exist then increment quantity
          if(isset($cart[$id])) {

              $cart[$id]['quantity']++;

              session()->put('cart', $cart);

              return redirect()->back()->with('success', 'Product added to cart successfully!');

          }

          // if item not exist in cart then add to cart with quantity = 1
          if ($product->productactions)
            $popust = $product->productactions->discount;
          else
            $popust = 0;
          $cart[$id] = [
              "name" => $product->name,
              "prod_id" =>$product->id,
              "vendor_id" =>$product->vendor_id,
              "quantity" => $n,
              "price" => $product->price,
              "discount" =>$popust,
              "photo" => $product->image
          ];

          session()->put('cart', $cart);

          return redirect()->back()->with('success', 'Product added to cart successfully!');
      }
      public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
