@extends('frontend.master')

@section('content')
<style>
    /* Custom CSS để bổ trợ cho Bootstrap */
    .single-blog-area { background-color: #f8f9fa; }
    .card-item { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; }
    .post-content { line-height: 1.8; color: #444; font-size: 1.1rem; }
    .widget { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .widget-title { position: relative; padding-bottom: 12px; margin-bottom: 20px; font-weight: 700; border-bottom: 2px solid #eee; }
    .widget-title::after { content: ''; position: absolute; left: 0; bottom: -2px; width: 50px; height: 2px; background: #007bff; }
    .comment-list .media { padding: 20px; border-radius: 10px; background: #fdfdfd; border: 1px solid #f1f1f1; }
    .reply-item { border-left: 3px solid #007bff; background: #f8f9ff !important; }
    .avatar-img { object-fit: cover; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .badge-tag { padding: 8px 15px; border-radius: 50px; transition: 0.3s; background: #eee; color: #555; text-decoration: none !important; }
    .badge-tag:hover { background: #007bff; color: #fff; }
</style>

<section class="single-blog-area section--padding py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-item mb-5">
                    <img src="{{ asset($blog->image ?? 'frontend/images/default-post.jpg') }}" class="card-img-top" alt="{{ $blog->title }}" style="max-height: 450px; object-fit: cover; object-position: center;;">
                    <div class="card-body p-4 p-lg-5">
                        <div class="mb-3">
                            <span class="badge badge-primary px-3 py-2 mb-2">Blog Post</span>
                            <h1 class="card-title h2 font-weight-bold">{{ $blog->title }}</h1>
                            <div class="d-flex align-items-center text-muted small">
                                <span class="mr-3"><i class="la la-calendar mr-1"></i>{{ optional($blog->created_at)->format('M d, Y') }}</span>
                                <span><i class="la la-user mr-1"></i>By Admin</span>
                            </div>
                        </div>
                        <hr>
                        <div class="post-content mt-4">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>

                <div class="card card-item mb-4" id="comments">
                    <div class="card-body p-4 p-lg-5">
                        <h4 class="font-weight-bold mb-4">Thảo luận ({{ $comments->count() }})</h4>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        <div class="comment-list">
                            @forelse($comments as $c)
                                <div class="media mb-4">
                                    <img class="mr-3 avatar-img" src="{{ $c->user? asset($c->user->photo ?? 'frontend/images/small-avatar-1.jpg') : asset('frontend/images/small-avatar-1.jpg') }}" width="60" height="60" alt="avatar">
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mt-0 font-weight-bold">{{ $c->user? $c->user->name : 'Guest' }}</h6>
                                            <small class="text-muted">{{ $c->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="text-secondary">{{ $c->content }}</p>
                                        
                                        <div class="d-flex align-items-center mt-2">
                                            <button class="btn btn-sm btn-light border mark-helpful mr-3" data-id="{{ $c->id }}">
                                                <i class="la la-thumbs-up"></i> Hữu ích (<span class="helpful-count">{{ $c->helpful_count }}</span>)
                                            </button>
                                            <a href="#reply-form-{{ $c->id }}" data-toggle="collapse" class="small font-weight-bold text-primary">Trả lời</a>
                                        </div>

                                        @foreach($c->replies as $r)
                                            <div class="media mt-4 reply-item p-3">
                                                <img class="mr-3 avatar-img" src="{{ $r->user? asset($r->user->photo ?? 'frontend/images/small-avatar-1.jpg') : asset('frontend/images/small-avatar-1.jpg') }}" width="45" height="45" alt="avatar">
                                                <div class="media-body">
                                                    <h6 class="mt-0 font-weight-bold small">{{ $r->user? $r->user->name : 'Guest' }}</h6>
                                                    <p class="mb-0 small text-secondary">{{ $r->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="collapse mt-3" id="reply-form-{{ $c->id }}">
                                            <form action="{{ route('frontend.blog.comment.store', $blog->slug) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $c->id }}">
                                                @auth
                                                    <textarea name="content" class="form-control mb-2" rows="2" placeholder="Nhập câu trả lời..."></textarea>
                                                    <button class="btn btn-primary btn-sm px-4">Gửi</button>
                                                @else
                                                    <p class="small">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để trả lời.</p>
                                                @endauth
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên!</p>
                                </div>
                            @endforelse
                        </div>

                        <hr class="my-5">

                        <h5 class="font-weight-bold mb-3">Để lại bình luận</h5>
                        @auth
                            <form action="{{ route('frontend.blog.comment.store', $blog->slug) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control border-0 bg-light" rows="4" placeholder="Ý kiến của bạn về bài viết..." required></textarea>
                                </div>
                                <button class="btn btn-primary btn-lg px-5">Gửi bình luận</button>
                            </form>
                        @else
                            <div class="alert alert-light border text-center">
                                <p class="mb-0">Vui lòng <a href="{{ route('login') }}" class="font-weight-bold">đăng nhập</a> hoặc <a href="{{ route('register') }}" class="font-weight-bold">đăng ký</a> để bình luận.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="widget mb-4">
                    <h5 class="widget-title">Tìm kiếm</h5>
                    <form action="{{ route('frontend.posts') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control border-right-0" placeholder="Tìm kiếm bài viết..." value="{{ request('q') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0" type="submit text-white"><i class="la la-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="widget mb-4">
                    <h5 class="widget-title">Chuyên mục</h5>
                    <ul class="list-unstyled mb-0">
                        @foreach($categories as $cat)
                            <li class="d-flex justify-content-between align-items-center mb-2">
                                <a href="#" class="text-dark">{{ $cat->name }}</a>
                                <span class="badge badge-pill badge-light border">{{ $cat->course->count() ?? 0 }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="widget mb-4">
                    <h5 class="widget-title">Bài viết gần đây</h5>
                    @foreach($recent as $recentPost)
                        <div class="media mb-3 align-items-center">
                            <img src="{{ asset($recentPost->image ?? 'frontend/images/default-post.jpg') }}" class="mr-3 rounded" width="70" height="50" style="object-fit: cover;">
                            <div class="media-body">
                                <h6 class="mb-0 small font-weight-bold">
                                    <a href="{{ route('frontend.blog.show', $recentPost->slug ?? $recentPost->id) }}" class="text-dark">{{ Str::limit($recentPost->title, 40) }}</a>
                                </h6>
                                <small class="text-muted">{{ optional($recentPost->created_at)->format('M d, Y') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="widget mb-4">
                    <h5 class="widget-title">Thẻ bài viết</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @if($blog->tags)
                            @foreach(explode(',', $blog->tags) as $tag)
                                <a href="#" class="badge-tag small mb-2 mr-2">{{ trim($tag) }}</a>
                            @endforeach
                        @else
                            <p class="small text-muted">Không có thẻ</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection