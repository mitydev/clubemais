{{-- resources/views/site/sections/content.blade.php --}}
@php
    $c = is_object($section ?? null) ? (array) ($section->content ?? []) : [];
    $defaults = config('pagebuilder.sections.content.defaults') ?? [];
    $html = $c['html'] ?? ($defaults['html'] ?? '');
@endphp

@if(!empty($html))
<section class="section-content-rich">
    <div class="section-content-inner">
        {!! $html !!}
    </div>
</section>
@endif
