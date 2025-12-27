@extends('frontend.master')

@section('content')
    <section class="blog-area section--padding bg-gray overflow-hidden">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">News feeds</h5>
                <h2 class="section__title">Latest News & Articles</h2>
                <span class="section-divider"></span>
            </div><!-- end section-heading -->

            <div class="row mt-4">
                @forelse($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="{{ route('frontend.blog.show', $blog->slug ?? $blog->id) }}" class="d-block">
                                    <img class="card-img-top" src="{{ asset($blog->image ?? 'frontend/images/default-post.jpg') }}" alt="{{ $blog->title }}">
                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">{{ optional($blog->created_at)->format('M d, Y') }}</div>
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('frontend.blog.show', $blog->slug ?? $blog->id) }}">{{ $blog->title }}</a></h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 120) }}</p>
                                <a href="{{ route('frontend.blog.show', $blog->slug ?? $blog->id) }}" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                            </div><!-- end card-body -->
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No posts found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div><!-- end container -->
    </section>
@endsection
