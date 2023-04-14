<template>
    <span v-html="contentLimited"></span>
</template>
<script>
export default {
    name: "Content_ShortText",

    props: {
        content: {
            type: [Boolean, Number, String],
            default: false,
        },
        maxLength: {
            type: Number,
            default: 30,
        },
        continuationSymbol: {
            type: String,
            default: "...",
        },
    },

    computed: {
        contentLimited() {
            if (this.content) {
                if (this.content.length > this.maxLength) {
                    return (
                        this.content.substring(0, this.maxLength) +
                        this.continuationSymbol
                    );
                } else {
                    return this.content;
                }
            }
            //
            return null;
        },
    },
};
</script>
