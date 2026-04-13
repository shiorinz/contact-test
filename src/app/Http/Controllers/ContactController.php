<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'type',
            'detail',
            'category_id'
        ]);

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $data = $request->all();

        $data['category_id'] = match ($data['type']) {
            '商品のお届けについて' => 1,
            '商品の交換について' => 2,
            '商品トラブル' => 3,
            'ショップへのお問い合わせ' => 4,
            default => 1,
        };

        Contact::create($data);

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function back(Request $request)
    {
    return redirect('/')
        ->withInput($request->all());
    }
}