@include('layout.header')
<x-post-detail :post="$post" :back-route="route('events.index')" :back-label="__('posts.back_to_events')" />
@include('layout.footer')
