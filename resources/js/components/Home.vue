<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component titulo="Gerar Formulario">
                        <template v-slot:conteudo>

                            <div class="row">
                                <div class="col mb-3">
                                    <input-component id="inputTitulo" titulo="Titulo do Campo" id-help="tituloHelp" texto-help="Obrigatorio. Informe o titulo do campo desejado">
                                        <input type="text" class="form-control" id="inputTitulo" aria-describedby="tituloHelp" v-model="inputTitulo">
                                    </input-component>
                                </div>

                                <div class="col mb-3">
                                    <input-component id="inputId" titulo="ID do Campo" id-help="idHelp" texto-help="Obrigatorio. Informe o id do campo desejado">
                                        <input type="text" class="form-control" id="inputId" aria-describedby="idHelp" v-model="inputId">
                                    </input-component>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <input-component id="inputDescricao" titulo="Help do Campo" id-help="descricaoHelp" texto-help="Obrigatorio. Informe um descrição curta para o help do campo desejado">
                                        <input type="text" class="form-control" id="inputDescricao" aria-describedby="descricaoHelp" v-model="inputDescricao">
                                    </input-component>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <input-component id="inputTipo" titulo="Tipo do Campo" id-help="tipoHelp" texto-help="Obrigatorio. Informe o tipo do campo desejado">
                                        <select name="inputTipo" id="inputTipo" class="form-control" aria-describedby="tipoHelp" v-model="inputTipo">
                                            <option value="">Escolha o Tipo do Input</option>
                                            <option value="text">Texto</option>
                                            <option value="number">Numero</option>
                                            <option value="email">Email</option>
                                            <option value="checkbox">CheckBox</option>
                                            <option value="radio">Radio</option>
                                            <option value="textarea">Area de Texto</option>
                                        </select>
                                    </input-component>
                                </div>
                            </div>

                            <tabela-component
                                :dados="formulario"
                                :titulos="titulos"
                                :visualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaVisualizar'}"
                                :atualizar="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaAtualizar'}"
                                :remover="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaRemover'}"
                            >
                            </tabela-component>

                        </template>

                        <template v-slot:rodape>
                            <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
                            <button type="button" class="btn btn-primary" @click="gerar()">Gerar</button>
                        </template>

                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
 export default {
    data(){
        return {
            urlBase: 'http://gerador-codigo.com/api/v1/',
            inputTitulo: '',
            inputId: '',
            inputDescricao: '',
            inputTipo: '',
            feedback: {},
            titulos: {
                inputTitulo: {titulo: "Titulo", tipo: "texto"},
                inputId: {titulo: "ID", tipo: "texto"},
                inputDescricao: {titulo: "Descrição", tipo: "texto"},
                inputTipo: {titulo: "Tipo", tipo: "texto"},
            },
            formulario: { data: [] },
            input: {},
            json: '',
            arquivo: ''
        }
    },
    methods: {
        salvar() {
            this.input['inputTitulo'] = this.inputTitulo
            this.input['inputId'] = this.inputId
            this.input['inputDescricao'] = this.inputDescricao
            this.input['inputTipo'] = this.inputTipo

            this.formulario.data.push(this.input)
            this.limpar()

            console.log(this.formulario)
        },
        limpar() {
            this.inputTitulo = ''
            this.inputId = ''
            this.inputDescricao = ''
            this.inputTipo = ''
            this.input = {}
        },
        gerar() {
            console.log(this.formulario)
            axios({
                method: "POST",
                url: this.urlBase + "gerar",
                data: this.formulario
            }).then(function (response) {

                response.data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(response.data));
                var a = document.createElement("a");
                document.body.appendChild(a);
                a.style = "display: none";
                a.href = 'data:' + response.data ;
                a.download = "formulario.json";
                a.click();

            });

        }
    }
 }
</script>
