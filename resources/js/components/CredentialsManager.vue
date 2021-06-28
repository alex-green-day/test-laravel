<template>
    <div class="container" id="credentials-manager-form">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                   <!-- <div class="card-header">Управление данными доступа</div> -->
                    <button @click="add" v-show="!showForm" type="button" class="btn-success btn">Добавить</button>
                    <CredentialsForm
                        :showForm="showForm"
                        @hideForm="hide"
                        @addItem="addItem"
                    ></CredentialsForm>
                    <div class="card-body">
                        <h5>Список текущих данных доступа:</h5>
                        <div v-for="(item, index) in items">
                            <item
                                :item="item"
                                :index="index"
                                @remove="removeItem"
                            ></item>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Item from "./CredentialsItem";
    import CredentialsForm from "./CredentialsForm";
    export default {
        data: function (){
            return {
                items: [
                    // Test data for check
                   /* {
                        clarification: 'Мой пароль от ftp',
                        login: 'test',
                        password: '123'
                    },
                    {
                        clarification: 'Пароль для SSH',
                        login: 'test32',
                        password: '232532sdg3'
                    },*/
                ],
                showForm: false
            };
        },
        components: {
            Item,
            CredentialsForm
        },
        props: {

        },
        methods: {
            add: function () {
                this.showForm = true;
            },
            hide: function () {
                this.showForm = false;
            },
            removeItem: function (index) {
                this.items.splice(index, 1);
            },
            addItem: function (newItem) {
                this.items = [...this.items, newItem];
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
