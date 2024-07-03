<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Vehicle;

class ShopController extends Controller
{
    public function index(Request $request, $category = null)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $query = $request->input('query');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $year = $request->input('year');

        // Obtener etiquetas únicas de marcas, modelos y años
        $vehicles = Vehicle::with('brand:id,name')->get();

        $brandTags = collect();
        $modelTags = collect();
        $yearTags = collect();

        foreach ($vehicles as $vehicle) {
            $brandTags->push($vehicle->brand->name);
            $modelTags->push($vehicle->model);
            $yearTags->push($vehicle->year);
        }

        $uniqueBrandTags = $brandTags->unique();
        $uniqueModelTags = $modelTags->unique();
        $uniqueYearTags = $yearTags->unique();

        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhereHas('categories', function ($categoryQuery) use ($query) {
                        $categoryQuery->where('name', 'like', "%$query%");
                    })
                    ->orWhereHas('tags', function ($tagQuery) use ($query) {
                        $tagQuery->where('name', 'like', "%$query%");
                    });
            });
        }

        if ($brand) {
            $productsQuery->whereHas('tags', function ($tagQuery) use ($brand) {
                $tagQuery->where('name', $brand);
            });
        }

        if ($model) {
            $productsQuery->whereHas('tags', function ($tagQuery) use ($model) {
                $tagQuery->where('name', $model);
            });
        }

        if ($year) {
            $productsQuery->whereHas('tags', function ($tagQuery) use ($year) {
                $tagQuery->where('name', $year);
            });
        }

        if ($category) {
            $productsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        $products = $productsQuery->with('categories', 'tags')->get();

        return view('shop.index', compact(
            'products',
            'categories',
            'query',
            'category',
            'tags',
            'brand',
            'model',
            'year',
            'uniqueBrandTags',
            'uniqueModelTags',
            'uniqueYearTags'
        ));
    }


    private function userHasPurchasedProduct($userId, $productId)
    {
        return OrderItem::where('product_id', $productId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->exists();
    }

    public function show($id)
    {
        $product = Product::with(['brand', 'categories', 'tags', 'questions.answers', 'reviews.user'])->findOrFail($id);
        $userId = auth()->id();
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();
        $isInWishlist = $wishlistItem ? true : false;
        $product->increment('views');
        // Cambia el nombre de la variable para evitar posibles conflictos
        $userHasPurchased = false;

        if (auth()->check()) {
            $userHasPurchased = $this->userHasPurchasedProduct($userId, $id);
        }

        // Pasa la variable a la vista
        return view('shop.show', compact('product', 'isInWishlist', 'wishlistItem', 'userHasPurchased'));
    }

    public function storeQuestion(Request $request, $productId)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $question = new Question();
        $question->product_id = $productId;
        $question->user_id = auth()->id();
        $question->question = $request->question;
        $question->save();

        return back()->with('status', 'Pregunta agregada correctamente.');
    }

    public function answerQuestion(Request $request, $questionId)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $answer = new Answer();
        $answer->question_id = $questionId;
        $answer->answer = $request->answer;
        $answer->save();

        return back()->with('status', 'Respuesta agregada correctamente.');
    }

    public function toggleVisibility($questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->is_visible = !$question->is_visible;
        $question->save();

        return back()->with('status', 'Visibilidad de la pregunta actualizada.');
    }

    public function storeReview(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $userId = auth()->id();

        // Check if the user has purchased the product
        $hasPurchased = $this->userHasPurchasedProduct($userId, $productId);

        if (!$hasPurchased) {
            return back()->with('status', 'No puedes valorar un producto que no has comprado.');
        }

        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = auth()->id();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return back()->with('status', 'Reseña agregada correctamente.');
    }
}
