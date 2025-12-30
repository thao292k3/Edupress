@extends('frontend.master')

@section('content')
<style>
    /* Tổng thể */
    .blog-page-header { padding: 40px 0 20px; }
    .blog-title { font-size: 2.5rem; font-weight: 700; color: #333; }
    
    /* Card bài viết */
    .blog-card { 
        border: 1px solid #eee; 
        border-radius: 12px; 
        overflow: hidden; 
        height: 100%; 
        transition: transform 0.3s;
        background: #fff;
    }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    
    .blog-img-box { height: 200px; overflow: hidden; }
    .blog-img-box img { width: 100%; height: 100%; object-fit: cover; }
    
    .blog-body { padding: 20px; }
    .blog-meta { color: #888; font-size: 0.85rem; margin-bottom: 10px; }
    .blog-card-title { font-size: 1.15rem; font-weight: 600; line-height: 1.4; margin-bottom: 12px; }
    .blog-card-title a { color: #333; text-decoration: none; }
    .blog-excerpt { color: #666; font-size: 0.9rem; line-height: 1.6; }

    /* Sidebar Styles */
    .sidebar-widget { margin-bottom: 40px; }
    .sidebar-title { 
        font-size: 1.2rem; font-weight: 700; margin-bottom: 20px; 
        padding-bottom: 10px; border-bottom: 2px solid #f0f0f0; 
    }
    .widget-list { list-style: none; padding: 0; }
    .widget-list li { 
        display: flex; justify-content: space-between; 
        padding: 8px 0; color: #555; font-size: 0.95rem;
    }
    .tag-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag-item { 
        padding: 6px 15px; border: 1px solid #eee; border-radius: 6px;
        color: #666; font-size: 0.85rem; text-decoration: none;
    }
    .tag-item:hover { border-color: #007bff; color: #007bff; }
</style>

<div class="container blog-page-header">
    <div class="d-flex justify-content-between align-items-end">
        <h1 class="blog-title">Blog</h1>
        <p class="text-muted small">Showing 1 – {{ $blogs->count() }} of {{ $blogs->total() }} results</p>
    </div>
</div>

<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @forelse($blogs as $blog)
                        <div class="col-md-6 mb-4">
                            <div class="blog-card">
                                <div class="blog-img-box">
                                    <a href="{{ route('frontend.blog.show', $blog->slug ?? $blog->id) }}">
                                        <img src="{{ asset($blog->image ?? 'frontend/images/default-post.jpg') }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="blog-body">
                                    <div class="blog-meta">
                                        <i class="la la-calendar-o"></i> {{ optional($blog->created_at)->format('F d, Y') }}
                                    </div>
                                    <h5 class="blog-card-title">
                                        <a href="{{ route('frontend.blog.show', $blog->slug ?? $blog->id) }}">
                                            {{ Str::limit($blog->title, 60) }}
                                        </a>
                                    </h5>
                                    <p class="blog-excerpt">
                                        {{ Str::limit(strip_tags($blog->description), 110) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p>No posts found.</p></div>
                    @endforelse
                </div>
                
                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>

            <div class="col-lg-3">
                <div class="sidebar-widget">
                    <h5 class="sidebar-title">Categories</h5>
                    <ul class="widget-list">
                        @foreach($categories as $cat)
                        <li>
                            <span>{{ $cat->name }}</span>
                            <span class="text-muted">({{ $cat->course_count ?? 0 }})</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h5 class="sidebar-title">Archives</h5>
                    <ul class="widget-list flex-column">
                        @foreach($archives as $archive)
                        <li class="border-0 py-1">
                            <a href="#" class="text-secondary">{{ Carbon\Carbon::parse($archive->ym)->format('F Y') }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h5 class="sidebar-title">Tags</h5>
                    <div class="tag-cloud">
                        <a href="#" class="tag-item">Certificates</a>
                        <a href="#" class="tag-item">Education</a>
                        <a href="#" class="tag-item">Instructor</a>
                        <a href="#" class="tag-item">Languages School</a>
                        <a href="#" class="tag-item">Member</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection