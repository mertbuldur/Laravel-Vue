<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ title }}   <button class="btn btn-secondary" @click="showForm">+</button> </div>
        <div v-if="isShow" style="padding:10px;">
            <input type="text" class="form-control" v-model="time" placeholder="Çalışma Saati : 10.00 - 11.00">
            <button @click="addTime" style="margin-top:5px;" class="btn btn-primary">Ekle</button>
        </div>
        <div class="panel-body">
            <div v-for="item in data">{{item}}</div>

        </div>
    </div>
</template>

<script>
    export default
    {
        props:['title','data','day'],
        data(){
            return {
                isShow:false,
                time:''
            }
        },
        methods:{
            showForm:function(){
                this.isShow = !this.isShow;
            },
            addTime:function () {
               this.$emit('add',{text:this.time,day:this.day});
               this.time = '';
               this.isShow = false;
            }
        }
    }
</script>
