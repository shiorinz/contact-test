<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function search(Request $request)
    {
        $query = Contact::query();

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('email', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'like', "%{$keyword}%")
                  ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->category)) {
            $query->where('type', $request->category);
        }

        if (!empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->paginate(7)->appends($request->query());

        return view('admin', compact('contacts'));
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Contact::query();

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('email', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'like', "%{$keyword}%")
                  ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        if (!empty($request->category)) {
            $query->where('type', $request->category);
        }

        if (!empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '作成日'
            ]);

            foreach ($contacts as $contact) {
                $gender = match ($contact->gender) {
                    'male' => '男性',
                    'female' => '女性',
                    default => 'その他',
                };

                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel1 . $contact->tel2 . $contact->tel3,
                    $contact->address,
                    $contact->building,
                    $contact->type,
                    $contact->detail,
                    optional($contact->created_at)->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        });

        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }
}