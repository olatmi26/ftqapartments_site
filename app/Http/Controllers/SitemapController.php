<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(route('home'), '2022-12-10T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(route('about'), '2022-12-10T12:30:00+02:00', '0.9', 'monthly');
        $sitemap->add(route('property.index'), '2022-12-10T12:30:00+02:00', '0.9', 'monthly');
        $sitemap->add(route('property.create'), '2022-12-10T12:30:00+02:00', '0.9', 'monthly');

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}