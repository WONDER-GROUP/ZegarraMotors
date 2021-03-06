@props(['message' => 'Registro exitoso.', 'icon' => 'success'])

<div class="flex items-center gap-4 p-4 text-white bg-gray-900 rounded" role="alert">
    @if ($icon == 'success')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
        </svg>
    @elseif ($icon == 'error')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    @endif

    <strong class="text-sm font-normal"> {{ $message }} </strong>
</div>
