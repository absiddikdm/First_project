@extends('frontend.master')
@section('content')

<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Blogs</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>  
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12"> 
                @foreach ($all_blogs as $all_blog )
                 <!--post 1-->
                 <div class="post-list post-list-style2">
                     <div class="post-list-image">
                         <a href="{{route('blog.details',$all_blog->slug)}}">
                             <img src="{{ asset('uploads/post/thumb') }}/{{ $all_blog->thumbnail }}" alt="">
                         </a>
                     </div>
                     <div class="post-list-content">
                         <h3 class="entry-title">
                             <a href="{{route('blog.details',$all_blog->slug)}}">{{ $all_blog->title }}</a>
                         </h3>  
                         <ul class="entry-meta">

                            @if ($all_blog->rel_to_author->photo == null)
                            <li class="post-author-img"><img src="{{ Avatar::create($all_blog->rel_to_author->username)->toBase64() }}" /></li>
                              @else
                            <li class="post-author-img"><img src="{{asset('uploads/author')}}/{{$all_blog->rel_to_author->photo}}" alt="profile"></li>
                             @endif

                             <li class="post-author"> <a href="{{route('author.blog', $all_blog->author_id)}}">{{$all_blog->rel_to_author->username}}</a></li>
                             <li class="entry-cat"> <a href="{{route('cetegory.blog', $all_blog->category_id)}}" class="category-style-1 "> <span class="line"></span>{{ $all_blog->rel_to_cat->category_name }}</a></li>
                             <li class="post-date"> <span class="line"></span>{{$all_blog->created_at->diffForHumans()}}</li>
                         </ul>
                         <div class="post-exerpt">
                             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                 Ut est minus iste in accusantium repellat repudiandae nulla blanditiis iusto dolores!</p>
                         </div>
                         <div class="post-btn">
                             <a href="{{route('blog.details',$all_blog->slug)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
         </div>
     </div>
 </section>


 
 <!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row"> 
                 <div class="col-lg-12 d-flex justify-content-center">
                      {{ $all_blogs->links('vendor.pagination.custom')}}
                 </div>
             </div>
         </div>
     </div>
 </div>



@endsection