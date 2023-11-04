<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;

   class SitemapController extends Controller
   {
       public function edit()
       {
        $breadcrumbs = [
            ['Dashboard', route('admin.home')],
            ['Sitemap', route('admin.general.sitemap')],
        ];
        $path = '/var/www/html/a3logics/frontend/public/sitemap.xml';

        //    if (File::exists($path)) {
               $sitemapContent = File::get($path);
               return view('admin.sitemap.index', compact('sitemapContent','breadcrumbs'));
        //    }

           abort(404);
       }

       public function update(Request $request)
       {
           $path = '/var/www/html/a3logics/frontend/public/sitemap.xml';

        //    if (File::exists($path)) {
            try {
                File::put($path, $newContent);
                return redirect()->route('admin.editSitemap')->with('success', 'Sitemap updated successfully');
            } catch (\Exception $e) {
                return redirect()->route('admin.editSitemap')->with('error', 'Error updating the sitemap: ' . $e->getMessage());
            }
       }
   }