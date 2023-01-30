<script>
import axios from 'axios';
import {BASE_URL} from '../data/data'
export default {
    name: "ContactForm",
    data() {
        return {
            name: '',
            email: '',
            message: '',
            loading: false,
            success: false,
            errors: {}
        }
    },
    methods: {
        sendForm() {
            this.loading = true;
            const data = {
                name: this.name,
                email: this.email,
                message: this.message
            };

            // pulisco l'array con i messaggi
            this.errors = {};

            // Importante - Stiamo comunicando con Laravel, quindi non è più obbligatorio inserire gli headers con il Content-Type
            // come abbiamo fatto invece quando comunicavamo direttamente con gli script PHP
            axios.post(`${BASE_URL}contacts`, data).then((response) => {
                this.success = response.data.success;
                if (!this.success) {
                    this.errors = response.data.errors;
                } else {
                    // ripulisco i campi di input
                    this.name = '';
                    this.email = '';
                    this.message = '';
                }
                this.loading = false;
            });
        },
    }
}
</script>

<template>
    <form @submit.prevent="sendForm()" >
        <div >
            <input  :class="{ 'is-invalid': errors.name }"
                type="text" name="name" id="name" placeholder="Nome" v-model="name">
            <p v-for="(error, index) in errors.name" :key="`message-error-${index}`"
                class="error">
                {{ error }}
            </p>
        </div>
        <div class="mb-3">
            <input :class="{ 'is-invalid': errors.email }"
                type="text" name="email" id="email" placeholder="Email" v-model="email">
            <p v-for="(error, index) in errors.email" :key="`message-error-${index}`"
                class="error">
                {{ error }}
            </p>
        </div>
        <div class="mb-3">
            <textarea
                :class="{ 'is-invalid': errors.message }" name="message" id="message" cols="30"
                rows="10" placeholder="Messaggio" v-model="message"></textarea>
            <p v-for="(error, index) in errors.message" :key="`message-error-${index}`"
                class="error">
                {{ error }}
            </p>
        </div>
        <button  type="submit" :disabled="loading">{{ loading ?
                'invio in corso...' : 'Invia'
        }}</button>
    </form>
</template>

<style scoped lang="scss">
form{
    input, textarea{
        margin-bottom: 30px;
        width: 400px;
        padding: 5px 10px;
        border-radius: 5px;
        border: 1px solid lightgray;
        margin-right: 20px;
    }

    button{
        cursor: pointer;
        background-color: white;
        padding: 5px 10px;
        border: 1px solid brown;
        border-radius: 5px;
    }
    .is-invalid{
        border: 1px solid red;
    }
    .error{
        font-size: .9rem;
        color: red;
    }
}
</style>
