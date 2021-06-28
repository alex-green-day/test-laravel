<template>
    <div class="container" id="credentials-add-form" v-show="showForm">
        <div>
            <h5>Добавление доступа</h5>
            <div class="mb-3">
                <label for="login-control">Логин:</label>
                <input type="text" v-model="login" id="login-control" class="form-control"  />
            </div>
            <div class="mb-3">
                <label for="clarification-control">Описание:</label>
                <textarea v-model="clarification" id="clarification-control" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password-control">Пароль:</label>
                <input type="text" v-model="password" id="password-control" class="form-control" />
            </div>
            <button type="button" @click="add" class="btn btn-primary">Добавить</button>
            <button type="button" @click="hide" class="btn btn-danger">Скрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function (){
            return {
                login: '',
                password: '',
                clarification: ''
            };
        },
        props: {
            showForm: Boolean
        },
        methods: {
            remove: function () {

            },
            add: function () {
                this.$emit('addItem', {
                    login: this.login,
                    password: this.password,
                    clarification: this.clarification
                })
                this.login = '';
                this.password = '';
                this.clarification = '';
            },
            hide: function () {
                this.$emit('hideForm');
            }
        },
        mounted() {
            console.log('Item added.')
        }
    }
</script>
