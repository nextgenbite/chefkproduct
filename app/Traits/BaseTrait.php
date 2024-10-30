<?php
namespace App\Traits;

trait BaseTrait {

    public function CrudStatus($row) {
            return '
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox"  data-id="' . $row->id . '" name="status" value="'. $row->status.'" class="sr-only peer"'. ($row->status == 1 ? "checked" : "") .'>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-primary-light rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>';
        
    }
    public function CrudImage($image) {
            return '<img class="w-10 h-10 rounded-full" src="'. asset($image ?? '/images/no-image.png').'"
                                    alt="'. $image.'">';
        
    }
    public function CrudCheckbox($row) {
            return '<input type="checkbox" id="select"  value="' . $row->id . '" class="select rounded-full" data-id="' . $row->id . '">';
        
    }
    public function CrudAction($row) {
   return '        
        <div class="inline-flex rounded-md shadow-sm" role="group">
    <button type="button" data-id="' . $row->id . '" class="view-data px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
    <i class="fa-solid fa-eye w-4 h-4 mr-2"></i>
    </button>
    <button type="button" title="edit" data-id="' . $row->id . '"  class="editData px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
    <i class="fa-solid fa-pencil w-4 h-4 mr-2"></i>
    </button>
    <button type="button"  data-id="' . $row->id . '" id="delete" class="delete-data px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
    <i class="fa-solid fa-trash w-4 h-4 mr-2"></i>
    </button>
  </div>
        ';
    }
}