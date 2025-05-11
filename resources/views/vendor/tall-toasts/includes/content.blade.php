<div
    class="overflow-hidden z-50 p-5 bg-white rounded-md shadow cursor-pointer pointer-events-auto select-none ltr:border-l-8 rtl:border-r-8 hover:bg-gray-50"
    x-bind:class="{
                    'border-blue-500': toast.type === 'info',
                    'border-green-500': toast.type === 'success',
                    'border-yellow-500': toast.type === 'warning',
                    'border-red-500': toast.type === 'danger'
                  }"
>
    <div class="flex justify-between items-center space-x-5 rtl:space-x-reverse">
        <div class="flex-1 ltr:mr-2 rtl:ml-2">
            <div
                class="mb-3 text-lg font-bold"
                x-html="toast.title"
                x-show="toast.title !== undefined"
            ></div>

            <div
                class="font-medium text-gray-600"
                x-show="toast.message !== undefined"
                x-html="toast.message"
            ></div>
        </div>

        @include('tall-toasts::includes.icon')
    </div>
</div>
