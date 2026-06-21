<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\ClaimedPromo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = Promo::where('is_active', true)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->latest()->get();
        return view('promos.all', compact('promos'));
    }

    public function adminIndex()
    {
        $promos = Promo::latest()->get();
        return view('promos.index', compact('promos'));
    }

    public function claim(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first to claim this promo.'
            ], 401);
        }

        $user = Auth::user();
        $promo = Promo::findOrFail($id);

        if (today()->gt($promo->end_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this promo has expired.'
            ], 400);
        }

        $alreadyClaimed = DB::table('claimed_promos')
            ->where('user_id', $user->id)
            ->where('promo_id', $promo->id)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json([
                'success' => false,
                'message' => 'You have already claimed this promo before!'
            ], 400);
        }

        DB::table('claimed_promos')->insert([
            'user_id' => $user->id,
            'promo_id' => $promo->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Promo successfully claimed! Check your voucher on checkout.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('promos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:discount,buy_1_get_1,free_item',
            'value' => 'nullable|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = app(\App\Services\CloudinaryService::class);
            $uploaded = $cloudinary->uploadImage($request->file('image')->getRealPath(), 'promos');
            $input['image'] = $uploaded['secure_url'];
        }

        $input['is_active'] = true;
        Promo::create($input);
        return redirect()->route('promos.index')->with('success', 'Promo successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $input = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:discount,buy_1_get_1,free_item',
            'value' => 'nullable|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($request->hasFile('image')) {
            $cloudinary = app(\App\Services\CloudinaryService::class);
            $uploaded = $cloudinary->uploadImage($request->file('image')->getRealPath(), 'promos');
            $input['image'] = $uploaded['secure_url'];
        }

        $input['is_active'] = true;
        $promo->update($input);
        return redirect()->route('promos.index')->with('success', 'Promo successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        if ($promo->image) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();
        return redirect()->route('promos.index')->with('success', 'Promo successfully deleted!');
    }
}
