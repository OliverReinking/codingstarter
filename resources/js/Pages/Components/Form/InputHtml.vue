<template>
    <div>
        <!-- Menü -->
        <div
            class="mb-4 h-14 p-4 flex items-center bg-layout-200 dark:bg-layout-700 rounded-lg"
            v-if="isFocused"
        >
            <div class="flex items-center justify-start gap-x-2">
                <button
                    @click="toggleFormat('bold')"
                    class="p-1 rounded-full hover:bg-layout-white hover:dark:bg-layout-black cursor-pointer"
                    v-tippy
                >
                    <b>fett</b>
                </button>
                <tippy placement="top"
                    >Der markierte Text wird <b>fett</b></tippy
                >

                <button
                    @click="toggleFormat('italic')"
                    class="p-1 rounded-full hover:bg-layout-white hover:dark:bg-layout-black cursor-pointer"
                    v-tippy
                >
                    <b><i>kursiv</i></b>
                </button>
                <tippy placement="top"
                    >Der markierte Text wird <b>kursiv</b></tippy
                >

                <button
                    v-for="i in 6"
                    :key="i"
                    @click="toggleFormat(`h${i}`)"
                    class="p-1 rounded-full hover:bg-layout-white hover:dark:bg-layout-black cursor-pointer"
                >
                    <b>H{{ i }}</b>
                </button>

            </div>
        </div>

        <!-- Text -->
        <div class="mb-4 p-4 bg-layout-200 dark:bg-layout-700 rounded-lg">
            <div
                ref="editor"
                contenteditable="true"
                @input="updateValue"
                @focus="isFocused = true"
                class="max-w-none min-h-full prose md:prose-md dark:prose-invert prose-headings:font-title prose-pre:bg-layout-100 prose-pre:text-layout-800 dark:prose-pre:bg-layout-800 dark:prose-pre:text-layout-100 focus:outline-none dark:text-white"
            ></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'InputHTML',

    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },

    data () {
        return {
            isFocused: false
        }
    },

    mounted () {
        this.$refs.editor.innerHTML = this.modelValue
    },

    methods: {
        toggleFormat (format) {
            const selection = window.getSelection()
            if (!selection.rangeCount) return

            const range = selection.getRangeAt(0)
            const selectedText = range.toString()

            if (!selectedText) return

            let formattedText
            switch (format) {
                case 'bold':
                    formattedText = `<strong>${selectedText}</strong>`
                    break
                case 'italic':
                    formattedText = `<em>${selectedText}</em>`
                    break
                case 'h1':
                case 'h2':
                case 'h3':
                case 'h4':
                case 'h5':
                case 'h6':
                    formattedText = `<${format}>${selectedText}</${format}>`
                    break
            }

            range.deleteContents()
            range.insertNode(
                new DOMParser().parseFromString(formattedText, 'text/html').body
                    .firstChild
            )
            this.updateValue()
        },

        updateValue () {
            this.$emit('update:modelValue', this.$refs.editor.innerHTML)
        }
    }
}
</script>
