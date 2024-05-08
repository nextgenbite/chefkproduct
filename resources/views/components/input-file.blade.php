
<label class="block mb-2 text-sm font-medium
@error($name) text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror"
for="{{ isset($id) ? $id : $name }}">{{ucwords($label)}}</label>
<div class="relative ">
<input name="{{$name}}"
    class="block w-full text-sm  border rounded-lg cursor-pointer focus:outline-none
    
    @error($name) bg-red-50 border-red-500 text-red-900 placeholder-red-700
       focus:ring-red-500 focus:border-red-500 dark:border-red-500 dark:text-red-500 dark:placeholder-red-500
       @else bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:bg-gray-700
       @enderror"
    
    aria-describedby="file_input_help" id="{{ isset($id) ? $id : $name }}" type="file">
<img class="absolute top-0 right-0 w-10 h-10 rounded preview"
    src="{{ asset( isset($value) ? $value :'/images/no-image.png') }}" alt="thumbnail">
</div>

@error($name)
<p class="mt-2 text-sm text-red-600 dark:text-red-500">
       <span class="font-medium">Oh, snap!</span>
       {{ $message }}
</p>
@else

<p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{isset($text) ?? null}}</p>
@enderror