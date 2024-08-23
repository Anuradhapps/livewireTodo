<div class="container content py-2 mx-auto">
    <div class="mx-auto  border-blue-500 border-t-2">
        <div id="create-form" class="hover:shadow-lg p-4 bg-white mt-2">
            <div class="flex ">
                <h2 class="font-semibold text-lg text-gray-800">Create New Todo</h2>
            </div>
            <div>
                <form>
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">*
                            Todo </label>
                        <input wire:model='name' type="text" id="name" placeholder="Todo.."
                            class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2">
                        @error('name')
                            <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                        @enderror

                    </div>
                    <button wire:click.prevent='create' type="submit"
                        class="px-2 py-1 text-sm bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Create
                        +</button>
                    @if (session('success'))
                        <span class="text-green-500 text-xs" id="flash-message">{{ session('success') }}</span>
                    @endif


                </form>
            </div>
        </div>
    </div>
</div>
