<div class="mt-2 flex rounded-md shadow-sm" x-data="slugInput">
    <div class="relative flex flex-grow items-stretch focus-within:z-10">
        <input
            type="text"
            id="slug"
            name="slug"
            x-model="slug"
            class="block w-full rounded-none rounded-l-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
        >
    </div>
    <button type="button"
            @click="generateSlug"
            class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
    >
        Generate
    </button>
</div>
@push('scripts')
    <script>
        Alpine.data('slugInput', () => ({
            slug: '{{$slug}}',
            textInputId: '{{$textInputId}}',
            generateSlug() {
                const textElement = document.getElementById(this.textInputId);
                if(this.slug === '' || confirm('Are you sure you want to generate a new slug?')) {
                    this.slug = slugify(textElement.value, {lower: true});
                }
            }
        }));
    </script>
@endpush
