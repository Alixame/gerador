<template>
    <div>
        <form action="" >
            <input-component v-for="input, key in formulario.data" :key="key" :id="input.inputId" :titulo="input.inputTitulo" :id-help="input.inputId" :texto-help="input.Descrição">
                <input :type="input.inputTipo" class="form-control" :id="input.inputId" :aria-describedby="input.inputId" >
            </input-component>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                formulario: []
            }
        },
        mounted() {
            axios
            .get('/storage/json/formulario.json')
            .then(response => {
                this.formulario = response.data
                console.log(this.formulario)
            })
        }
    }
</script>
