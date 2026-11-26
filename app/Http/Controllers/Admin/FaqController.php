<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('urutan')->orderBy('id')->get();
        return view('admin.faq', compact('faqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban'    => ['required', 'string'],
            'urutan'     => ['required', 'integer', 'min:1'],
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faq')->with('sukses', 'Pertanyaan FAQ berhasil ditambahkan.');
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban'    => ['required', 'string'],
            'urutan'     => ['required', 'integer', 'min:1'],
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faq')->with('sukses', 'Pertanyaan FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq')->with('sukses', 'Pertanyaan FAQ berhasil dihapus.');
    }
}