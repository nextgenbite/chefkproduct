<?php
namespace App\Traits;

trait BaseTrait {

    public function CrudStatus($row) {
        if ($row->status == 1) {
            return '
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer" checked>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-primary-light rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>';
        } else {
            return '
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-primary-light rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            </label>';
        }
    }
    public function CrudAction($row) {
   return ' <div class="inline-flex rounded-md shadow-sm" role="group">
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <span class="material-symbols-sharp w-1 h-1 ">visibility</span>
            </button>
            <button title="edit" data-id="' . $row->id . '" type="button" class="editData inline-flex items-center px-4 py-2 text-sm font-medium text-primary-light bg-transparent border-t border-b border-gray-900 hover:bg-gray-800 hover:text-primary-800 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <span class="material-symbols-sharp w-1 h-1 ">edit_note</span>
            </button>
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <span class="material-symbols-sharp w-1 h-1 ">delete</span>
            </button>
        </div>';
    }
}