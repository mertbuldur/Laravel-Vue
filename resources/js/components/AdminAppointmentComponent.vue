<template>
    <div class="container">
        <div class="row">
            <div v-for="item in items.data" :key="item.id" class="col-md-4">
                <div class="card appointment-card">
                    <span class="appointment-number">Randevu #{{item.id}}</span>
                    <div class="appointment-detail">
                        <span>{{item.fullName}}</span>
                        <span>{{item.date}}</span>
                        <span>{{ item.working}}</span>
                    </div>
                </div>
        </div>
        </div>

        <div class="row" style="margin-top:10px;">
            <div class="col-md-12">
                <pagination :data="items" @pagination-change-page="getData"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        data(){
            return{
                items:{
                    data:[]
                }

            }
        },
        created()
        {
            this.getData();
        },
        mounted() {
            console.log('beni çağırdın...');
        },
        methods:{
            getData(page){
                if(typeof page === 'undefined')
                {
                    page = 1;
                }
                axios.get(`http://randevu.local/api/admin/list/?page=${page}`)
                    .then(res => {
                        this.items = res.data;
                });
            }
        }
    }
</script>
