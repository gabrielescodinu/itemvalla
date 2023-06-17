<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="relative">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-100 relative">
            <div class="mt-5 relative z-10">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="text-gray-100" for="title">Title</label>
                        <input id="title"
                            class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
                            type="text" name="title" :value="old('title')" required autofocus />
                    </div>
                    <div class="mt-4">
                        <label for="content">Content</label>
                        <textarea id="content"
                            class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
                            name="content" rows="5" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label for="image">Image</label>
                        <input id="image"
                            class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
                            type="file" name="image" />
                    </div>

                    <div id="repeatable-fields-container">
                        <!-- I campi ripetibili andranno qui -->
                    </div>

                    <button type="button" id="add-repeatable-field-button"
                        class="bg-primary hover:bg-gray-600 duration-150 px-4 py-2 rounded-lg flex items-center shadow-primary hover:shadow-gray-600 shadow-2xl">Add
                        Field</button>

                    <div class="flex items-center justify-center mt-4">
                        <button type="submit"
                            class="bg-primary hover:bg-gray-600 duration-150 px-8 py-4 rounded-lg flex items-center shadow-primary hover:shadow-gray-600 shadow-2xl">
                            {{ __('Create Post') }}
                            <svg class="h-6 w-6 ml-2 rounded-full border" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 -960 960 960">
                                <path fill="currentColor"
                                    d="m480-160-42-43 247-247H160v-60h525L438-757l42-43 320 320-320 320Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            class="absolute inset-0 blur-[118px] max-w-lg h-[800px] mr-auto sm:max-w-3xl sm:h-[400px] bg-gradient-to-r from-primaryfade to-secondaryfade">
        </div>

    </div>
    <script>
        $("#add-repeatable-field-button").on("click", function() {
            const fieldContainer = $("<div>");

            // Calcola l'indice per il nuovo campo ripetibile
            const index = $('#repeatable-fields-container > div').length;

            const nameLabel = $("<label>").text("Field Name");
            const nameInput = $("<input>").attr({
                type: "text",
                name: `repeatable_fields[${index}][name]`,
                required: true,
            });
            fieldContainer.append(nameLabel, nameInput);

            const descriptionLabel = $("<label>").text("Field Description");
            const descriptionInput = $("<input>").attr({
                type: "text",
                name: `repeatable_fields[${index}][description]`,
                required: true,
            });
            fieldContainer.append(descriptionLabel, descriptionInput);

            const removeButton = $("<button>").text("Remove");
            removeButton.on("click", function(event) {
                event.preventDefault();
                fieldContainer.remove();
            });
            fieldContainer.append(removeButton);

            $("#repeatable-fields-container").append(fieldContainer);
        });
    </script>


</x-app-layout>
