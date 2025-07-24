@props(['title' => null])

<x-admin-layout :title="$title">
    {{ $slot }}
</x-admin-layout> 