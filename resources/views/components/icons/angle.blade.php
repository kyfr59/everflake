@props([
    'color' => 'bg-white',
])

<div class="relative size-[10px] shrink-0">
    <div class="absolute left-0 top-0 h-[10px] w-[3px] {{ $color }}"></div>
    <div class="absolute left-0 top-0 h-[3px] w-[10px] {{ $color }}"></div>
</div>