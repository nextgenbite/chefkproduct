<div class="p-6 space-y-6">
    @csrf
    @if (isset($edit))
        
    @method('put')
    @endif
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6">
            @include('components.input-text' , ['type'=>'text', 'name'=> 'name', 'label'=> 'Name','value'=> old('name', $edit->name ?? '')])

        </div>
        <div class="flex flex-col col-span-6">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table
                            class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" aria-describedby="checkbox-1"
                                                type="checkbox"
                                                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" colspan="6"
                                        class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">
                                        Permissions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse ($permission_groups as $item)
                                    @php
                                        $permissions = App\Models\User::getpermissionByGroupName($item->group_name);
                                    @endphp
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-{{ $item->group_name }}" 
                                                    aria-describedby="checkbox-{{ $item->group_name }}"
                                                    type="checkbox"
                                                    class="group-checkbox w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-{{ $item->group_name }}" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                            
                                        <th class="max-w-sm p-4 overflow-hidden broder-r text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                            {{ $item->group_name }}
                                        </th>
                                        @foreach ($permissions as $permission)
                                            @php
                                                $name = explode('.', $permission->name);
                                            @endphp
                                            <td class="max-w-sm p-1 pt-6 overflow-hidden broder-r text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                <div class="flex items-center mb-4">
                                                    <input id="permission-checkbox-{{ $permission->id }}"
                                                        type="checkbox" name="permission[]"
                                                        {{ isset($edit) && $edit->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                        value="{{ $permission->name }}"
                                                        class="permission-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                        data-group="{{ $item->group_name }}">
                                                    <label for="permission-checkbox-{{ $permission->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 capitalize">
                                                        {{ $name[1] }}
                                                    </label>
                                                </div>
                                                @if (!in_array($permission->name, $permissions->pluck('name')->toArray()))
                                                    <p class="text-red-500">Permission "{{ $permission->name }}" not found for guard "web".</p>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-gray-500">No permission groups found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>