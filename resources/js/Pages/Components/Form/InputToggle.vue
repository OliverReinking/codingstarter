<template>
    <div class="flex items-start">
        <div
            class="w-14 h-7 flex items-center bg-gray-300 rounded-full p-1 duration-300 cursor-pointer"
            :class="{ 'bg-green-500': modelValue }"
            :aria-checked="modelValue.toString()"
            @click="toggle"
        >
            <div
                class="bg-white w-5 h-5 rounded-full shadow-md transform duration-300"
                :class="{ 'translate-x-7': modelValue }"
            ></div>
        </div>
        <div class="h-7 p-1 ml-3 text-sm flex items-center">
            <label
                :for="name"
                class="font-medium text-layout-900 dark:text-layout-300"
            >
                <span v-if="label">{{ label }}</span>
                <span v-else>
                    <slot></slot>
                </span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Form_InputToggle',

    emits: ['update:modelValue'],

    props: {
        name: {
            type: String,
            required: true
        },
        modelValue: {
            type: [Boolean, Number],
            default: false
        },
        label: {
            type: String,
            default: ''
        }
    },

    methods: {
        toggle () {
            //console.log('Form_InputToggle methods toggle')
            this.$emit('update:modelValue', !this.modelValue)
        }
    }
}
</script>

<style scoped>
.toggle-bg:after {
    content: '';
    @apply absolute top-0.5 left-0.5 bg-white border border-layout-300 rounded-full h-5 w-5 transition shadow-sm;
}

input:checked + .toggle-bg:after {
    transform: translateX(100%);
    @apply border-white;
}

input:checked + .toggle-bg {
    @apply bg-sunprimary border-sunprimary;
}
</style>
