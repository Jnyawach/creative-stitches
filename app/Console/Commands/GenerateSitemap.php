<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\FaqCategory;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Site map';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/contact-us'))
            ->add(Url::create('/help-center'))
            ->add(Url::create('/help-center'))
            ->add(Url::create('/blog'))
            ->add(Url::create('/custom-embroidery'))
            ->add(Url::create('/terms-and-condition'))
            ->add(Url::create('/privacy-policy'))
            ->add(Url::create('/cookie-policy'))
            ->add(Url::create('/shop'))
            ->add(Url::create('/'));
        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(Url::create("/shop/{$product->slug}"));
        });
        Post::all()->each(function (Post $blog) use ($sitemap) {
            $sitemap->add(Url::create("/blog/{$blog->slug}"));
        });
        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create("/shop/category/{$category->slug}"));
        });
        FaqCategory::all()->each(function (FaqCategory $category) use ($sitemap) {
            $sitemap->add(Url::create("/help-center/{$category->slug}"));
        });
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
