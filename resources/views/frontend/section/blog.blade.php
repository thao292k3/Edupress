<style>
    /* Tổng thể khu vực Blog */
    .blog-area {
        background-color: #f9fbff;
        padding: 80px 0;
    }

    /* Thiết kế thẻ bài viết (Card) */
    .blog-card-modern {
        background: #fff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .blog-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(112, 121, 231, 0.12);
        /* Đổ bóng màu tím nhẹ trùng tone với theme */
    }

    /* Hình ảnh bài viết */
    .blog-img-box {
        position: relative;
        height: 230px;
        overflow: hidden;
    }

    .blog-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .blog-card-modern:hover .blog-img-box img {
        transform: scale(1.1);
    }

    /* Nhãn ngày tháng trôi trên ảnh */
    .blog-date-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        padding: 6px 15px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #7079e7;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Nội dung bài viết */
    .blog-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-category-tag {
        font-size: 0.7rem;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .blog-title-modern {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 15px;
        color: #1e293b;
        /* Giới hạn 2 dòng tiêu đề */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }

    .blog-title-modern a {
        color: inherit;
        text-decoration: none;
    }

    .blog-title-modern a:hover {
        color: #7079e7;
    }

    .blog-excerpt {
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 20px;
        /* Giới hạn 3 dòng mô tả */
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Chân thẻ: Tác giả & Nút bấm */
    .blog-footer {
        padding: 15px 25px 25px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-info img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1e293b;
    }

    .read-more-link {
        color: #7079e7;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.3s;
    }

    .read-more-link:hover {
        gap: 10px;
    }
</style>

<section class="blog-area">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h5 class="ribbon ribbon-lg mb-2">Knowledge Hub</h5>
            <h2 class="section__title" style="font-weight: 800; color: #1e293b;">Tin tức & Bài viết chia sẻ</h2>
            <span class="section-divider"></span>
        </div>

        <div class="blog-post-carousel owl-action-styled owl-carousel owl-theme">
            @forelse($blogs as $blog)
                <div class="item p-2">
                    <div class="blog-card-modern">
                        <div class="blog-img-box">
                            <a href="{{ route('frontend.blog.show', $blog->slug) }}">
                                <img src="{{ asset($blog->image ?? 'frontend/images/default-blog.jpg') }}"
                                    alt="{{ $blog->title }}">
                            </a>
                            <div class="blog-date-badge">
                                {{ $blog->created_at->format('d M, Y') }}
                            </div>
                        </div>

                        <div class="blog-content">
                            <div class="blog-category-tag">Cẩm nang học tập</div>
                            <h5 class="blog-title-modern">
                                <a href="{{ route('frontend.blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h5>
                            <p class="blog-excerpt">
                                {{ Str::limit(strip_tags($blog->description), 120) }}
                            </p>
                        </div>

                        <div class="blog-footer">
                            <div class="blog-author">
                                
                                @if ($blog->user)
                                    <img src="{{ !empty($blog->user->photo) ? url('upload/instructor_images/' . $blog->user->photo) : url('upload/no_image.jpg') }}"
                                        class="author-img">
                                    <span class="author-name">{{ $blog->user->name }}</span>
                                @else
                                    <img src="{{ url('upload/no_image.jpg') }}" class="author-img">
                                    <span class="author-name">Admin</span>
                                @endif
                            </div>
                            <a href="{{ route('frontend.blog.show', $blog->slug) }}" class="read-more-link">
                                Đọc bài <i class="la la-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Chưa có bài viết nào được đăng.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
