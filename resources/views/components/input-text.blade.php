@php
    $inputId = $id ?? $name;
    $inputType = $type ?? 'text';
    $inputValue = $value ?? '';
    $inputClass = $class ?? 'p-2.5';
    $hasError = $errors->has($name);
@endphp

<label for="{{ $inputId }}" class="block mb-2 text-sm font-medium {{ $hasError ? 'text-red-700 dark:text-red-500' : 'text-gray-700 dark:text-white' }}">
    {{ ucwords($label) }}
</label>

<input type="{{ $inputType }}" id="{{ $inputId }}" name="{{ $name }}" value="{{ $inputValue }}"
   class="{{ $inputClass }} block w-full border rounded-lg text-base
          {{ $hasError 
            ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:border-red-500 dark:text-red-500 dark:placeholder-red-500'
            : 'bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:bg-gray-700'
          }}"
   placeholder="{{ $hasError ? 'Input error' : 'Enter ' . ucwords($label) }}">

@if ($hasError)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
        <span class="font-medium">Oh, snap!</span> {{ $errors->first($name) }}
    </p>
@endif

@if (isset($text))
    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $text }}</p>
@endif
