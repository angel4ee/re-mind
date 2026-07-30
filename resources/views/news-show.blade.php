@include('layout.header')
<x-post-detail :post="$post" :back-route="route('news.index')" :back-label="__('posts.back_to_news')" />
@include('layout.footer')
