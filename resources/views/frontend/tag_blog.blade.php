@extends('frontend.master')
@section('content')

  <!--section-heading-->
  <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1> Tag:{{ $tag_info->tag_name }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>  
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 
           {{$posts }}
       


  {{-- {{ <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12"> 
                @foreach ($category_blogs as $cat_blog) --}}
                    
                 <!--post 1--> --}}
                 <div class="post-list post-list-style2">
                     <div class="post-list-image">
                         <a href="{{ route('blog.details',  $cat_blog->slug) }}">
                             <img src="{{asset('uploads/post/thumb')}}/{{ $cat_blog->thumbnail }}" alt="">
                         </a>
                     </div>
                     <div class="post-list-content">
                         <h3 class="entry-title">
                             <a href=" {{ route('blog.details',  $cat_blog->slug) }} ">{{ $cat_blog->title }}</a>
                         </h3>  
                         <ul class="entry-meta">
                            @if ($cat_blog->rel_to_author->photo == null)
                            <li class="post-author-img"><img src="{{ Avatar::create($cat_blog->rel_to_author->username)->toBase64() }}" /></li>
                              @else
                            <li class="post-author-img"><img src="{{asset('uploads/author')}}/{{$cat_blog->rel_to_author->photo}}" alt="profile"></li>
                             @endif
                             <li class="post-author"> <a href="{{route('author.blog',$cat_blog->author_id)}}">{{ $cat_blog->rel_to_author()->first()->username}}</a></li>
                             
                             <li class="entry-cat"> <a href="{{route('cetegory.blog',$cat_blog->category_id)}}" class="category-style-1 "> <span class="line"></span>{{$cat_blog->rel_to_cat()->first()->category_name}}</a></li>
                             <li class="post-date"> <span class="line"></span> {{$cat_blog->created_at->diffForHumans()}}</li>
                         </ul>
                         <div class="post-btn">
                             <a href="{{ route('blog.details',  $cat_blog->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                         </div>
                     </div>
                 </div>    
                 @endforeach   
             </div>
         </div>
     </div>
 </section> 

@endsection  
