<template>
    <div class="row">
        <a class="btn btn-outline-primary" href="#" @click="load">
            Ver respuestas
        </a>

        <div class="col-12 mt-2" v-for="(response, index) in responses" :key="index">
            <div class="card">
                <div class="card-block">
                    {{ response.message }}
                </div>

                <div class="card-footer text-muted">
                    {{ response.created_at }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/* JavaScript dependencies */
import axios from 'axios';

export default {
    name: 'Responses',
    props: {
        message: {
            type: Number,
            default() {
                return 1;
            },
        },
    },
    data() {
        return {
            responses: [],
        };
    },
    methods: {
        load() {
            axios.get(`/api/message/${this.message}/responses`).then((res) => {
                this.responses = res.data;
            });
        },
    },
};
</script>
