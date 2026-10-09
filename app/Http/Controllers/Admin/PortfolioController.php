<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        $portfolios = Portfolio::orderBy('order')
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Admin/Portfolios/Index', [
            'portfolios' => $portfolios,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Portfolios/CreateEdit', [
            'portfolio' => null,
            'isEdit' => false,
        ]);
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('portfolios', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        Portfolio::create($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio): Response
    {
        return Inertia::render('Admin/Portfolios/CreateEdit', [
            'portfolio' => $portfolio,
            'isEdit' => true,
        ]);
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail && !str_starts_with($portfolio->thumbnail, 'http')) {
                Storage::disk('public')->delete($portfolio->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('portfolios', 'public');
        } else {
            unset($data['thumbnail']);
        }

        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = $data['order'] ?? 0;

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        if ($portfolio->thumbnail && !str_starts_with($portfolio->thumbnail, 'http')) {
            Storage::disk('public')->delete($portfolio->thumbnail);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil dihapus.');
    }
}
