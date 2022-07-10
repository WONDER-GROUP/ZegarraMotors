@props(['on', 'time' => 3000])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, {{ $time }});  })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none;"
    {{ $attributes->merge(['class' => 'fixed mt-6 mr-6 top-0 right-0 z-50 flex']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>