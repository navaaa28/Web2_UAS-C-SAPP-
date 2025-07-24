@props(['url'])

@php
    use App\Helpers\YoutubeHelper;
    $videoId = YoutubeHelper::getVideoId($url);
@endphp

@if($videoId)
    <div class="aspect-w-16 aspect-h-9">
        <iframe 
            src="https://www.youtube.com/embed/{{ $videoId }}" 
            class="w-full h-full rounded-lg shadow-lg"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
@endif 