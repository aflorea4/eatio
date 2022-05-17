<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Create a new ingredient
                            </DialogTitle>
                            <div class="mt-6">
                                <jet-input
                                    class="w-full mb-2"
                                    type="text"
                                    v-model="createForm.name"
                                    placeholder="Ingredient's name"
                                />
                                <jet-input
                                    class="w-full"
                                    type="number"
                                    v-model="createForm.quantity"
                                    placeholder="Ingredient's quantity"
                                />
                            </div>

                            <div class="mt-8">
                                <div class="flex flex-row">
                                    <div class="flex-shrink-0">
                                        <jet-button
                                            @click.stop="createIngredient"
                                            >Create</jet-button
                                        >
                                    </div>
                                    <div class="flex-grow text-right">
                                        <jet-button @click.stop="closeModal"
                                            >Close</jet-button
                                        >
                                    </div>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    <app-layout title="Ingredients">
        <template #header>
            <div class="flex flex-row">
                <h2
                    class="flex-grow font-semibold text-xl text-gray-800 leading-tight"
                >
                    Ingredients
                </h2>
                <div class="flex-shrink-0">
                    <jet-button @click.stop="isOpen = true">Create</jet-button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div
                            class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
                        >
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Quantity(g)
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                >
                                                    <span class="sr-only"
                                                        >Edit</span
                                                    >
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <tr
                                                v-for="ingredient in ingredients"
                                                :key="ingredient.id"
                                            >
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                >
                                                    <template
                                                        v-if="
                                                            editForm.id !=
                                                            ingredient.id
                                                        "
                                                        >{{
                                                            ingredient.name
                                                        }}</template
                                                    >
                                                    <template v-else
                                                        ><jet-input
                                                            type="text"
                                                            placeholder="Ingredient name"
                                                            v-model="
                                                                editForm.name
                                                            "
                                                    /></template>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                >
                                                    <template
                                                        v-if="
                                                            editForm.id !=
                                                            ingredient.id
                                                        "
                                                        >{{
                                                            ingredient.quantity
                                                        }}</template
                                                    >
                                                    <template v-else
                                                        ><jet-input
                                                            type="number"
                                                            placeholder="Ingredient quantity"
                                                            v-model="
                                                                editForm.quantity
                                                            "
                                                    /></template>
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                >
                                                    <template
                                                        v-if="
                                                            editForm.id !=
                                                            ingredient.id
                                                        "
                                                        ><jet-button
                                                            class="mr-2"
                                                            @click.stop="
                                                                enableEdit(
                                                                    ingredient
                                                                )
                                                            "
                                                            ><PencilAltIcon
                                                                class="w-4 h-4 text-white mr-2"
                                                            />Edit</jet-button
                                                        >
                                                        <jet-button
                                                            @click.stop="
                                                                deleteIngredient(
                                                                    ingredient.id
                                                                )
                                                            "
                                                            ><TrashIcon
                                                                class="w-4 h-4 text-white mr-2"
                                                            />Delete</jet-button
                                                        ></template
                                                    >
                                                    <template v-else>
                                                        <jet-button
                                                            class="mr-2"
                                                            @click.stop="
                                                                saveIngredient
                                                            "
                                                            ><CheckIcon
                                                                class="w-4 h-4 text-white mr-2"
                                                            />Save</jet-button
                                                        >
                                                        <jet-button
                                                            @click.stop="
                                                                editForm.id =
                                                                    null
                                                            "
                                                            ><XIcon
                                                                class="w-4 h-4 text-white mr-2"
                                                            />Cancel</jet-button
                                                        >
                                                    </template>
                                                </td>
                                            </tr>

                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";

import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";

import {
    PencilAltIcon,
    TrashIcon,
    CheckIcon,
    XIcon,
} from "@heroicons/vue/solid";

import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

export default defineComponent({
    components: {
        AppLayout,
        Welcome,
        JetButton,
        JetInput,
        PencilAltIcon,
        TrashIcon,
        CheckIcon,
        XIcon,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    },
    data() {
        return {
            isOpen: false,
            createForm: this.$inertia.form({
                name: "",
                quantity: "",
            }),
            deleteForm: this.$inertia.form({
                id: null,
            }),
            editForm: this.$inertia.form({
                id: null,
                name: "",
                quantity: "",
            }),
        };
    },
    methods: {
        enableEdit(ingredient) {
            this.editForm.id = ingredient.id;
            this.editForm.name = ingredient.name;
            this.editForm.quantity = ingredient.quantity;
        },
        saveIngredient() {
            this.editForm.id == null;
            this.editForm.post(route("ingredients.update", this.editForm.id));
        },
        deleteIngredient(id) {
            this.deleteForm.id = id;
            this.deleteForm.delete(route("ingredients.destroy", id));
        },
        closeModal() {
            this.isOpen = false;
        },
        createIngredient() {
            this.createForm.post(route("ingredients.store"));
            this.createForm.reset();
            this.closeModal();
        },
    },
    props: ["ingredients"],
});
</script>
