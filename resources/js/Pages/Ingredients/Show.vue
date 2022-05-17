<template>
    <app-layout :title="ingredient.name">
        <template #header>
            <div class="flex flex-row">
                <h2
                    class="flex-grow font-semibold text-xl text-gray-800 leading-tight"
                >
                    🍱 <span class="ml-2">{{ ingredient.name }}</span>
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <div class="flex flex-col">
                        <div class="flex flex-row mb-2">
                            <div class="flex-grow">Name</div>
                            <div class="flex-shrink-0 max-w-sm">
                                {{ ingredient.name }}
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="flex-grow">Quantity</div>
                            <div class="flex-shrink-0 max-w-sm">
                                {{ ingredient.quantity }}
                            </div>
                        </div>
                        <div class="flex-row">
                            <div class="w-full">Available recipes</div>
                            <div class="mt-2">
                                <ul>
                                    <li
                                        v-for="recipe in ingredient.recipes"
                                        :key="recipe.id"
                                    >
                                        <Link
                                            :href="
                                                route('recipes.show', recipe.id)
                                            "
                                            as="button"
                                            class="mb-2 rounded-md w-full px-3 py-1.5 bg-gray-50 border border-blue-200 hover:bg-blue-200"
                                            type="button"
                                        >
                                            {{ recipe.name }}
                                        </Link>
                                    </li>
                                </ul>
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

import { Link } from "@inertiajs/inertia-vue3";

import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";

import {
    PencilAltIcon,
    TrashIcon,
    CheckIcon,
    XIcon,
} from "@heroicons/vue/solid";

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
        Link,
    },
    props: ["ingredient"],
});
</script>
