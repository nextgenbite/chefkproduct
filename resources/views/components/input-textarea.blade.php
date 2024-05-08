<label for="{{ isset($id) ? $id : $name }}"
       class="block mb-2 text-sm font-medium @error($name) text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">
    {{ucwords($label)}}
</label>

<textarea rows="4" id="{{ isset($id) ? $id : $name }}" name="{{$name}}" @if (isset($value)) value="{{$value}}" @endif
          class="block w-full p-2.5 border rounded-lg text-sm {{isset($class) ?? ''}}
          @error($name) bg-red-50 border-red-500 text-red-900 placeholder-red-700
          focus:ring-red-500 focus:border-red-500 dark:border-red-500 dark:text-red-500 dark:placeholder-red-500
          @else bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:bg-gray-700
          @enderror"
          placeholder="@error($name) Input error @else Enter {{ucwords($label)}} @enderror">{{isset($value) ? $value: ''}}</textarea>

@error($name)
<p class="mt-2 text-sm text-red-600 dark:text-red-500">
    <span class="font-medium">Oh, snap!</span>
    {{ $message }}
</p>
@else
<p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{isset($text) ? $text : null}}</p>
@enderror
