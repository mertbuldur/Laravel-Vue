<template>
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <admin-working-item day="monday" @add="add" title="Pazartesi" :data="monday" ></admin-working-item>
                <admin-working-item day="tuesday" @add="add" title="Salı" :data="tuesday"></admin-working-item>
                <admin-working-item day="wednesday" @add="add" title="Çarşamba" :data="wednesday"></admin-working-item>
                <admin-working-item day="thursday" @add="add" title="Perşembe" :data="thursday"></admin-working-item>
                <admin-working-item day="friday" @add="add" title="Cuma" :data="friday"></admin-working-item>
                <admin-working-item day="saturday" @add="add" title="Cumartesi" :data="saturday"></admin-working-item>
                <admin-working-item day="sunday" @add="add" title="Pazar" :data="sunday"></admin-working-item>

                <button class="btn btn-success" @click="store">Kaydet</button>

            </div>
        </div>
    </div>




</template>

<script>
    export default
    {
        data()
        {
            return {
                monday:[],
                tuesday:[],
                wednesday:[],
                thursday:[],
                friday:[],
                saturday:[],
                sunday:[]
            }
        },
        created(){
          axios.get(`http://randevu.local/api/working-list`).then((res)=>{

              this.monday = (typeof res.data.monday !== 'undefined') ?  res.data.monday : [];
              this.tuesday = (typeof res.data.tuesday !== 'undefined') ?  res.data.tuesday : [];
              this.wednesday = (typeof res.data.wednesday !== 'undefined') ?  res.data.wednesday : [];
              this.thursday = (typeof res.data.thursday !== 'undefined') ?  res.data.thursday : [];
              this.friday = (typeof res.data.friday !== 'undefined') ?  res.data.friday : [];
              this.saturday = (typeof res.data.saturday !== 'undefined') ?  res.data.saturday : [];
              this.sunday = (typeof res.data.sunday !== 'undefined') ?  res.data.sunday : [];



          })
        },
        methods:{
            add:function (data) {
               this[data.day].push(data.text);
            },
            store:function(){
               axios.post(`http://randevu.local/api/working-store`,{
                    monday:this.monday,
                   tuesday:this.tuesday,
                   wednesday:this.wednesday,
                   thursday:this.thursday,
                   friday:this.friday,
                   saturday:this.saturday,
                   sunday:this.sunday
               })
                   .then((res)=>{
                       console.log(res);
                   })
            }
        }
    }


</script>
