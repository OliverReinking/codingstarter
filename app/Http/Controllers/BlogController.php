<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use Inertia\Inertia;
use App\Models\BlogImage;
use App\Models\BlogAuthor;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RequestAdminStoreAndUpdateBlog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_blog_index()
    {
        $blogs = Blog::select(
            'blogs.id as id',
            'blogs.title as title',
            'blogs.blog_date as blog_date',
            'blogs.markdown_on as markdown_on',
            'blog_authors.name as author_name',
            'blog_categories.name as category_name',
        )
            ->join('blog_authors', 'blog_authors.id', '=', 'blogs.blog_author_id')
            ->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->filterBlog(Request::only('search'))
            ->orderBy('blog_date', 'desc')
            ->paginate(10)
            ->withQueryString();
        //
        return Inertia::render('Application/Admin/BlogList', [
            'filters' => Request::all('search'),
            'blogs' => $blogs,
        ]);
    }
    //
    public function admin_blog_create()
    {
        $blog = new Blog;
        $blog->id = 0;
        $blog->blog_author_id = 1;
        $blog->blog_category_id = 1;
        $blog->blog_image_id = 1;
        $blog->blog_date = Carbon::now();
        $blog->reading_time = 5;
        //
        $blog_authors = BlogAuthor::select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id');
        //
        $blog_categories = BlogCategory::select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id');
        //
        $blog_images = BlogImage::select('id', 'name', 'url')
            ->orderBy('name')
            ->get();
        //
        return Inertia::render('Application/Admin/BlogForm', [
            'blog' => $blog,
            'blog_authors' => $blog_authors,
            'blog_categories' => $blog_categories,
            'blog_images' => $blog_images,
        ]);
    }
    //
    public function admin_blog_store(RequestAdminStoreAndUpdateBlog $request)
    {
        $blog = Blog::Create([
            'blog_author_id' => $request->blog_author_id,
            'blog_category_id' => $request->blog_category_id,
            'blog_image_id' => $request->blog_image_id,
            'blog_date' => $request->blog_date,
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'reading_time' => $request->reading_time,
            'audio_on' => $request->audio_on,
            'audio_url' => $request->audio_url,
            'audio_duration' => $request->audio_duration,
        ]);
        //
        return Redirect::route('admin.blog.edit', $blog->id)
            ->with(['success' => 'Die Daten des neuen Blogartikels wurden erfolgreich abgespeichert.']);
    }
    //
    public function admin_blog_edit(Blog $blog)
    {
        $blog_authors = BlogAuthor::select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id');
        //
        $blog_categories = BlogCategory::select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id');
        //
        $blog_images = BlogImage::select('id', 'name', 'url')
            ->orderBy('name')
            ->get();
        //
        return Inertia::render('Application/Admin/BlogForm', [
            'blog' => $blog,
            'blog_authors' => $blog_authors,
            'blog_categories' => $blog_categories,
            'blog_images' => $blog_images,
        ]);
    }
    //
    public function admin_blog_update(Blog $blog, RequestAdminStoreAndUpdateBlog $request)
    {
        $blog->blog_author_id = $request->blog_author_id;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->blog_image_id = $request->blog_image_id;
        $blog->blog_date = $request->blog_date;
        $blog->title = $request->title;
        $blog->summary = $request->summary;
        $blog->content = $request->content;
        $blog->reading_time = $request->reading_time;
        $blog->audio_on = $request->audio_on;
        $blog->audio_url = $request->audio_url;
        $blog->audio_duration = $request->audio_duration;
        $blog->save();
        //
        return Redirect::route('admin.blog.edit', $blog->id)
            ->with(['success' => 'Die Daten des Blogartikels wurden erfolgreich geändert.']);
    }
    //
    public function admin_blog_delete(Blog $blog)
    {
        $blog->delete();
        //
        return Redirect::route('admin.blog.index')
            ->with(['success' => 'Der Blogartikel wurde erfolgreich gelöscht.']);
    }
}
