<template>
    <div class="form-group">
        <label :for="id" class="form-lable">{{ titulo }}</label>
        <i :id="idHelp" :title="textoHelp" data-toggle="tooltip" data-placement="right" class="bi bi-question-circle" style="cursor: pointer;"></i>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: ['id','titulo', 'idHelp', 'textoHelp']
    }
</script>
