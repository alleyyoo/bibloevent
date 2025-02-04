<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Parasut\Products;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    public function index($category_id = null)
    {
        Config::set('title', 'Sayfalar');

        $pages = Page::where('category_id', $category_id)->orderBy('sort_id', 'asc')->get();
        $category = Page::findOrNew($category_id);

        return view('admin.pages', compact('pages', 'category'));
    }

    public function createForm($category_id = null, $page_type = null)
    {
        Config::set('title', 'Sayfa Oluşturma');

        $category = Page::findOrNew(request('category_id'));

        $view = 'admin.additional.' . (is_array($category->view->back) ? $category->view->back[1] : $category->view->back) . '.create';

        return view($view, compact('category'));
    }

    public function create(Request $request)
    {
        try {
            $category = Page::findOrNew($request->category_id);

            $validate = ['title' => 'required|min:2'];

            $request->validate($validate);

            $data = [
                'category_id' => $category->id,
                'sort_id' => $category->childCount + 1,
                'is_active' => $request->is_active == 'on',
                'title' => $request->title,
                'body' => $request->body,
                'front_view' => is_array($category->view->front) ? implode(',', array_slice($category->view->front, 1)) : $category->view->front,
                'front_layout' => $category->layout->front,
                'back_view' => $request->back_layout ?? (is_array($category->view->back) ? implode(',', array_slice($category->view->back, 1)) : $category->view->back),
                'back_layout' => $category->layout->back,
            ];

            if ($request->has('is_visible')) {
                $data['is_visible'] = $request->is_visible == 'on';
            }

            if ($request->has('is_menu')) {
                $data['is_menu'] = $request->is_menu == 'on';
            }

            $content = Config::get('content');
            $front_view = $data['front_view'];
            if (in_array($front_view, array_keys($content))) {
                foreach ($content[$front_view] as $name) {
                    $data[$name] = $request->$name;
                }
            }

            $page = Page::createPage($data);

            return redirect(route('admin.pages', ['category_id' => $category->id ?? '']))->with('status', 'Sayfa başarıyla oluşturuldu.');
        } catch (Exception $e) {
            return redirect()->back()->with('status', $e->getMessage());
        }
    }

    public function updateForm($id)
    {
        Config::set('title', 'Sayfa Güncelleme');

        $page = Page::findOrFail($id);
        $category = Page::findOrNew($page->category_id);

        $view = 'admin.additional.' . $page->back->view . '.update';

        return view($view, compact('page', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);

            $validate = ['title' => 'required|min:2'];

            $request->validate($validate);

            $data = [
                'category_id' => $page->category->id ?? null,
                'is_active' => $request->is_active == 'on',
                'title' => $request->title,
                'body' => $request->body,
            ];

            if ($request->has('is_visible')) {
                $data['is_visible'] = $request->is_visible == 'on';
            }

            if ($request->has('is_menu')) {
                $data['is_menu'] = $request->is_menu == 'on';
            }

            $content = Config::get('content');
            $front_view = $page->front->view;

            if (in_array($front_view, array_keys($content))) {
                foreach ($content[$front_view] as $name) {
                    $data[$name] = $request->$name;
                }
            }

            $page = $page->updatePage($data);

            return redirect(route('admin.pages', ['category_id' => $page->category->id ?? '']))->with('status', 'Sayfa başarıyla güncellendi');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', $e->getMessage());
        }
    }

    public function delete($id)
    {
        Page::where('id', $id)->delete();
    }

    public function active(Request $request, $id)
    {
        Page::where('id', $id)->update(['is_active' => $request->value == 'true']);
    }

    public function sort(Request $request, $parent_id = 0)
    {
        foreach ($request->value as $key => $id) {
            Page::where('id', $id)->update(['sort_id' => $key + 1]);
        }
    }
}
