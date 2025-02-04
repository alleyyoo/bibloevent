<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SendGrid\Mail\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Page::isActive()->find(6);
        $projects = Page::isActive()->find(3);
        $teams = Page::isActive()->find(4);
        return view('anasayfa', compact('sliders', 'projects', 'teams'));
    }

    public function show($slug)
    {
        $cartValue = Session::get('cart')['count'] ?? 0;
        $page = Page::whereTranslation('slug', $slug)->isActive()->firstOrFail();
        Config::set('title', $page->title);

        $data = [
            'page' => $page,
            'breadcrumbs' => $page->breadcrumbs(),
        ];
//        , compact('products')

        if (view()->exists($page->front->view)) {
            return view($page->front->view, $data, compact('cartValue'));
        }

        abort(404);
    }


    public function search($search)
    {
        $pages = Page::isVisible()
            ->where(function ($query) use ($search) {
                $query->whereTranslationLike('body', "%$search%")
                    ->orWhereTranslationLike('title', "%$search%");
            })
            ->get();

        return view('search', compact('pages'));
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (Newsletter::whereEmail($request->email)->exists()) {
            return response(['message' => __('E-mail address already registered')]);
        } else {
            if (Newsletter::create(['email' => $request->email])) {
                return response(['message' => __('E-mail address has been saved')]);
            }
        }

        return response(['message' => __('Registration failed')]);
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namesurname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'service' => 'required',
        ]);

        if ($validator->fails()) {
            $returnMessage = __('Your message could not be sent. Please try again.');
            $style = 'error';
            return response([
                'status' => $style,
                'message' => $returnMessage
            ]);
        }

        $subject = 'BAŞVURU FORMU';

        $html = "<h4>Bir Başvuru Formu Aldık. Bilgiler aşağıdaki gibidir.</h4>";
        $html .= "<strong>AD-SOYAD</strong> $request->namesurname<br>";
        $html .= "<strong>TELEFON</strong> $request->phone<br>";
        $html .= "<strong>E-POSTA</strong> $request->email<br>";
        $html .= "<strong>HİZMET</strong> $request->service<br>";

        $email = new Mail();
        $email->setFrom("smtp@webolizma.net", config('setting.title'));
        $email->setSubject($subject);
        $email->addTo(config('setting.contactEmail'), $subject);
        $email->addContent("text/html", $html);


        $sendgrid = new \SendGrid('');
        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 202) {
                $returnMessage = __('Your message has been sent. You will be contacted shortly.');
                $style = 'success';
                return response([
                    'status' => $style,
                    'message' => $returnMessage
                ]);
            } else {
                $returnMessage = __('Your message could not be sent. Please try again.');
                $style = 'error';
                return response([
                    'status' => $style,
                    'message' => $returnMessage
                ]);
            }

        } catch (\Exception $e) {
            $returnMessage = __('Your message could not be sent. Please try again.');
            $style = 'error';
            return response([
                'status' => $style,
                'message' => $returnMessage
            ]);
        }
    }

    public function productFilter(Request $request)
    {
        $id = $request->get('id');
        $filterArray = $request->get('value');
        $dataID = $request->get('dataID');

        $page = Page::isActive()->find($id);

        $data = [];


        if ($filterArray){
            foreach ($filterArray as $key => $filter) {
                foreach ($page->contents->tableRow as $row) {
                    $f = $dataID[$key];
                    if ($row->$f == $filter) {
                        if (!in_array((array)($row), $data)) {
                            $data[] = (array)($row);
                        }
                    }
                }
            }

            return response([
                'list' => $data
            ]);
        } else {
            foreach ($page->contents->tableRow as $row) {
                $data[] = (array)($row);
            }

            return response([
                'list' => $data
            ]);
        }

    }
}
