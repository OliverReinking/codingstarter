<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <slot name="header">

                </slot>
                <button type="button" @click.prevent="close">
                    <icon-close class="h-6 w-6" />
                </button>
            </header>

            <section class="modal-body">
                <slot name="body">

                </slot>
            </section>

            <footer class="modal-footer">
                <slot name="footer">

                </slot>
            </footer>
        </div>
    </div>
</template>
<script>
import IconClose from "@/Pages/Components/Icons/Close.vue";
//
export default {
    name: "ComponentsEditorModal",
    //
    components: {
        IconClose
    },
    //
    methods: {
        close() {
            this.$emit("close");
        }
    }
};
</script>
<style lang="css" scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 500;
}
.modal {
    @apply p-4 m-4 flex flex-col bg-layout-100 text-layout-900 shadow-xl rounded-lg overflow-x-auto;
    min-width: 50%;
    min-height: 50%;
}

.modal-header {
    @apply p-4 flex items-center justify-between text-sunprimary relative border-b border-sunprimary;
}

.modal-body {
    @apply relative flex-1 p-4;
}

.modal-footer {
    @apply p-4 flex flex-col items-center justify-end text-sunprimary border-t border-sunprimary;
}

</style>
