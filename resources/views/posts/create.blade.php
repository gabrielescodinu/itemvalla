<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="relative pb-32">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-100 relative">
            <div class="mt-5 relative z-10">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- form part 1 --}}
                    <section id="form-part-1">
                        <h1 class="text-4xl mb-8">First we need to create a Page ...</h1>

                        <div>
                            <label class="text-gray-100" for="title">Title</label>
                            <input id="title" placeholder="Inser a title for your item" class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]" type="text" name="title" :value="old('title')" required autofocus />
                        </div>
                        <div class="mt-4">
                            <label for="content">Description</label>
                            <textarea id="content" placeholder="Insert a short description of your item" class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]" name="content" rows="5" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="image">Insert a background image for your page</label>
                            <input id="image" type="file" name="image" required class="block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]">
                        </div>
                        <button type="button" id="next-button" class="ml-auto mt-8 bg-primary hover:bg-gray-600 duration-150 px-8 py-4 rounded-lg flex items-center shadow-primary hover:shadow-gray-600 shadow-2xl">
                            Next
                            <svg class="h-6 w-6 ml-2 rounded-full border" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                <path fill="currentColor" d="m480-160-42-43 247-247H160v-60h525L438-757l42-43 320 320-320 320Z" />
                            </svg>
                        </button>

                    </section>

                    {{-- form part 2 --}}
                    <section id="form-part-2" style="display: none;">
                        <h1 class="text-4xl mb-8">... now it's time to create some items</h1>
                        <div id="repeatable-fields-container" class="mt-16 space-y-4">
                            <p class="text-2xl text-gray-300">Add more Items</p>
                            {{-- repeatable fields here --}}
                        </div>

                        <button type="button" id="add-repeatable-field-button" class="bg-primary hover:bg-gray-600 duration-150 px-4 py-2 rounded-lg flex items-center shadow-primary hover:shadow-gray-600 shadow-2xl mt-4">
                            Add an Item
                            <svg class="h-6 w-6 ml-2 rounded-full border" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                <path fill="currentColor" d="M450-200v-250H200v-60h250v-250h60v250h250v60H510v250h-60Z" />
                            </svg>
                        </button>

                        <div class="flex justify-between mt-8">
                            <button type="button" id="previous-button" class="bg-blue-500 hover:bg-gray-600 duration-150 px-8 py-4 rounded-lg flex items-center shadow-blue-500 hover:shadow-gray-600 shadow-2xl">
                                <svg class="h-6 w-6 mr-2 rounded-full border" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                    <path fill="currentColor" d="M480-160 160-480l320-320 42 42-248 248h526v60H274l248 248-42 42Z" />
                                </svg>
                                Previous
                            </button>

                            <div class="flex items-center justify-center">
                                <button type="submit" class="bg-primary hover:bg-gray-600 duration-150 px-8 py-4 rounded-lg flex items-center shadow-primary hover:shadow-gray-600 shadow-2xl">
                                    {{ __('Create Post') }}
                                    <svg class="h-6 w-6 ml-2 rounded-full border" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                        <path fill="currentColor" d="m480-160-42-43 247-247H160v-60h525L438-757l42-43 320 320-320 320Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </section>

                </form>
            </div>
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
            }).addClass(
                "block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
            );
            fieldContainer.append(nameLabel, nameInput);

            const descriptionLabel = $("<label>").text("Field Description");
            const descriptionInput = $("<input>").attr({
                type: "text",
                name: `repeatable_fields[${index}][description]`,
                required: true,
            }).addClass(
                "block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
            );
            fieldContainer.append(descriptionLabel, descriptionInput);

            // Aggiungi un campo di upload di immagini
            const imageLabel = $("<label>").text("Field Image");
            const imageInput = $("<input>").attr({
                type: "file",
                name: `repeatable_fields[${index}][image]`,
                required: true,
            }).addClass(
                "block w-full mt-2 px-3 py-2 text-gray-100 outline-none border rounded-lg border-none focus:border-primary focus:ring-primary bg-white/[.075]"
            );
            fieldContainer.append(imageLabel, imageInput);

            const removeButton = $("<button>").html(`Remove <svg class="h-6 w-6 ml-2 rounded-full border" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"> <path fill="currentColor" d="M200-450v-60h560v60H200Z" /> </svg>`);
            removeButton.on("click", function(event) {
                event.preventDefault();
                fieldContainer.remove();
            }).addClass(
                "bg-red-500 hover:bg-gray-600 duration-150 px-4 py-2 rounded-lg flex items-center shadow-red-500 hover:shadow-gray-600 shadow-2xl mt-4"
            );
            fieldContainer.append(removeButton);

            $("#repeatable-fields-container").append(fieldContainer);
        });

        $("#next-button").click(function(e) {
            e.preventDefault();
            // Here you can add custom validation for form part 1
            $("#form-part-1").fadeOut(500, function() {
                $("#form-part-2").fadeIn(500);
            });
        });

        $("#previous-button").click(function(e) {
            e.preventDefault();
            $("#form-part-2").fadeOut(500, function() {
                $("#form-part-1").fadeIn(500);
            });
        });
    </script>

</x-app-layout>
