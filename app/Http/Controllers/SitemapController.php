<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Translations\PageTranslation;
use DOMAttr;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use League\Flysystem\Config;
use SimpleXMLElement;
use stdClass;
use Illuminate\Support\Facades\Redirect;
use function Couchbase\defaultDecoder;

class SitemapController extends Controller
{

    protected $link = [];

    public function language($language)
    {
        if (in_array($language, array_keys(config('languages')))) {

            $pages = Page::isActive()->translatedIn($language)->get();
            foreach ($pages as $page) {

                if ($page->front_view == 'anasayfa' && $page->category_id == null) {


                    $this->link[url('/')] = [
                        'title' => $page->{"title:$language"},
                        'updated_at' => date(DATE_ATOM, strtotime($page->updated_at)),
                        'view' => $page->front_view,
                        'url' => url('/'),
                        'language' => $language
                    ];


                } else {
                    if ($page->{"slug:$language"}) {

                        $this->link[url($page->{"slug:$language"})] = [
                            'title' => $page->{"title:$language"},
                            'updated_at' => date(DATE_ATOM, strtotime($page->updated_at)),
                            'view' => $page->front_view,
                            'url' => url($page->{"slug:$language"}),
                            'language' => $language

                        ];

                    }
                }

            }

            $xml = new DOMDocument('1.0', 'UTF-8');

            $urlset = $xml->createElement('urlset');
            $urlset->setAttribute('xmlns', url('http://www.sitemaps.org/schemas/sitemap/0.9'));

            //array to xml
            foreach ($this->link as $key) {

                $url = $xml->createElement('url');
                $loc = $xml->createElement('loc', $key['url']);

                if ($key['view'] == 'anasayfa') {
                    $priority = $xml->createElement('priority', '1.00');
                } elseif ($key['view'] == 'urunler') {
                    $priority = $xml->createElement('priority', '0.80');

                } elseif ($key['view'] == 'blog' || $key['view'] == 'iletisim') {
                    $priority = $xml->createElement('priority', '0.60');

                } else {
                    $priority = $xml->createElement('priority', '0.60');

                }
                $lastmod = $xml->createElement('lastmod', $key['updated_at']);
                $changefreq = $xml->createElement('changefreq', 'daily');

                $url->appendChild($loc);
                $url->appendChild($lastmod);
                $url->appendChild($priority);
                $url->appendChild($changefreq);
                $urlset->appendChild($url);
                $xml->appendChild($urlset);

            }

            if (url('/') . \Request::getRequestUri() == url('/sitemap.xml') . '/' . $language . '/download') {

                header('Content-disposition: attachment; filename="sitemapLanguage_' . $language . '.xml');
                header("Content-Type:text/xml");

                echo $xml->saveXML();
                exit();
            } else {

                return response($xml->saveXML(), 200, [
                    'Content-Type' => 'application/xml'
                ]);
            }

        } else {
            return redirect('/');
        }

    }

    public function index()
    {

        $lastDate = Page::where('deleted_at', '=', null)->orderBy( 'updated_at', 'desc')->pluck('updated_at')->first();

        $key = array_keys(config('languages'));
        $array = [];
        foreach ($key as $x) {
            $array[] = url('/sitemap.xml/') . '/' . $x;
        }

        $xml = new DOMDocument('1.0', 'UTF-8');

        $sitemapindex = $xml->createElement('sitemapindex');
        $sitemapindex->setAttribute('xmlns', url('/sitemap.xml'));
        foreach ($array as $key) {


            $sitemap = $xml->createElement('sitemap');
            $loc = $xml->createElement('loc', $key);
            $lastmod = $xml->createElement('lastmod', date(DATE_ATOM, strtotime($lastDate)));


            $sitemap->appendChild($loc);
            $sitemap->appendChild($lastmod);

            $sitemapindex->appendChild($sitemap);
            $xml->appendChild($sitemapindex);


        }

        if (url('/') . \Request::getRequestUri() == url('/sitemap.xml') . '/download') {
            header('Content-disposition: attachment; filename=sitemap.xml');
            header("Content-Type:text/xml");

            echo $xml->saveXML();
            exit();
        } else {
            return response($xml->saveXML(), 200, [
                'Content-Type' => 'application/xml'
            ]);
        }
    }


    public function download()
    {

    }


    public function indexAll()
    {

    }
    protected function links($category_id = null)
    {

        if ($pages = Page::where('category_id', $category_id)->isActive()->orderBy('id', 'asc')->get()) {

            $counter = 0;
            foreach ($pages as $item) {
                $counter++;


                if ($item->front_view == 'anasayfa') {

                    $array = [];

                    $keys = array_keys($item->getTranslationsArray());

                    foreach ($keys as $key) {
                        if ($key != config('app.locale')) {
                            $array[] = url('/');

                        }
                    }

                    $this->link[url('/')] = [
                        'title' => 'ANASAYFA',
                        'updated_at' => $item->updated_at,
                        'view' => $item->front_view,
                        'url' => url('/'),
                        'language' => $array
                    ];

                    $this->links($item->id);


                } else {
                    if ($item->slug) {
                        $array = [];

                        $keys = array_keys($item->getTranslationsArray());

                        foreach ($keys as $key) {
                            if ($key != config('app.locale')) {
                                $array[] = url($item->getTranslationsArray()[$key]['slug']);
                            }
                        }

                        $this->link[url($item->slug)] = [
                            'title' => $item->title,
                            'updated_at' => $item->updated_at,
                            'view' => $item->front_view,
                            'url' => url($item->slug),
                            'language' => $array

                        ];
                        $this->links($item->id);

                    }
                }
            }
        }

    }

    public function sitemap($language = 'tr')
    {
        if (in_array($language, array_keys(config('languages')))) {

            $pages = Page::isActive()->translatedIn($language)->get();
            foreach ($pages as $page) {

                if ($page->front_view == 'anasayfa' && $page->category_id == null) {


                    $this->link[url('/')] = [
                        'title' => $page->{"title:$language"},
                        'updated_at' => date(DATE_ATOM, strtotime($page->updated_at)),
                        'view' => $page->front_view,
                        'url' => url('/'),
                        'language' => $language
                    ];


                } else {
                    if ($page->{"slug:$language"}) {

                        $this->link[url($page->{"slug:$language"})] = [
                            'title' => $page->{"title:$language"},
                            'updated_at' => date(DATE_ATOM, strtotime($page->updated_at)),
                            'view' => $page->front_view,
                            'url' => url($page->{"slug:$language"}),
                            'language' => $language

                        ];

                    }
                }

            }

            $xml = new DOMDocument('1.0', 'UTF-8');

            $urlset = $xml->createElement('urlset');
            $urlset->setAttribute('xmlns', url('http://www.sitemaps.org/schemas/sitemap/0.9'));

            //array to xml
            foreach ($this->link as $key) {

                $url = $xml->createElement('url');
                $loc = $xml->createElement('loc', $key['url']);

                if ($key['view'] == 'anasayfa') {
                    $priority = $xml->createElement('priority', '1.00');
                } elseif ($key['view'] == 'urunler') {
                    $priority = $xml->createElement('priority', '0.80');

                } elseif ($key['view'] == 'blog' || $key['view'] == 'iletisim') {
                    $priority = $xml->createElement('priority', '0.60');

                } else {
                    $priority = $xml->createElement('priority', '0.60');

                }
                $lastmod = $xml->createElement('lastmod', $key['updated_at']);
                $changefreq = $xml->createElement('changefreq', 'daily');

                $url->appendChild($loc);
                $url->appendChild($lastmod);
                $url->appendChild($priority);
                $url->appendChild($changefreq);
                $urlset->appendChild($url);
                $xml->appendChild($urlset);

            }

            if (url('/') . \Request::getRequestUri() == url('/sitemap.xml') . '/' . $language . '/download') {

                header('Content-disposition: attachment; filename="sitemapLanguage_' . $language . '.xml');
                header("Content-Type:text/xml");

                echo $xml->saveXML();
                exit();
            } else {

                return response($xml->saveXML(), 200, [
                    'Content-Type' => 'application/xml'
                ]);
            }

        } else {
            return redirect('/');
        }
    }

}
