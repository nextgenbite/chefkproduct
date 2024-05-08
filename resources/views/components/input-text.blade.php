<label for="{{ isset($id) ? $id : $name }}" class="block mb-2 text-sm font-medium {{ $errors->has($name) ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white' }}">
       {{ ucwords($label) }}
   </label>
   
   <input type="{{ isset($type) ? $type : 'text' }}" id="{{ isset($id) ? $id : $name }}" name="{{ $name }}" @if (isset($value)) value="{{ $value }}" @endif
   class="{{ isset($class) ? $class : 'p-2.5' }} block w-full  border rounded-lg text-base 
          @if ($errors->has($name)) bg-red-50 border-red-500 text-red-900 placeholder-red-700
          focus:ring-red-500 focus:border-red-500 dark:border-red-500 dark:text-red-500 dark:placeholder-red-500
          @else bg-gray-50 border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:bg-gray-700
          @endif"
   placeholder="@if ($errors->has($name)) Input error @else Enter {{ ucwords($label) }} @endif">
   
   @if ($errors->has($name))
       <p class="mt-2 text-sm text-red-600 dark:text-red-500">
           <span class="font-medium">Oh, snap!</span>
           {{ $errors->first($name) }}
       </p>
   @else
       <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ isset($text) ? $text : null }}</p>
   @endif
   