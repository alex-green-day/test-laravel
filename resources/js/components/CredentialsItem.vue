<template>
    <div class="container">
        <div class="credentials-item">
            <span>{{ resultText }}</span>
            <button @click="remove(index)" type="button" class="btn-danger btn">x</button>
            <input type="hidden" name="credentials[]" :value="submitData">
        </div>
    </div>
</template>

<script>
    export default {
        data: function (){
            return {

            };
        },
        props: {
            item: Object,
            index: Number
        },
        methods: {
            remove: function (index) {
                this.$emit('remove', index)
            }
        },
        computed: {
            resultText: function () {
                if (this.item.clarification.length > 40) {
                    return this.item.clarification.substr(0, 40) + '...';
                }
                return this.item.clarification;
            },
            submitData: function () {
                return this.item.clarification + ', ' + this.item.login + ', ' + this.item.password;
            }
        },
        mounted() {
            console.log('Item added.')
        }
    }
</script>
