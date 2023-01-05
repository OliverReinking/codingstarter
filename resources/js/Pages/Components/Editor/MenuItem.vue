<template>
    <button
        class="editor_menubar__button"
        :class="{ 'is-active': isActive ? isActive() : null }"
        tabindex="-1"
        @click.prevent="action"
        :title="title"
        v-tippy
    >
        <icon :name="icon" />
    </button>
    <tippy v-if="title" v-html="title" placement="bottom"></tippy>
</template>

<script>
import Icon from "@/Pages/Components/Editor/Icon.vue";
//
export default {
    //
    components: {
        Icon,
    },
    //
    props: {
        icon: {
            type: String,
            required: true,
        },

        title: {
            type: String,
            required: true,
        },

        action: {
            type: Function,
            required: true,
        },

        isActive: {
            type: Function,
            default: null,
        },
    },
};
</script>
